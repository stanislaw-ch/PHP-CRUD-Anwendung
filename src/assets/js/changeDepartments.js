import {
    showTipMessage,
    hideOnClickOutside,
    hideTipMessage,
    hideFormOnNeighborClick,
    submitOnButtonClick
} from "./utils.js";

export function changeDepartments() {
    const departmentsRows = document.querySelectorAll('.row-department');
    showTipMessage('#departments-list', 'is-tip-department-show');

    departmentsRows.forEach((row) => row.addEventListener('click', (event) => {
        event.stopPropagation();
        hideFormOnNeighborClick('#form-department', '.row-department');

        const getDepartmentTemplate = document.querySelector("#department-row-form");
        const departmentForm = getDepartmentTemplate.content.cloneNode(true);

        const index = row.querySelector('#index').innerText;
        const department = row.querySelector('#name').innerText;

        departmentForm.querySelector('#index').innerText = index;
        departmentForm.querySelector('#name').value = department;
        departmentForm.querySelector('form').dataset.id = index;

        const id = row.querySelector('input[name="id"]').value;

        row.parentElement.insertBefore(departmentForm, row.nextElementSibling)
        row.classList.add("hidden");

        const form = document.querySelector('#form-department');
        document.querySelector('#form-department input').focus();
        form.querySelector('input[name="id"]').value = id;

        submitOnButtonClick(form, '#update', 'update');
        submitOnButtonClick(form, '#delete', 'delete');
        hideTipMessage('#tip-message-wrapper', 'is-tip-department-show');
    }))
}

hideOnClickOutside('#form-department', '.row-department');