<x-layout>
    <div class="memory-container">
        <div class="timer">
            <h1>Timer</h1>
            <div id="time">00:00</div>
        </div>
        
        <!-- spēļu laukums 4x5 (20 kārtis - 10 pāri) -->
        <div class="wrapper">
            <ul class="cards">
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-1.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-2.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-3.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-4.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-5.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-6.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-7.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-8.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-9.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-10.png" alt="card-img">
                    </div>
                </li>

                <!-- kārtis atkārtojas -->

                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-1.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-2.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-3.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-4.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-5.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-6.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-7.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-8.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-9.png" alt="card-img">
                    </div>
                </li>
                <li class="card">
                    <div class="view front-view">
                        <span>?</span>
                    </div>
                    <div class="view back-view">
                        <img src="img-10.png" alt="card-img">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</x-layout>

<script>
    const baseImgPath = "{{ asset('card-images') }}"; // points to /public/card-images folder
    const cards = document.querySelectorAll(".card");

    let matchedCard = 0;
    let cardOne, cardTwo;
    let disableDeck = false;
        // Timer variables
        let timerInterval = null;
        let startTime = null;
        let timerStarted = false;

        function startTimer() {
            if (timerStarted) return;
            timerStarted = true;
            startTime = Date.now();
            timerInterval = setInterval(updateTimer, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            timerInterval = null;
        }

        function updateTimer() {
            const now = Date.now();
            const elapsed = Math.floor((now - startTime) / 1000);
            const minutes = String(Math.floor(elapsed / 60)).padStart(2, '0');
            const seconds = String(elapsed % 60).padStart(2, '0');
            document.getElementById('time').textContent = `${minutes}:${seconds}`;
        }

    const cardsArray = [1,2,3,4,5,6,7,8,9,10,1,2,3,4,5,6,7,8,9,10];

    function flipCard(e) {
        // ensure we always get the <li class="card"> element
        let clickedCard = e.target.closest(".card");
        if (!clickedCard || clickedCard === cardOne || disableDeck) return;

            // Start timer on first card click
            if (!timerStarted) {
                startTimer();
            }

        clickedCard.classList.add("flip");

        if (!cardOne) {
            cardOne = clickedCard;
            return;
        }

        cardTwo = clickedCard;
        disableDeck = true;

        let cardOneImg = cardOne.querySelector("img").src,
            cardTwoImg = cardTwo.querySelector("img").src;

        matchCards(cardOneImg, cardTwoImg);
    }

    function matchCards(img1, img2) {
        if (img1 === img2) {
            matchedCard++;

            cardOne.removeEventListener("click", flipCard);
            cardTwo.removeEventListener("click", flipCard);

            cardOne = cardTwo = "";
            disableDeck = false;

            // easy mode: 2 pairs, medium: 6 pairs, hard: 10 pairs
            if (matchedCard === cardsArray.length / 2) {
                    stopTimer();
                    setTimeout(() => shuffleCard(), 1000);
            }
        } else {
            setTimeout(() => {
                cardOne.classList.add("shake");
                cardTwo.classList.add("shake");
            }, 400);

            setTimeout(() => {
                cardOne.classList.remove("shake", "flip");
                cardTwo.classList.remove("shake", "flip");

                cardOne = cardTwo = "";
                disableDeck = false;
            }, 800);
        }
    }

    function shuffleCard() {
        matchedCard = 0;
        cardOne = cardTwo = "";

        // shuffle the array
        let arr = [...cardsArray];
        arr.sort(() => Math.random() > 0.5 ? 1 : -1);

        cards.forEach((card, index) => {
            card.classList.remove("flip");
            let imgTag = card.querySelector("img");
            imgTag.src = `${baseImgPath}/img-${arr[index]}.png`;

            // remove old listener first, then add it
            card.removeEventListener("click", flipCard);
            card.addEventListener("click", flipCard);
        });
            // Reset timer
            timerStarted = false;
            document.getElementById('time').textContent = '00:00';
            stopTimer();
    }

    shuffleCard();
</script>