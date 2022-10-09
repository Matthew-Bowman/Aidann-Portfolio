const cardThumbnails = document.querySelectorAll(`.thumbnail`);
const carouselViewer = document.querySelector(`.carousel-viewer`);
const buttonLeft = document.querySelector(`#button-left`);
const buttonRight = document.querySelector(`#button-right`);
const img = carouselViewer.querySelector(`img`);
let viewing = false;
let position;

cardThumbnails.forEach(thumbnail => thumbnail.addEventListener(`click`, e => {
    if(viewing == false) {
        viewing = true;
        // RESET and populate pictures array
        pictures = [];
        e.target.parentElement.querySelector(`.carousel-container`).querySelectorAll(`.carousel-item`).forEach(element => pictures.push(element.value));
        
        // Display Carousel
        carouselViewer.style.display = "flex";
        document.body.style.overflow = "hidden";
        carouselViewer.querySelector(`img`).src = pictures[0];
        carouselViewer.style.top = `${window.scrollY}px`
        position = 0;
    }
}));

document.addEventListener(`click`, e => {
    if(viewing && !e.target.classList.contains("carousel-controls") && !e.target.classList.contains("thumbnail")) {
        carouselViewer.style.display = `none`;
        document.body.style.overflow = `auto`;
        viewing = false;
    }
});

const moveRight = () => {
    if(position >= pictures.length - 1) {
        position = 0;
        img.src = pictures[position];
        return;
    }
    img.src = pictures[position+1];
    position++;
    console.log(pictures);
    console.log(position);
}

const moveLeft = () => {
    if (position < 1) {
        position = pictures.length -1;
        img.src = pictures[position];
        return;
    }
    img.src = pictures[position-1];
    position--;
}

buttonRight.addEventListener("click", moveRight);
buttonLeft.addEventListener("click", moveLeft);