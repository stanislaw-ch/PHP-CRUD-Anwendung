function addEventToButtons() {
    const updateButtonsDep = document.querySelectorAll('#showUpdateDep');
    const deleteButtonsDep = document.querySelectorAll('#deleteDep');
    const updateButtonsEmp = document.querySelectorAll('#showUpdateEmp');
    const deleteButtonsEmp = document.querySelectorAll('#deleteEmp');

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
    window.location.href = 'index.php?action=' + e.target.id + '&id=' + id;
}

addEventToButtons();

const errorMessage = document.querySelector('#error-message');

errorMessage && setTimeout(function(){
    errorMessage.remove();
}, 2000);


