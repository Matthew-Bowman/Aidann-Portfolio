// Scrolling Functionality
const scrollIndicators = document.querySelectorAll(`.scroll-indicator`);

scrollIndicators.forEach(indicator => {
    indicator.addEventListener(`click`, () => {
        let scrollElem = document.querySelector(`#${indicator.id.split(`-`)[1]}`);
        console.log(scrollElem);
        window.scrollTo(0, scrollElem.offsetTop);
    });
});

const scrollIds = [
    `home`, `about`, `prices`, `terms`, `contact`
]

let scrollIndex = 0;
const scrollButton = document.getElementById(`scroll-button`);

scrollButton.addEventListener(`click`, () => {
    if(scrollIndex < scrollIds.length-1)
        scrollIndex++;
    
    ScrollSections();
})

document.addEventListener(`wheel`, e => {
    if(e.deltaY < 0 && scrollIndex > 0)
        scrollIndex--;
    else if (e.deltaY > 0 && scrollIndex < scrollIds.length-1)
        scrollIndex++;

    ScrollSections();
})

function ScrollSections() {
    // Reset selected section
    scrollIds.forEach(section => {
        document.getElementById(section).classList.remove(`selected`);
    })

    if(scrollIndex == scrollIds.length-1)
        scrollButton.style.display = `none`;
    else
        scrollButton.style.display = `flex`;

    let elem = document.querySelector(`#${scrollIds[scrollIndex]}`)

    elem.classList.add(`selected`);
    window.scrollTo(0, elem.offsetTop - window.innerHeight/2 + elem.clientHeight/2);
}