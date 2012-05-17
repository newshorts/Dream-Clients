/* 
 * This script is called once we've confirmed that we have clients to pass it
 * it runs by itself as quickly as possible
 */

    // no more globals?
var c = document.getElementById('c1'),
    c1 = $('#c1'),
    ctxG = c.getContext('2d'),
    cWidth = new Number(c.clientWidth),
    cHeight = new Number(c.clientHeight),
    clientsG = App.Page.clients,
    pi2G = new Number(Math.PI*2),
    cMinX = new Number(c1.offset().left),
    cMinY = new Number(c1.offset().top),
    clientLength = new Number(clientsG.length),
    clientStatic = new Array();
    
var setStatic = function() {
    for(var i = 0; i < clientLength; i++) {
        
        var cArr = clientsG[i].step();
        
        ctxG.font= "16px arial";
        ctxG.fillStyle = "white";
        cArr.push(Math.floor(ctxG.measureText(cArr[2]).width));
        
        clientStatic.push(cArr);
        
    }
}

setStatic();

//console.dir(clientStatic);

var step = function() {
    
    var ctx = ctxG,
        pi2 = pi2G,
        clients = clientsG, 
        sClients = clientStatic;
       
    ctx.clearRect(0, 0, cWidth, cHeight);
    ctx.save();
    
    // do while loop instead of a for loop
    var i = new Number(clientLength - 1);

    do {

        // move the bubbles
        var cArr = clients[i].step();
        var width = sClients[i][5];

//        clients[i].get();

        ctx.fillStyle = "rgba(0, 0, 0, 0.3)";
        ctx.beginPath();
        ctx.arc(cArr[0] - 3,cArr[1] + 5,cArr[3],0,pi2,false); 
        ctx.fill();

        ctx.fillStyle = cArr[4];
        ctx.beginPath();
        ctx.arc(cArr[0],cArr[1],cArr[3],0,pi2,false); 
        ctx.fill();

        ctx.font= "16px arial";
        ctx.fillStyle = "white";
        // textWidth was replaced with sClients[i][5]
//        var textWidth = ctx.measureText(sClients[i][2]);

        if(cArr[3] > ((width / 2) + 10)) {
            ctx.fillText(sClients[i][2], (cArr[0] - (width) / 2), cArr[1] + 4);
        }

    } while(i--);

    requestAnimationFrame(step);  

}

var lastRender = new Date();

step();