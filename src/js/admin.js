// Assign Variables
const options = document.querySelectorAll(`.panel-option`);
const textareas = document.querySelectorAll(".auto-resize")

// Admin Panel Selections
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
  
    // Resize textareas
    textareas.forEach(textarea => textarea.style.height = textarea.scrollHeight + "px");
  });
});

// Change Thumbnail when URL Changed
document.querySelectorAll(".img-url").forEach(input => {
  input.addEventListener("change", e => {
    input.parentElement.parentElement.querySelector("img").src = input.value;
  })
})

// Auto resize textarea

textareas.forEach(textarea => {
  textarea.style.height = textarea.scrollHeight + "px";
  textarea.addEventListener("input", e => {
    textarea.style.height = 0;
    textarea.style.height = textarea.scrollHeight + "px";
  })
})