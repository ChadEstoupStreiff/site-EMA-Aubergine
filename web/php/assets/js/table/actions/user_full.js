function user_actions(div, user) {
    let d = document.createElement("div");
    d.className = "inline center";

    let a = document.createElement("a");
    a.href = "?c=Admin&f=deleteUser&login=" + user["login"];
    d.appendChild(a);
    let i = document.createElement("i");
    i.className = "fa-solid fa-trash"
    a.appendChild(i);


    a = document.createElement("a");
    a.href = "?c=Admin&f=regeneratepassword&login=" + user["login"];
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
            window.location.href = "?c=Admin&f=setUserType&login=" + user["login"] + "&type=" + value;
    });
    d.appendChild(s);    

    div.appendChild(d);
}