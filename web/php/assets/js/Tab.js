function getJSONAPI(url) {
    const request = new XMLHttpRequest();
    request.open('GET', url, false);  // `false` makes the request synchronous
    request.send(null);

    if (request.status === 200)
        return JSON.parse(request.responseText);
    else
        return null;
}

class Tab {
    static PAGE_SIZE = 10;

    constructor(api_url, legends, action_callback) {
        this.api_url = api_url;
        this.page = 0;
        this.action_callback = action_callback;

        this.table = document.getElementById("tab");
        this.init();
    }

    init() {
        this.lines = document.createElement("div");
        this.lines.className = "lines";
        this.table.appendChild(this.lines);
    }

    update() {
        console.log("Table update");
        tab = getJSONAPI(this.api_url + "&pageSize=" + Tab.PAGE_SIZE + "&page=" + this.page);
        while (this.lines.length > 0) {
            this.lines.removeChild(this.lines.firstChild);
        }


        for (let i = Tab.PAGE_SIZE * this.page; i < Tab.PAGE_SIZE * (this.page+1) && i < tab.length; i++) {
            let element = tab[i];

            let div = document.createElement("div");
            div.className = "line";
            this.lines.appendChild(div);

            if (this.action_callback != null) {
                let actions = document.createElement("div");
                div.appendChild(actions);
                this.action_callback(actions, element);
            }

            for (let value of element) {
                let p = document.createElement("p");
                p.innerHTML = value;
                div.appendChild(p);
            }
        }
    }
}