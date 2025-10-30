<script>
    const cards = document.querySelectorAll(".card");

    let matchedCard = 0;
    let cardOne, cardTwo;
    let disableDeck = false;

    function flipCard(e) {
        let clickedCard = e.target;

        if (clickedCard !== cardOne && !disableDeck) {
            clickedCard.classList.add("flip");
            if (!cardOne) {
                return cardOne = clickedCard;
            }
            cardTwo = clickedCard;
            disableDeck = true;
            let cardOneImg = cardOne.querySelector("img").src,
                cardTwoImg = cardTwo.querySelector("img").src;
            matchCards(cardOneImg, cardTwoImg);
        }
    }

    function matchCards(img1, img2) {
        if (img1 === img2) {
            matchedCard++;
            // for hard mode: 10 pairs total
            if (matchedCard === 10) {
                setTimeout(() => {
                    return shuffleCard();
                }, 1000);
            }
            cardOne.removeEventListener("click", flipCard);
            cardTwo.removeEventListener("click", flipCard);
            cardOne = cardTwo = "";
            return disableDeck = false;
        }

        setTimeout(() => {
            cardOne.classList.add("shake");
            cardTwo.classList.add("shake");
        }, 400);

        setTimeout(() => {
            cardOne.classList.remove("shake", "flip");
            cardTwo.classList.remove("shake", "flip");
            cardOne = cardTwo = "";
            disableDeck = false;
        }, 1200);
    }

    function shuffleCard() {
        matchedCard = 0;
        cardOne = cardTwo = "";
        // create array with 20 items (10 pairs)
        let arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        arr.sort(() => Math.random() > 0.5 ? 1 : -1);

        cards.forEach((card, index) => {
            card.classList.remove("flip");
            let imgTag = card.querySelector("img");
            imgTag.src = `img-${arr[index]}.png`;
            card.addEventListener("click", flipCard);
        });
    }

    shuffleCard();

    cards.forEach(card => {
        card.addEventListener("click", flipCard);
    });
</script>

<x-layout>
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
</x-layout>