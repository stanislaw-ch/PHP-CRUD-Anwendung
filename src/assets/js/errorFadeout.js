export function errorFadeout() {
    const errorMessage = document.querySelector('#error-message');
    errorMessage && setTimeout(function(){
        errorMessage.remove();
    }, 4000);
}
