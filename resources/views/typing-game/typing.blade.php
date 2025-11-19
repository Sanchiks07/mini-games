<x-layout>
    <div class="conteiner">
        <div class="typing_bar"></div>

        <div class="input">
            <div id="difficultyButton" onclick="difficultyLevel()">Easy</div>
            <input autocomplete="off" type="text" id="typing_input">
            <p id="typing_text"></p>
        </div>

        <div id="outputResult" style="display:none;">
            <div>
                <h1>Resultāti</h1>
                <div id="outputUserName"></div>
                <div id="outputTime"></div>
                <div id="outputAcc"></div>
                <div id="outputWPM"></div>
                <div id="outputIncorrectVord"></div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    const inpField = document.querySelector("#typing_input");
    const typingText = document.querySelector("#typing_text");

    let charIndex = 0;
    let startTime = 0;
    let incorrectLetters = 0;
    let incorrectVord = 0;
    let difficultyIndex = 0;
    let wordsNumber = 50;
    let paragraph = "";
    let lastValue = "";

    let words = [];
    let wordStatus = []; 

    const difficulties = [
        { id: 1, name: "Easy", words: 50 },
        { id: 2, name: "Medium", words: 100 },
        { id: 3, name: "Hard", words: 150 },
        { id: 4, name: "HardCore", words: 300 }
    ];

    const sentences = @json($sentences);

    makeParagraphs();
    loadParagraph();

    inpField.addEventListener("input", initTyping);
    inpField.addEventListener("keydown", checkWord);


    function difficultyLevel() {
        difficultyIndex++;
        if (difficultyIndex >= difficulties.length) difficultyIndex = 0;

        const selected = difficulties[difficultyIndex];
        wordsNumber = selected.words;
        document.getElementById("difficultyButton").innerText = selected.name;

        makeParagraphs();
        loadParagraph();
    }
    function makeParagraphs() {
        paragraph = "";
        while (paragraph.trim().split(/\s+/).length < wordsNumber) {
            const randomIndex = Math.floor(Math.random() * sentences.length);
            paragraph += sentences[randomIndex].sentence + " ";
        }
        paragraph = paragraph.trim();
    }
    function loadParagraph() {
        typingText.innerHTML = "";
        paragraph.split("").forEach(char => {
            typingText.innerHTML += `<span>${char}</span>`;
        });

        document.addEventListener("keydown", () => inpField.focus());
        typingText.querySelectorAll("span")[0]?.classList.add("active");

        words = paragraph.split(/\s+/); // iebāž masīvā tekstu
    }
    function initTyping() {
        const characters = typingText.querySelectorAll("span");
        const currentValue = inpField.value;

        if (currentValue.length < lastValue.length) {
            characters.forEach(span => span.classList.remove("correct", "incorrect", "active"));
            charIndex = currentValue.length;

            for (let i = 0; i < charIndex; i++) {
                if (characters[i].innerText === currentValue[i]) characters[i].classList.add("correct");
            }

            if (charIndex < characters.length) characters[charIndex].classList.add("active");
            lastValue = currentValue;
            return;
        }

        if (charIndex >= characters.length) return;

        const typingChar = currentValue[charIndex];

        if (typingChar === characters[charIndex].innerText) {
            characters[charIndex].classList.add("correct");
        } else {
            characters[charIndex].classList.add("incorrect");
            incorrectLetters++;
        }

        characters[charIndex].classList.remove("active");
        charIndex++;

        if (charIndex === characters.length) {
            inpField.blur();

            resultValues();

            return;
        }

        characters[charIndex].classList.add("active");

        if (startTime === 0) startTime = Date.now();
        lastValue = currentValue;
    }
    function checkWord(e) {
        if (e.key === " " || e.key === "Enter") {

            let typedWords = inpField.value.trim().split(/\s+/);
            let index = typedWords.length - 1;

            let typedWord = typedWords[index];
            let realWord = words[index];

            let newStatus = (typedWord === realWord) ? "correct" : "incorrect";
            let oldStatus = wordStatus[index];

            if (oldStatus !== newStatus) {
                if (oldStatus === "incorrect" && newStatus === "correct") {
                    incorrectVord--;
                }
                if (oldStatus === "correct" && newStatus === "incorrect") {
                    incorrectVord++;
                }
                if (oldStatus === undefined && newStatus === "incorrect") {
                    incorrectVord++;
                }
            }
            wordStatus[index] = newStatus;
        }
    }
    function resultValues() {
        let endTime = Date.now();

        let timeInMin = (endTime - startTime) / 60000;
        let timeInSec = ((endTime - startTime) / 1000).toFixed(1);

        let grossWPM = (charIndex / 5) / timeInMin;
        let WPM = Math.max(0, Math.round(grossWPM - incorrectVord));

        let totalWordsTyped = wordStatus.length;
        let correctWords = wordStatus.filter(w => w === "correct").length;

        let accuracy = 0;
        if (totalWordsTyped > 0) {
            accuracy = Math.round((correctWords / totalWordsTyped) * 100);
        }

        document.getElementById("outputUserName").innerText = "Lietotājs: " + (window.userName ?? "N/A");
        document.getElementById("outputTime").innerText = "Laiks: " + timeInSec + " sekundes";
        document.getElementById("outputAcc").innerText = "Precizitāte: " + accuracy + "%";
        document.getElementById("outputWPM").innerText = "WPM: " + WPM;
        document.getElementById("outputIncorrectVord").innerText = "Kļūdainie vārdi: " + incorrectVord;

        document.getElementById("outputResult").style.display = "block";

        fetch("/typing", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                time_seconds: timeInSec,
                accuracy: accuracy,
                wpm: WPM,
                incorrect_words: incorrectVord,
                incorrect_letters: incorrectLetters,
                difficulty: document.getElementById("difficultyButton").innerText
            })
        });
    }
</script>
