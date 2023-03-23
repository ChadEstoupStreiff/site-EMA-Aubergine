function user_bloc(div, bloc) {
    let d = document.createElement("div");
    d.className = "inline center";

    let a = document.createElement("a");
    a.href = "?c=Pan&f=see&name=" + bloc["name"];
    d.appendChild(a);
    let i = document.createElement("i");
    i.className = "fa-solid fa-eye"
    a.appendChild(i); 

    a = document.createElement("a");
    a.href = "?c=Pan&f=edit&name=" + bloc["name"];
    d.appendChild(a);
    i = document.createElement("i");
    i.className = "fa-solid fa-pen"
    a.appendChild(i); 

    a = document.createElement("a");
    a.addEventListener("click", () => {
        confirmPOP("?c=Pan&f=delete&name=" + bloc["name"], "Êtes vous sûrs de vouloir supprimer " + bloc["name"] +" ?");
    });
    d.appendChild(a);
    i = document.createElement("i");
    i.className = "fa-solid fa-trash"
    a.appendChild(i); 

    div.appendChild(d);
}