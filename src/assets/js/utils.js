export function showTipMessage(elector, sessionName) {
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

export function hideTipMessage(elector, sessionName) {
    if (sessionStorage.getItem(sessionName) === 'false') {
        sessionStorage.setItem(sessionName, 'true');
        document.querySelector(elector).remove();
    }
}

export function hideOnClickOutside(formSelector, rowSelector) {
    document.addEventListener('click', function (event) {
        const form = document.querySelector(formSelector);
        if (form) {
            let isClickInside = form.contains(event.target);

            if (!isClickInside) {
                const index = form.dataset.id;
                const rows = document.querySelectorAll(rowSelector);

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
}
