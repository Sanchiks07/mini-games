<x-layout>
    <div class="memory-container">
        <div class="timer">
            <h1>Timer</h1>
            <div id="time">00:00</div>
        </div>
        
        <div class="score-popup-overlay"></div>
        <div class="score-popup">
            <h2>Game Complete!</h2>
            <p>Your time: <span id="final-time">00:00</span></p>
            <div class="buttons">
                <button class="small-pretty" onclick="playAgain()">Play Again</button>
                <button class="small-pretty" onclick="window.location.href='{{ route('modes') }}'">Choose Mode</button>
            </div>
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
                    saveScore();
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

    function saveScore() {
        const elapsed = Math.floor((Date.now() - startTime) / 1000);
        // Save score to database via AJAX (graceful if CSRF meta is missing)
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = tokenMeta ? tokenMeta.getAttribute('content') : null;
        if (!csrfToken) {
            console.warn('CSRF token meta tag not found. Proceeding without CSRF header.');
        }

        (async () => {
            try {
                await fetch('{{ route("memory-game.save-score") }}', {
                    method: 'POST',
                    headers: Object.assign({ 'Content-Type': 'application/json' }, csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
                    body: JSON.stringify({
                        time_seconds: elapsed,
                        mode: 'hard'
                    })
                });
            } catch (err) {
                console.error('Failed to save score:', err);
            } finally {
                // Show popup with final time regardless of save result
                document.getElementById('final-time').textContent = document.getElementById('time').textContent;
                const overlay = document.querySelector('.score-popup-overlay');
                const popup = document.querySelector('.score-popup');
                if (overlay) overlay.style.display = 'block';
                if (popup) {
                    popup.style.display = 'block';
                    popup.classList.add('show');
                }
            }
        })();
    }

    function playAgain() {
        // Hide popup
        const overlay = document.querySelector('.score-popup-overlay');
        const popup = document.querySelector('.score-popup');
        if (overlay) overlay.style.display = 'none';
        if (popup) {
            popup.style.display = 'none';
            popup.classList.remove('show');
        }
        // Reset and shuffle
        shuffleCard();
    }

    // Allow clicking the overlay to close the popup
    document.addEventListener('click', (e) => {
        const overlay = document.querySelector('.score-popup-overlay');
        if (!overlay) return;
        if (e.target === overlay) playAgain();
    });
</script>