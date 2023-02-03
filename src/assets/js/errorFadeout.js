export function errorFadeout() {
    const errorMessages = document.querySelectorAll('#error-message');
    errorMessages && setTimeout(function(){
        errorMessages.forEach((error) => {
            error.remove();
        })
    }, 4000);
}
