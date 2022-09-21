const scrollIndicators = document.querySelectorAll(`.scroll-indicator`);

scrollIndicators.forEach(indicator => {
    indicator.addEventListener(`click`, () => {
        let scrollElem = document.querySelector(`#${indicator.id.split(`-`)[1]}`);
        console.log(scrollElem);
        window.scrollTo(0, scrollElem.offsetTop);
    });
});