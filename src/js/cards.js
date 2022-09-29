const cardThumbnails = document.querySelectorAll(`.thumbnail`);
let position = 0;
let active = false;

cardThumbnails.forEach(thumbnail => {
    thumbnail.addEventListener("click", () => {
        thumbnail.parentElement.querySelector(`.carousel-container`).classList.remove("hidden");
        document.body.style.overflow = "hidden";

        position = 0;
        active = true
    });
});

document.addEventListener(`click`, e => {
    document.querySelectorAll(`.carousel-container`).forEach(container => {
        let thumbnail = !e.target.classList.contains("thumbnail");
        let moveLeft = !e.target.classList.contains("move-left");
        let moveRight = !e.target.classList.contains("move-right");
        let item = !e.target.classList.contains("carousel-item");
        if((thumbnail && moveLeft && moveRight && item) && active == true) {
            container.classList.add("hidden");
            console.log((thumbnail && moveLeft && moveRight && item && itemContainer));
        }
    })
})

const moveLeft = document.querySelectorAll(".move-left");
const moveRight = document.querySelectorAll(".move-right");

moveLeft.forEach(btn => {
    btn.addEventListener(`click`, e => {
        if(position > 0)
            position--
    
        UpdateDisplay(btn);
    });
});

moveRight.forEach(btn => {
    btn.addEventListener(`click`, e => {
        const images = btn.parentElement.querySelectorAll(`img`);

        if(position < images.length-1)
            position++;

        UpdateDisplay(btn);
    })
})

function UpdateDisplay(btn) {
    btn.parentElement.querySelectorAll(`img`).forEach(img => img.classList.add("hidden"));
    btn.parentElement.querySelectorAll(`img`)[position].classList.remove("hidden");
}