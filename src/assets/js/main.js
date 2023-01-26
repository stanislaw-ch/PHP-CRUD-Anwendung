function addEventToButtons() {
    const updateButtonsDep = document.querySelectorAll('#showUpdateDepartment');
    const deleteButtonsDep = document.querySelectorAll('#deleteDepartment');
    const updateButtonsEmp = document.querySelectorAll('#showUpdateEmployee');
    const deleteButtonsEmp = document.querySelectorAll('#deleteEmployee');

    updateButtonsDep.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })

    deleteButtonsDep.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })

    updateButtonsEmp.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })

    deleteButtonsEmp.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })
}

function actionHandler(e) {
    const id = e.target.dataset.id;
    const view = e.target.dataset.view;
    const action = e.target.dataset.action;

    window.location.href = '/' + view + (action ? '?action=' + action + '&': '?') + 'id=' + id;
}

addEventToButtons();

const errorMessage = document.querySelector('#error-message');

errorMessage && setTimeout(function(){
    errorMessage.remove();
}, 2000);


