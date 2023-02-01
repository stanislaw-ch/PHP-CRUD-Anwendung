export function getTipMessage(elector, sessionName) {
    const getTipMessageTemplate = document.querySelector("#tip-message");
    const tipMessage = getTipMessageTemplate.content.cloneNode(true);
    const rootMessage = document.querySelector(elector);
    if (rootMessage) {
        if (!sessionStorage.getItem(sessionName) || sessionStorage.getItem(sessionName) === 'false') {
            sessionStorage.setItem(sessionName, 'false');
            rootMessage.appendChild(tipMessage);
        }
    }
}