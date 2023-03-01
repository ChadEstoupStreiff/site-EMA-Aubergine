function user_actions(div, user) {
    let d = document.createElement("div");
    d.className = "inline center";

    let a = document.createElement("a");
    a.href = "?c=Admin&f=deleteUser&login=" + user[0];
    d.appendChild(a);
    let i = document.createElement("i");
    i.className = "fa-solid fa-trash"
    a.appendChild(i);


    a = document.createElement("a");
    a.href = "?c=Admin&f=regeneratepassword&login=" + user[0];
    d.appendChild(a);
    i = document.createElement("i");
    i.className = "fa-solid fa-unlock"
    a.appendChild(i);

    let s = document.createElement("select");
    let o = document.createElement("option");
    o.value = "Types";
    o.innerHTML = "Types";
    s.appendChild(o);
    o = document.createElement("option");
    o.value = "ADMIN";
    o.innerHTML = "ADMIN";
    s.appendChild(o);
    o = document.createElement("option");
    o.value = "OPENER";
    o.innerHTML = "OPENER";
    s.appendChild(o);
    o = document.createElement("option");
    o.value = "GUEST";
    o.innerHTML = "GUEST";
    s.appendChild(o);
    s.addEventListener("change", (event) => {
        let value = event.target.value;
        if (value != "Types")
            window.location.href = "?c=Admin&f=setUserType&login=" + user[0] + "&type=" + value;
    });
    d.appendChild(s);    

    div.appendChild(d);
}


let table = null;
window.onload = function() {
    table = new Tab("tab-users", [], user_actions);
    table.update();
}