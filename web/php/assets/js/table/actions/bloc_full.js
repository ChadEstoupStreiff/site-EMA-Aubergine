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
    a.href = "?c=Pan&f=delete&name=" + bloc["name"];
    d.appendChild(a);
    i = document.createElement("i");
    i.className = "fa-solid fa-trash"
    a.appendChild(i); 

    div.appendChild(d);
}