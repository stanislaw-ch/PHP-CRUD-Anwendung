export function changeDepartments() {
    const departmentsRows = document.querySelectorAll('.row-department');

    const tipMessage = document.querySelector('#tip-department');
    if (tipMessage && sessionStorage.getItem(`is-tip-department-show`) === null) {
        tipMessage.classList.remove('hidden')
    };

    departmentsRows.forEach((row) => row.addEventListener('click', () => {
        const getDepartmentTemplate = document.querySelector("#departmentRowForm");
        const departmentForm = getDepartmentTemplate.content.cloneNode(true);

        const index = row.querySelector('#index').innerText;
        const department = row.querySelector('#name').innerText;
        const amountEmployees = row.querySelector('#amount-employees').innerText;

        departmentForm.querySelector('#index').innerText = index;
        departmentForm.querySelector('#name').value = department;

        const id = row.querySelector('input[name="id"]').value;

        row.parentElement.insertBefore(departmentForm, row.nextElementSibling)
        row.classList.add("hidden");

        document.querySelector('#form-department input').focus();

        const form = document.querySelector('#form-department');
        form.querySelector('input[name="id"]').value = id;
        form.addEventListener('focusout', function(event) {
            const isClickInside = form.contains(event.relatedTarget);
            if (isClickInside) {
                form.querySelector('button').addEventListener('click', () => {
                    form.querySelector('input[name="action"]').value = 'delete';
                    form.submit();
                })
            }
            else {
                row.classList.remove("hidden");
                form.remove();
            }
        });

        if (tipMessage && sessionStorage.getItem(`is-tip-show`) === null) {
            sessionStorage.setItem(`is-tip-department-show`, 'true');
            tipMessage.classList.add('hidden')
        };
    }))
}