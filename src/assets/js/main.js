import {addEventToButtons} from "./eventButtons.js";
import {errorFadeout} from "./errorFadeout.js";

addEventToButtons();
errorFadeout();

const departmentsRows = document.querySelectorAll('.row-department');

departmentsRows.forEach((row) => row.addEventListener('click', () => {
    const getDepartmentTemplate = document.querySelector("#departmentRow");
    const departmentForm = getDepartmentTemplate.content.cloneNode(true);

    const index = row.querySelector('#index').innerText;
    const department = row.querySelector('#name').innerText;
    const amountEmployees = row.querySelector('#amount-employees').innerText;

    departmentForm.querySelector('#index').innerText = index;
    departmentForm.querySelector('#name').value = department;

    const id = row.querySelector('input[name="id"]').value;

    row.parentElement.insertBefore(departmentForm, row.nextElementSibling)
    row.classList.add("hidden");

    document.querySelector('#form input').focus();

    const form = document.querySelector('#form');
    form.querySelector('input[name="id"]').value = id;
    form.addEventListener('focusout', function(event) {
        const isClickInside = form.contains(event.relatedTarget);
        if (isClickInside) {
            form.querySelector('input[name="action"]').value = 'delete';
            form.submit();
        }
        else {
            row.classList.remove("hidden");
            form.remove();
        }
    });
}))





