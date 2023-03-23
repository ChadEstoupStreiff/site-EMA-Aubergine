function confirmPOP(url, message) {
    if (message == null) {
        message = "Etes vous sûrs ?"
    }

    let popup = document.createElement("div");
    popup.id = "popup"
    popup.className = "center";
    document.body.appendChild(popup);

    let text = document.createElement("h3");
    text.innerHTML = message;
    popup.appendChild(text);

    let buttons = document.createElement("div");
    buttons.className = "inline center";
    popup.appendChild(buttons);

    let cancel = document.createElement("a");
    cancel.innerHTML = "Annuler";
    cancel.className = "button";
    cancel.addEventListener("click", () => {
        document.getElementById("popup").remove();
    });
    buttons.appendChild(cancel);

    let confirm = document.createElement("a");
    confirm.innerHTML = "Confirmer";
    confirm.className = "button red";
    confirm.href = url;
    buttons.appendChild(confirm);
    
}