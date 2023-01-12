function addEventToButtons() {
    const updateButtons = document.querySelectorAll('#showUpdate');
    const deleteButtons = document.querySelectorAll('#delete');

    updateButtons.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })

    deleteButtons.forEach((button) => {
        button.addEventListener('click', actionHandler);
    })
}

function actionHandler(e) {
    const id = e.target.dataset.id;
    window.location.href = 'index.php?action=' + e.target.id + '&id=' + id;
}

addEventToButtons();