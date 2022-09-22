// Admin Panel Selections
const options = document.querySelectorAll(`.panel-option`);

options.forEach(option => {
  option.addEventListener(`click`, (e) => {

    // Reset Active
    options.forEach(o => o.classList.remove(`active`));

    // Set Active
    option.classList.add(`active`);
  });
});