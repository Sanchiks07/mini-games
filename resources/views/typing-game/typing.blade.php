<x-layout>
    <x-slot:title>
        Typing Speed Game
    </x-slot>

    <div class="container">
        <div class="typing_bar">
            <!-- <div id="wordsOrQuotes">
                <div onclick="wordsOrQuotes = 0;">words</div>
                <div onclick="wordsOrQuotes = 0;">quote</div>
            </div> -->
            <div id="difficulty_level">
                <div id="difficulty_0" onclick="difficultyLevel(0)">Easy</div>
                <div id="difficulty_1" onclick="difficultyLevel(1)">Medium</div>
                <div id="difficulty_2" onclick="difficultyLevel(2)">Hard</div>
                <div id="difficulty_3" onclick="difficultyLevel(3)">HardCore</div>
            </div>
            <div id="scoreBordButton" onclick="window.location='{{ route('typingScore') }}'">Score List</div>
        </div>
        <div class="input">
            <input type="text" id="typing_input" autocomplete="off" tabindex="-1" style="opacity:0;position:absolute;left:0;top:0;width:1px;height:1px;">
            <p id="typing_text"></p>
        </div>
        <div id="outputResult" style="display:none;">
            <h1>Resultāti</h1>
            <div id="outputUserName"></div>
            <div id="outputTime"></div>
            <div id="outputAcc"></div>
            <div id="outputWPM"></div>
            <div id="outputIncorrectVord"></div>
        </div>
    </div>
</x-layout>

<style>
.container { width: 700px; margin: 50px auto; font-family: sans-serif; border: 2px solid #ccc; padding: 20px; border-radius: 10px; background: #ffe5c6; }
.typing_bar { display: flex; justify-content: space-between; margin-bottom: 15px; }
#difficulty_level div { display: inline-block; padding: 5px 10px; margin-right: 5px; cursor: pointer; border: solid 2px #E89026; border-radius: 5px }
.selected_difficulty { background: #E89026; color: white;}
#typing_text { min-height: 30px; }
#typing_text span { font-size: 18px; }
.correct { color: green; }
.incorrect { color: red; }
.space-incorrect { background: red; }
.active { text-decoration: underline; }
#outputResult div { margin: 5px 0; }
</style>

<script>
    const inpField = document.querySelector("#typing_input");
    const typingText = document.querySelector("#typing_text");

    let charIndex = 0;
    let startTime = 0;
    let incorrectLetters = 0;
    let incorrectVord = 0;
    let difficultyIndex = 0;
    let oldDifficultyLevel = 0;
    let wordsNumber = 50;
    let wordsOrQuotes = 0;

    let paragraph = "";
    let lastValue = "";

    let words = [];
    let wordStatus = []; 
    const difficulties = [
        {name: "easy", words: 5 },
        {name: "medium", words: 100 },
        {name: "hard", words: 150 },
        {name: "hardCore", words: 300 }
    ];

    window.userName = "{{ Auth::user()->name ?? '' }}";
    const sentences = @json($sentences);

    difficultyLevel(0);

    inpField.addEventListener("input", initTyping);
    inpField.addEventListener("keydown", checkWord);

    // ---------- funkcijas ---------- //
    function difficultyLevel(valueId) {
        const selected = difficulties[valueId];
        wordsNumber = selected.words;

        document.querySelector("#difficulty_" + oldDifficultyLevel).classList.remove("selected_difficulty");
        document.querySelector("#difficulty_" + valueId).classList.add("selected_difficulty");

        oldDifficultyLevel = valueId;

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

        characters.forEach(span => span.classList.remove("active"));

        charIndex = currentValue.length;
        for (let i = 0; i < characters.length; i++) {
            const span = characters[i];
            const typedChar = currentValue[i];

            span.classList.remove("correct","incorrect","space-incorrect");

            if (typedChar === undefined) continue;

            if (typedChar === span.innerText) {
                span.classList.add("correct");
            } else {
                if (span.innerText === " " && typedChar !== " ") {
                    span.classList.add("space-incorrect");
                } else {
                    span.classList.add("incorrect");
                }
            }
        }

        if (characters[charIndex]) characters[charIndex].classList.add("active");

        if (startTime === 0 && currentValue.length > 0) startTime = Date.now();

        lastValue = currentValue;

        if (charIndex === characters.length) {
            inpField.blur();
            resultValues();
        }
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
        let typedWords = inpField.value.trim().split(/\s+/);
        let lastIndex = typedWords.length - 1;
        let lastTypedWord = typedWords[lastIndex];
        let lastRealWord = words[lastIndex];

        if (lastTypedWord !== lastRealWord) {
            if (wordStatus[lastIndex] !== 'incorrect') {
                incorrectVord++;
                wordStatus[lastIndex] = 'incorrect';
            }
        } else {
            if (wordStatus[lastIndex] !== 'correct') {
                wordStatus[lastIndex] = 'correct';
            }
        }

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

        fetch("/typing-game", {
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
                difficulty: difficulties[oldDifficultyLevel].name
            })
        });
    }
</script>
