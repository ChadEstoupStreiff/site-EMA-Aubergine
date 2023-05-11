let canva_holds = [];

window.onload = function() {
    document.getElementById("bloc_images").addEventListener('change', function(){
        let canva_root = document.getElementById("bloc_images_canva");
        canva_root.innertHTML = "";
        while (canva_root.lastChild != null) {
            canva_root.removeChild(canva_root.lastChild);
        }

        document.getElementById("bloc_form").addEventListener("submit",  function(event){
            if (canva_holds.length > 0) {
                var hidden_param = document.createElement("input");
                hidden_param.name = "holds";
                hidden_param.type = "text";
                hidden_param.hidden = true;
                hidden_param.value = JSON.stringify(canva_holds);
                document.getElementById("bloc_form").appendChild(hidden_param);
            }
        });

        if (this.files.length > 0) {
            var url = URL.createObjectURL(this.files[this.files.length -1]);
            var img_inf = new Image();

            var top = document.createElement("div");
            canva_root.appendChild(top);
            img_inf.onload = function() {
                let canva = document.createElement("canvas");
                canva.width = img_inf.width;
                canva.height = img_inf.height;
                var circlesize = parseInt(Math.min(img_inf.width, img_inf.height) /20);
                var paintsize = parseInt(Math.min(img_inf.width, img_inf.height) /100);
                top.appendChild(canva);

                var ctx = canva.getContext("2d");
                ctx.drawImage(img_inf, 0, 0);
                
                canva_holds = [];
                canva.addEventListener('click', function(event) {
                    var canvaLeft = canva.offsetLeft + canva.clientLeft,
                    canvaTop = canva.offsetTop + canva.clientTop;
                    
                    var x = event.pageX - canvaLeft,
                    y = event.pageY - canvaTop;
                    canva_holds.push([x, y]);
                    
                    ctx = canva.getContext("2d");
                    ctx.strokeStyle = "#FF0000";
                    ctx.lineWidth = paintsize;
                    ctx.beginPath();
                    ctx.arc(x,y,circlesize,0,2*Math.PI);
                    ctx.stroke();                    
                }, false);
            };
            img_inf.src = url;

            if (this.files.length > 1) {
                canva_root.appendChild(document.createElement("hr"));

                let img_list_div = document.createElement("div");
                img_list_div.className = "center inline"
                canva_root.appendChild(img_list_div);
                for (let i = 1; i < this.files.length; i++) {
                    img = document.createElement("img");
                    img.src = URL.createObjectURL(this.files[this.files.length -i -1]);
                    img.alt = "Uploaded image";
                    img_list_div.appendChild(img);
                }
            }
        }
    });
}