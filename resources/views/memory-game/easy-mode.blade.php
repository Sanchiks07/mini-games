<script>
    const cards = document.querySelectorAll(".card");

    let matchedCard = 0;
    let cardOne, cardTwo;
    let disableDeck = false;

    function flipCard(e){
        let clickedCard = e.target; // dabū user nospiesto kārti

        if(clickedCard !== cardOne && !disableDeck) {
            clickedCard.classList.add("flip");
            if(!cardOne) {
                // atgriež cardOne value uz clickerCard
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
        if(img1 === img2) { // pārbauda vai divu kāršu img sakrīt
            matchedCard++;
            // ja matched value sakrīt ar 2, tad visas kārtis ir atradušas savu match (2*2=4)
            if(matchedCard == 2){
                setTimeout(() => {
                    return shuffleCard();
                }, 1000); // izsauc shuffleCard funkciju pēc 1s
            }
            cardOne.removeEventListener("click", flipCard);
            cardTwo.removeEventListener("click", flipCard);
            cardOne = cardTwo = ""; // uzstāda abu kāršu value uz blank
            return disableDeck = false;
        }
        // ja divas kārtis neskrīt
        setTimeout(() => {
            // pievieno shake class abām kārtīm pēc 400ms
            cardOne.classList.add("shake");
            cardTwo.classList.add("shake");
        }, 400);

        setTimeout(() => {
            // noņem shake un flip class abām kārtīm pēc 1.2s
            cardOne.classList.remove("shake", "flip");
            cardTwo.classList.remove("shake", "flip");
            cardOne = cardTwo = ""; // uzstāda abu kāršu value uz blank
            disableDeck = false;
        }, 1200);
    }

    function shuffleCard() {
        matchedCard = 0;
        cardOne = cardTwo = "";
        // izveido array ar 4 items (2 pāri)
        let arr = [7, 8, 7, 8];
        arr.sort(() => Math.random() > 0.5 ? 1 : -1); // sakārto array items random veidā

        // noņem flip class visām kārtīm un padod random bildi katrai kārtij
        cards.forEach((card, index) => {
            card.classList.remove("flip");
            let imgTag = card.querySelector("img");
            imgTag.src = `img-${arr[index]}.png`;
            card.addEventListener("click", flipCard);
        });
    }

    shuffleCard();

    cards.forEach(card => { // pievieno click event visām kārtīm
        card.addEventListener("click", flipCard);
    });

    // shuffleCard funkcija tike izsaukta divreiz - refresho mājaslapu un visas kārtis tika matchotas
</script>

<x-layout>
    <!-- spēļu laukums 2x2 (4 kārtis - 2 pāri) -->
    <div class="wrapper">
        <ul class="cards">
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
            
            <!-- kārtis atkārtojas -->
            
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
        </ul>
    </div>
</x-layout>