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

// Create new fieldset in form for card creation
const placeholders = document.querySelectorAll(`.card-placeholder`);

placeholders.forEach(placeholder => {
  placeholder.addEventListener("click", e => {
    // Create Elements
    let fieldset = document.createElement(`fieldset`);
    let thumbnail = document.createElement(`img`);
    let cardFooter = document.createElement(`div`);
    let idInput = document.createElement(`input`);
    let thumbnailInput = document.createElement(`input`);
    let typeInput = document.createElement(`input`);
    let nameInput = document.createElement(`input`);
    let descriptionInput = document.createElement(`textarea`);
  
    // Give Attributes to Elements
    fieldset.classList.add("option-card");

    thumbnail.src = "";
    thumbnail.classList.add("thumbnail");

    cardFooter.classList.add("card-footer");

    idInput.setAttribute("type", "hidden");
    idInput.setAttribute("value", "NULL");
    idInput.setAttribute("name", "id[]");

    thumbnailInput.classList.add("paragraph", "img-url");
    thumbnailInput.setAttribute("name", "thumbnail[]");
    thumbnailInput.setAttribute("value", "");
    thumbnailInput.setAttribute("maxlength", "255");

    typeInput.classList.add("subheading", "blue");
    // Check type
    if(placeholder.id == `placeholder-work`) {
      typeInput.setAttribute("name", "type[]");
      typeInput.setAttribute("value", "Type");
    } else if (placeholder.id == `placeholder-review`) {
      typeInput.setAttribute("name", "rating[]");
      typeInput.setAttribute("value", "Rating");
    }
    typeInput.setAttribute("maxlength", "255");

    nameInput.classList.add("heading");
    nameInput.setAttribute("name", "name[]");
    nameInput.setAttribute("value", "Name");
    nameInput.setAttribute("maxlength", "255");

    descriptionInput.classList.add("paragraph", "auto-resize");
    descriptionInput.setAttribute("name", "description[]");
    descriptionInput.textContent = "Description";
    descriptionInput.setAttribute("maxlength", "255");

    // Add Event Listeners
    thumbnailInput.addEventListener("change", e => {
      thumbnailInput.parentElement.parentElement.querySelector("img").src = thumbnailInput.value;
    })

    descriptionInput.addEventListener("input", e => {
      descriptionInput.style.height = 0;
      descriptionInput.style.height = descriptionInput.scrollHeight + "px";
    })

    // Append Elements
    cardFooter.appendChild(idInput);
    cardFooter.appendChild(thumbnailInput);
    cardFooter.appendChild(typeInput);
    cardFooter.appendChild(nameInput);
    cardFooter.appendChild(descriptionInput);
    
    fieldset.appendChild(thumbnail);
    fieldset.appendChild(cardFooter);

    placeholder.parentElement.insertBefore(fieldset, placeholder);
  });
});

// Check for deleting
const deleteButtons = document.querySelectorAll(".delete-button");

deleteButtons.forEach(button => {
  button.addEventListener(`click`, e => {
    e.preventDefault();

    const id = button.getAttribute(`data-id`);

    let form = document.createElement("form");
    if(button.id == `delete-work`) form.setAttribute("action", "./deleteWorks.php");
    if(button.id == `delete-review`) form.setAttribute("action", "./deleteReview.php");
    form.setAttribute("method", "post");

    let idInput = document.createElement("input");
    idInput.setAttribute("type", "hidden");
    idInput.setAttribute("value", id);
    idInput.setAttribute("name", "id");

    let submit = document.createElement("input");
    submit.setAttribute("type", "submit");
    submit.setAttribute("name", "submit-button");

    form.appendChild(idInput);
    form.appendChild(submit);

    document.body.appendChild(form);
    form.submit()
  })
});