// Admin Panel Selections
const options = document.querySelectorAll(`.panel-option`);

options.forEach(option => {
  option.addEventListener(`click`, (e) => {

    // Reset Active
    options.forEach(o => o.classList.remove(`active`));

    // Set Active
    option.classList.add(`active`);

    // Reset display of all sections
    document.querySelectorAll(".content > section").forEach(e => e.style.display = "none");

    // Make selected section visible
    document.querySelector(`#option-${option.id.split('-')[1]}`).style.display = "block";
  });
});