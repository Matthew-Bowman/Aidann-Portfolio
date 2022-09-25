// Scrolling Functionality
const scrollIndicators = document.querySelectorAll(`.scroll-indicator`);

scrollIndicators.forEach((indicator) => {
  indicator.addEventListener(`click`, () => {
    let scrollElem = document.querySelector(`#${indicator.id.split(`-`)[1]}`);
    console.log(scrollElem);
    window.scrollTo(0, scrollElem.offsetTop);
  });
});

let scrollIds = [`home`];

document.body.childNodes.forEach(node => {
  if(node.id)
    if(node.id.startsWith("scrollable-"))
      scrollIds.push(node.id);
});

let scrollIndex = 0;
const scrollButton = document.getElementById(`scroll-button`);

scrollButton.addEventListener(`click`, () => {
  if (scrollIndex < scrollIds.length - 1) processScroll(1);
});

document.addEventListener(`wheel`, (e) => {
  processScroll(e.deltaY)
}, {passive: false});

document.addEventListener("mousewheel", () => {}, {passive: false})
document.addEventListener("DOMMouseScroll", () => {}, {passive: false})

function debounce(func, timeout = 300){
  let timer;
  return (...args) => {
    if (!timer) {
      func.apply(this, args);
    }
    clearTimeout(timer);
    timer = setTimeout(() => {
      timer = undefined;
    }, timeout);
  };
}

function ScrollSections(direction) {
  if(direction > 0 && scrollIndex < scrollIds.length-1)
    scrollIndex++;
  else if(direction < 0 && scrollIndex > 0)
    scrollIndex--;

  // Reset selected section
  scrollIds.forEach((section) => {
    document.getElementById(section).classList.remove(`selected`);
  });

  if (scrollIndex == scrollIds.length - 1) scrollButton.style.opacity = 0;
  else scrollButton.style.opacity = 1;

  let elem = document.querySelector(`#${scrollIds[scrollIndex]}`);
  elem.classList.add(`selected`);
  window.scrollTo(
    0,
    elem.offsetTop - window.innerHeight / 2 + elem.clientHeight / 2
  );
}

const processScroll = debounce(ScrollSections);