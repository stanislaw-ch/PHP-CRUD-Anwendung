import {
    showTipMessage,
    hideOnClickOutside,
    hideTipMessage,
    hideFormOnNeighborClick,
    submitOnButtonClick
} from "./utils.js";

export function changeEmployees() {
    const employeesRows = document.querySelectorAll('.row-employee');
    showTipMessage('#employees-list', 'is-tip-employee-show');

    //TODO: get data from server
    const getGenders = function () {
        const radioInputs = document.querySelectorAll('form input[type=radio]');
        const radioLabels = document.querySelectorAll('form input[type=radio] + label');
        let genders = [];
        radioInputs.forEach((input, index) => {
            const name = input.name;
            const value = input.value;
            genders[index] = {"name": name, "value": value};
        });
        radioLabels.forEach((label, index) => {
            const name = label.innerText;
            genders[index] = Object.assign(genders[index], {"label": name});
        });

        return genders;
    }

    //TODO: get data from server
    const getDepartments = function () {
        const select = document.querySelector('form select');
        const options = document.querySelectorAll('form select > option');
        let departments = [];

        options.forEach((option, index) => {
            const value = option.value;
            const label = option.innerText;
            departments[index] = {"name": select.name, "value": value, "label": label};
        });

        return departments;
    }

    employeesRows.forEach((row) => row.addEventListener('click', (event) => {
        event.stopPropagation();
        hideFormOnNeighborClick('#form-employee', '.row-employee');

        const employeeTemplate = document.querySelector("#employee-row-form");
        const employeeForm = employeeTemplate.content.cloneNode(true);

        const index = row.querySelector('#index').innerText;
        const firstname = row.querySelector('#firstname').innerText;
        const lastname = row.querySelector('#lastname').innerText;
        const labelGender = row.querySelector('#gender').innerText;
        const salary = row.querySelector('#salary').innerText;
        const department = row.querySelector('#department').innerText;
        const id = row.querySelector('input[name="id"]').value;

        employeeForm.querySelector('#index').innerText = index;
        employeeForm.querySelector('#firstname').value = firstname;
        employeeForm.querySelector('#lastname').value = lastname;
        employeeForm.querySelector('form').dataset.id = index;
        employeeForm.querySelector('#salary').value = salary;

        const genders = getGenders();
        const genderTemplate = document.querySelector("#employee-gender");
        const rootGender = employeeForm.querySelector('#gender');

        const departments = getDepartments();
        const rootSelect = employeeForm.querySelector('select');

        genders.forEach((item) => {
            const gender = genderTemplate.content.cloneNode(true);
            gender.querySelector('input').value = item.value;
            gender.querySelector('input').id = item.value;
            gender.querySelector('label').innerText = item.label;
            gender.querySelector('label').htmlFor = item.value;

            labelGender === item.label ? gender.querySelector('input').checked = true : null;

            rootGender.appendChild(gender);
        })

        departments.forEach((item) => {
            const option = document.createElement('option');
            option.value = item.value;
            option.innerText = item.label;

            labelGender === item.label ? department.querySelector('input').checked = true : null;

            rootSelect.appendChild(option);
        })

        row.parentElement.insertBefore(employeeForm, row.nextElementSibling)
        row.classList.add("hidden");

        const form = document.querySelector('#form-employee');
        form.querySelector('input').focus();
        form.querySelector('input[name="id"]').value = id;

        submitOnButtonClick(form, '#delete', 'delete');
        submitOnButtonClick(form, '#update', 'update');
        hideTipMessage('#tip-message-wrapper', 'is-tip-employee-show');
    }))
}

hideOnClickOutside('#form-employee', '.row-employee');