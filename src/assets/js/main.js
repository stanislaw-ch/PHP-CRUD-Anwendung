import {errorFadeout} from "./errorFadeout.js";
import {changeDepartments} from "./changeDepartments.js";
import {addEventToButtons} from "./eventButtons.js";

addEventToButtons();
errorFadeout();
changeDepartments();

//TODO: refactoring!!!

const employeesRows = document.querySelectorAll('.row-employee');

const tipMessage = document.querySelector('#tip-employee');
if (tipMessage && sessionStorage.getItem(`is-tip-employee-show`) === null) {
    tipMessage.classList.remove('hidden')
}

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

employeesRows.forEach((row) => row.addEventListener('click', () => {
    const employeeTemplate = document.querySelector("#employeeRowForm");
    const employeeForm = employeeTemplate.content.cloneNode(true);

    const index = row.querySelector('#index').innerText;
    const firstname = row.querySelector('#firstname').innerText;
    const lastname = row.querySelector('#lastname').innerText;
    const labelGender = row.querySelector('#gender').innerText;
    const salary = row.querySelector('#salary').innerText;
    const department = row.querySelector('#department').innerText;

    employeeForm.querySelector('#index').innerText = index;
    employeeForm.querySelector('#firstname').value = firstname;
    employeeForm.querySelector('#lastname').value = lastname;

    const genders = getGenders();
    const genderTemplate = document.querySelector("#employeeGender");
    const rootGender = employeeForm.querySelector('#gender');

    genders.forEach((item, index) => {
        const gender = genderTemplate.content.cloneNode(true);
        gender.querySelector('input').value = item.value;
        gender.querySelector('label').innerText = item.label;

        labelGender === item.label ? gender.querySelector('input').checked = true : null;

        rootGender.appendChild(gender);
    })

    const departments = getDepartments();
    const rootSelect = employeeForm.querySelector('select');

    departments.forEach((item, index) => {
        const option = document.createElement('option');
        option.value = item.value;
        option.innerText = item.label;

        labelGender === item.label ? department.querySelector('input').checked = true : null;

        rootSelect.appendChild(option);
    })

    // employeeForm.querySelector('#gender').value = gender;
    employeeForm.querySelector('#salary').value = salary;
    // employeeForm.querySelector('#department').value = department;

    const id = row.querySelector('input[name="id"]').value;

    row.parentElement.insertBefore(employeeForm, row.nextElementSibling)
    row.classList.add("hidden");

    const form = document.querySelector('#form-employee');

    document.querySelector('#form-employee input').focus();

    form.querySelector('input[name="id"]').value = id;
    form.addEventListener('focusout', function(event) {
        const isClickInside = form.contains(event.relatedTarget);
        if (isClickInside) {
            form.querySelector('#delete').addEventListener('click', () => {
                form.querySelector('input[name="action"]').value = 'delete';
                form.submit();
            })
            form.querySelector('#update').addEventListener('click', () => {
                form.querySelector('input[name="action"]').value = 'update';
                form.submit();
            })
        }
        else {
            row.classList.remove("hidden");
            form.remove();
        }
    });

    if (tipMessage && sessionStorage.getItem(`is-tip-show`) === null) {
        sessionStorage.setItem(`is-tip-employee-show`, 'true');
        tipMessage.classList.add('hidden')
    }
}))





