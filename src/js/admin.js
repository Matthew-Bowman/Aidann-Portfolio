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
    let imagesInput = document.createElement("textarea");
  
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

    imagesInput.classList.add("paragraph", "auto-resize");
    imagesInput.setAttribute("name", "images[]");
    imagesInput.placeholder = "Images";
    imagesInput.setAttribute("maxlength", "255");

    // Add Event Listeners
    thumbnailInput.addEventListener("change", e => {
      thumbnailInput.parentElement.parentElement.querySelector("img").src = thumbnailInput.value;
    })

    descriptionInput.addEventListener("input", e => {
      descriptionInput.style.height = 0;
      descriptionInput.style.height = descriptionInput.scrollHeight + "px";
    })

    imagesInput.addEventListener("input", () => {
      imagesInput.style.height = 0;
      imagesInput.style.height = descriptionInput.scrollHeight + "px";
    })

    // Append Elements
    cardFooter.appendChild(idInput);
    cardFooter.appendChild(thumbnailInput);
    cardFooter.appendChild(typeInput);
    cardFooter.appendChild(nameInput);
    cardFooter.appendChild(descriptionInput);
    cardFooter.appendChild(imagesInput);
    
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

// Check for homepage events
const homepageButtons = document.querySelectorAll(`.homepage-button`);

homepageButtons.forEach(btn => {
  btn.addEventListener(`click`, e => {
    e.preventDefault();
    let fieldset = (btn.parentElement.parentElement);

    switch(btn.id) {
      case "up":
        if(fieldset.previousElementSibling)
          fieldset.parentElement.insertBefore(fieldset, fieldset.previousElementSibling);
        break;
      case "delete":
        fieldset.remove();
        break;
      case "down":
        if(fieldset.nextElementSibling)
          fieldset.parentElement.insertBefore(fieldset.nextElementSibling, fieldset);
        break;
    }
  })
})

// Add or remove indent dependant on select type 
const homepageSelects = document.querySelectorAll(".homepage-selector");
homepageSelects.forEach(select => {
  select.addEventListener("change", e => {
    if(select.value != "subtitle")
      select.parentElement.classList.add("indent")
    else if (select.parentElement.classList.contains("indent"))
      select.parentElement.classList.remove("indent");
  })
})

// Add new homepage element
let homepageAddBtns = document.querySelectorAll(`#homepage-add`);

homepageAddBtns.forEach(homepageAdd => homepageAdd.addEventListener(`click`, e => {
  e.preventDefault();
  
  // Create Elements
  let fieldset = document.createElement(`fieldset`);
  let select = document.createElement(`select`);
  let optionTitle = document.createElement(`option`);
  let optionSubtitle = document.createElement(`option`);
  let optionHeading = document.createElement(`option`);
  let optionInlineSubheading = document.createElement(`option`);
  let optionParagraphHeading = document.createElement(`option`);
  let optionParagraph = document.createElement(`option`);
  let optionListItem = document.createElement(`option`);
  let optionGoogleIcon = document.createElement(`option`);
  let optionUrlIcon = document.createElement(`option`);
  let textarea = document.createElement(`textarea`);
  let buttonContainer = document.createElement(`div`);
  let upButton = document.createElement(`button`);
  let upButtonSpan = document.createElement(`button`);
  let deleteButton = document.createElement(`button`);
  let deleteButtonSpan = document.createElement(`button`);
  let downButton = document.createElement(`button`);
  let downButtonSpan = document.createElement(`button`);
  
  // Attribute Elements
  fieldset.classList.add("homepage-fieldset");

  select.setAttribute("name", "type[]");
  select.classList.add("type-select", "subheading");

  optionTitle.setAttribute("value", "title");
  optionTitle.textContent = "Title";

  optionSubtitle.setAttribute("value", "subtitle");
  optionSubtitle.textContent = "Subtitle";
  optionSubtitle.setAttribute("selected", true);

  optionHeading.setAttribute("value", "heading");
  optionHeading.textContent = "Heading";

  optionInlineSubheading.setAttribute("value", "inline-subheading");
  optionInlineSubheading.textContent = "Inline Subheading";

  optionParagraphHeading.setAttribute("value", "paragraph-headinig");
  optionParagraphHeading.textContent = "Paragraph Heading";

  optionParagraph.setAttribute("value", "paragraph");
  optionParagraph.textContent = "Paragraph";

  optionListItem.setAttribute("value", "list-item");
  optionListItem.textContent = "List Item";

  optionGoogleIcon.setAttribute("value", "icon-google");
  optionGoogleIcon.textContent = "Google Icon";

  optionUrlIcon.setAttribute("value", "icon-url");
  optionUrlIcon.textContent = "Icon URL";

  textarea.setAttribute("name", "content[]");
  textarea.classList.add("paragraph", "homepage-textarea", "auto-resize");
  textarea.textContent = "Content";

  buttonContainer.classList.add("homepage-button-container");

  upButton.classList.add("homepage-button");
  upButton.id = "up";

  upButtonSpan.classList.add("material-symbols-outlined");
  upButtonSpan.textContent = "arrow_upward";

  deleteButton.classList.add("homepage-button");
  deleteButton.id = "delete";

  deleteButtonSpan.classList.add("material-symbols-outlined");
  deleteButtonSpan.textContent = "delete";

  downButton.classList.add("homepage-button");
  downButton.id = "down";

  downButtonSpan.classList.add("material-symbols-outlined");
  downButtonSpan.textContent = "arrow_downward";

  // Append Children
  upButton.appendChild(upButtonSpan);
  deleteButton.appendChild(deleteButtonSpan);
  downButton.appendChild(downButtonSpan);

  buttonContainer.appendChild(upButton);
  buttonContainer.appendChild(deleteButton);
  buttonContainer.appendChild(downButton);

  buttonContainer.childNodes.forEach(btn => {
    btn.addEventListener(`click`, e => {
      e.preventDefault();
      let fieldset = (btn.parentElement.parentElement);
  
      switch(btn.id) {
        case "up":
          if(fieldset.previousElementSibling)
            fieldset.parentElement.insertBefore(fieldset, fieldset.previousElementSibling);
          break;
        case "delete":
          fieldset.remove();
          break;
        case "down":
          if(fieldset.nextElementSibling)
            fieldset.parentElement.insertBefore(fieldset.nextElementSibling, fieldset);
          break;
      }
    })
  })

  select.appendChild(optionTitle);
  select.appendChild(optionSubtitle);
  select.appendChild(optionHeading);
  select.appendChild(optionInlineSubheading);
  select.appendChild(optionParagraphHeading);
  select.appendChild(optionParagraph);
  select.appendChild(optionListItem);
  select.appendChild(optionGoogleIcon);
  select.appendChild(optionUrlIcon);

  select.addEventListener("change", e => {
    if(select.value != "subtitle")
      fieldset.classList.add("indent")
    else if (fieldset.classList.contains("indent"))
      fieldset.classList.remove("indent");
  })

  fieldset.appendChild(select);
  fieldset.appendChild(textarea);
  fieldset.appendChild(buttonContainer);

  // Append to form
  homepageAdd.parentElement.insertBefore(fieldset, homepageAdd);

}));