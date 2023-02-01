export function changeDepartments() {
    //TODO: refactoring!!!
    const departmentsRows = document.querySelectorAll('.row-department');

    const getTipMessageTemplate = document.querySelector("#tip-message");
    const tipMessage = getTipMessageTemplate.content.cloneNode(true);
    const rootMessage = document.querySelector('#departments-list');
    if (rootMessage) {
        if (!sessionStorage.getItem(`is-tip-department-show`) || sessionStorage.getItem(`is-tip-department-show`) === 'false') {
            sessionStorage.setItem(`is-tip-department-show`, 'false');
            rootMessage.appendChild(tipMessage);
        }
    }

    departmentsRows.forEach((row) => row.addEventListener('click', (event) => {
        event.stopPropagation();

        if (document.querySelector('#form-department')) {
            const index = document.querySelector('#form-department').dataset.id;
            const rows = document.querySelectorAll('.row-department');

            rows.forEach((row) => {
                const rowToShow = row.querySelector('#index');
                if (rowToShow.innerText === index) {
                    rowToShow.parentElement.classList.remove("hidden")
                }
            })
            document.querySelector('#form-department').remove();
        }

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

        form.querySelector('button').addEventListener('click', () => {
            form.querySelector('input[name="action"]').value = 'delete';
            form.submit();
        })

        if (sessionStorage.getItem(`is-tip-department-show`) === 'false') {
            sessionStorage.setItem(`is-tip-department-show`, 'true');
            document.querySelector('#tip-message-wrapper').remove();
        }
    }))
}

document.addEventListener('click', function (event) {
    const form = document.querySelector('#form-department');
    if (form) {
        let isClickInside = form.contains(event.target);

        if (!isClickInside) {
            const index = form.dataset.id;
            const rows = document.querySelectorAll('.row-department');

            rows.forEach((row) => {
                const rowToShow = row.querySelector('#index');
                if (rowToShow.innerText === index) {
                    rowToShow.parentElement.classList.remove("hidden")
                }
            })
            form.remove();
        }
    }
});