window.onload = function() {
    var img_inf = new Image();
    img_inf.onload = async function() {
        let canva = document.createElement("canvas");
        canva.width = img_inf.width;
        canva.height = img_inf.height;
        document.getElementById("main_canva").appendChild(canva);

        var canvaLeft = canva.offsetLeft + canva.clientLeft,
        canvaTop = canva.offsetTop + canva.clientTop;

        var ctx = canva.getContext("2d");
        ctx.drawImage(img_inf, 0, 0);

        var holds = await getHolds(
            document.getElementById("main_canva").getAttribute("data-apiurl"),
            document.getElementById("bloc_name").innerHTML);
        holds = JSON.parse(holds["holds"]);
        console.log(holds);

        holds.forEach(hold => {
            var x = hold[0],
            y = hold[1];

            ctx = canva.getContext("2d");
            ctx.strokeStyle = "#FF0000";
            ctx.lineWidth = 5;
            ctx.beginPath();
            ctx.arc(x,y,20,0,2*Math.PI);
            ctx.stroke();  
        });   
    };
    img_inf.src = document.getElementById("main_canva").getAttribute("data-src");
};

async function getHolds(api_url, name) {
    const response = await fetch(api_url + "/bloc/" + name);
    return response.json();
}