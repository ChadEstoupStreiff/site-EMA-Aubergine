window.onload = function() {
    var img_inf = new Image();
    img_inf.onload = function() {
        let canva = document.createElement("canvas");
        canva.width = img_inf.width;
        canva.height = img_inf.height;
        document.getElementById("main_canva").appendChild(canva);

        var canvaLeft = canva.offsetLeft + canva.clientLeft,
        canvaTop = canva.offsetTop + canva.clientTop;

        var ctx = canva.getContext("2d");
        ctx.drawImage(img_inf, 0, 0);
    };
    img_inf.src = document.getElementById("main_canva").getAttribute("data-src");
};