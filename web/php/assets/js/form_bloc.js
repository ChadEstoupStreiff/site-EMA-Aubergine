let canva_holds = [];canva_holds

window.onload = function() {
    document.getElementById("bloc_images").addEventListener('change', function(){
        let canva_root = document.getElementById("bloc_images_canva");
        canva_root.innertHTML = "";
        while (canva_root.lastChild != null) {
            canva_root.removeChild(canva_root.lastChild);
        }

        if (this.files.length > 0) {
            var url = URL.createObjectURL(this.files[this.files.length -1]);
            var img_inf = new Image();
            img_inf.onload = function() {
                let canva = document.createElement("canvas");
                canva.width = img_inf.width;
                canva.height = img_inf.height;
                canva_root.appendChild(canva);

                var canvaLeft = canva.offsetLeft + canva.clientLeft,
                canvaTop = canva.offsetTop + canva.clientTop;

                var ctx = canva.getContext("2d");
                ctx.drawImage(img_inf, 0, 0);
                
                canva_holds = [];
                canva.addEventListener('click', function(event) {
                    var x = event.pageX - canvaLeft,
                    y = event.pageY - canvaTop;
                    canva_holds.push([x, y]);
                    
                    ctx = canva.getContext("2d");
                    ctx.strokeStyle = "#FF0000";
                    ctx.lineWidth = 5;
                    ctx.beginPath();
                    ctx.arc(x,y,30,0,2*Math.PI);
                    ctx.stroke();
                    
                    console.log(canva_holds);
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