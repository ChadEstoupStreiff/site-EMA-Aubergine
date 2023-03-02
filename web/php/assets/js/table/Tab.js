async function getJSONAPI(url) {
    const request = new XMLHttpRequest();

    console.log(url);
    const response = await fetch(url);
    return response.json();
}

class Tab {
    static PAGE_SIZE = 10;

    constructor(div_id, filters, action_callback) {
        this.table = document.getElementById(div_id);
        this.api_url = this.table.innerHTML;
        this.table.innerHTML = "";

        this.page = 0;
        this.regex = "";
        this.action_callback = action_callback;

        this.init();
    }

    init() {
        let div = document.createElement("div");
        div.className = "inline center"
        this.table.appendChild(div);

        let b = document.createElement("button");
        b.innerHTML = "<";
        b.addEventListener("click", () => {
            this.page--;
            this.update();
        });
        div.appendChild(b)
        this.pageElement = document.createElement("h3");
        this.pageElement.innerHTML = 0;
        div.appendChild(this.pageElement);
        b = document.createElement("button");
        b.innerHTML = ">";
        b.addEventListener("click", () => {
            this.page++;
            this.update();
        });
        div.appendChild(b)
        this.input = document.createElement("input");
        this.input.type = "text";
        this.input.addEventListener("keypress", (e) => {
            if (e.key == 'Enter')
                this.update();
        });
        div.appendChild(this.input)

        this.lines = document.createElement("div");
        this.lines.className = "lines";
        this.table.appendChild(this.lines);
    }

    async update() {
        console.log("Table update");
        this.regex = this.input.value;
        var tab = await getJSONAPI(this.api_url + "?pageSize=" + Tab.PAGE_SIZE + "&page=" + this.page + "&regex=" + this.regex);
        
        console.log(tab);
        while (this.lines.childNodes.length > 0) {
            this.lines.removeChild(this.lines.firstChild);
        }
        if (tab.length > 0) {
            this.pageElement.innerHTML = this.page;
    
            
            for (let i = 0; i < tab.length; i++) {
                let element = tab[i];
    
                let div = document.createElement("div");
                div.className = "line";
                this.lines.appendChild(div);
    
                if (this.action_callback != null) {
                    let actions = document.createElement("div");
                    div.appendChild(actions);
                    this.action_callback(actions, element);
                }
    
                for (const key in element) {
                    let p = document.createElement("p");
                    p.innerHTML = element[key];
                    div.appendChild(p);
                }
            }
        } else {
            if (this.page > 0) {
                this.page--;
                this.update();
            }
        }
    }
}