App.Client = function(obj) {
    
    obj[1] = (obj[1] < 40) ? obj[1] : 40;
    

    var x = new Number(Math.random()*800 + 200),
        y = new Number(Math.random()*300 + 200),
        radius = new Number(0),
        r = new Number(Math.floor(Math.random()*200) + 55), 
        g = new Number(Math.floor(Math.random()*254) + 1), 
        b = new Number(Math.floor(Math.random()*200) + 55),
        rgba = "rgba(" + r + "," + g + "," + b + ", 0.7)",
        color = new Array(),
        name = obj[0],
        speed = new Number(0),
        reverse = new Number(Math.random() * 50 + 1),
        reverseX = new Number(-1),
        reverseY = new Number(-1),
        counter = new Number(0),
        sign = new Number(1),
        theta = new Number(0),
        pageWidth = App.Page.cWidth,
        pageHeight = App.Page.cHeight,
        size = new Number(((obj[1] / 100) * 500));
    
    
    /*
     *  INTERNAL
     *
     **/
    
    var setRadius = function() {
            
        radius = size;
        
    }
    
    var setSpeed = function() {
        
        speed = ((5) / (radius*3)) * 30;
        
    }
    
    var setColor = function() {
        
        r = Math.random()*200 + 55;
        g = Math.random()*254 + 1;
        b = Math.random()*200 + 55;
        
        color = [r,g,b];
        
    }
    
    var grow = function() {
        
        if(radius >= (size) + 75) {
            radius = (size) + 75;
        } else {
            radius = radius + 5;
        }
        
    }
    
    var equalize = function() {
        
        radius = (radius > size) ? radius - 2 : size;

//        if(radius > size) {
//            radius = ;
//        } else {
//            radius = ((obj[1] / 100) * 500);
//        }
        
    }
    
    var moveXMouse = function(c) {
        
        if(((x - radius) < 0) || ((x + radius) > pageWidth)) {
            
             reverseX = reverseX * -1;

        }
        
        x = x + (reverseX * c);
        
    }
    
    var moveYMouse = function(c) {
        
        // bounce off edges
        if(((y - radius) < 0) || (y + radius > pageHeight)) {
            
            reverseY = reverseY * -1;
            
        }
        
        y = y + (reverseY * c);
        
    }
    
    var moveX = function() {
        
        // bounce off edges
        if(((x - radius) < 0) || ((x + radius) > pageWidth)) {
            
             reverseX = reverseX * -1;



        }
        
//        attr.counter++;
        
        x = x + (reverseX * (speed));
        
    }
    
    var moveY = function() {
        
        // bounce off edges
        if(((y - radius) < 0) || (y + radius > pageHeight)) {
            
            reverseY = reverseY * -1;
            
        }
        
        y = y + (reverseY * (speed));
    }
    
    /*
     *  CALLERS
     *
     **/
    
//    setColor();
    setRadius();
    setSpeed();
    
    /*
     *  GETTERS
     *
     **/
    
    this.step = function() {
        
        // detect mouse
        var xT = new Number(Math.floor(App.Page.mouseX) - App.Page.cMinX);
        var yT = new Number(Math.floor(App.Page.mouseY) - App.Page.cMinY);
        
        var gRad = new Number(65);
        var cRad = new Number(125);
        
        var xLower = new Number(xT - gRad);
        var xUpper = new Number(xT + gRad);
        
        var yLower = new Number(yT + gRad);
        var yUpper = new Number(yT - gRad);
        
        var xLowerMouse = new Number(xT - cRad);
        var xUpperMouse = new Number(xT + cRad);
        
        var yLowerMouse = new Number(yT + cRad);
        var yUpperMouse = new Number(yT - cRad);
        
        // if our mouse is over us
        if((x < xUpper && x > xLower) && (y > yUpper && y < yLower)) {
            
//            grow();
            radius = (radius >= (size + 75)) ? (size) + 75 : radius + 5;
            counter++;
            
        } else {
            
            radius = (radius > size) ? radius - 2 : size;
//            equalize();
            
            counter = 0;
            
        }
        
//        setSpeed();
        
        // if our mouse is over us
        if((x < xUpperMouse && x > xLowerMouse) && (y > yUpperMouse && y < yLowerMouse)) {
            
            var angle = .1 * theta;
            
            xT = (angle) * Math.cos(angle) % 180 * Math.PI / 180;
            
            xT = Math.round(xT*Math.pow(10,3))/Math.pow(10,3);
            
            yT = (angle) * Math.sin(angle) % 180 * Math.PI / 180;
            
            yT = Math.round(yT*Math.pow(10,3))/Math.pow(10,3);
            
//            moveXMouse(xT);
//            if(((x - radius) < 0) || ((x + radius) > pageWidth)) {
//                 reverseX = reverseX * -1;
//            }
//            x = x + (reverseX * xT);
////            moveYMouse(yT);
//            if(((y - radius) < 0) || (y + radius > pageHeight)) {
//                reverseY = reverseY * -1;
//            }
//            y = y + (reverseY * yT);
            
            theta++;
            
        } else {
            
            xT = speed;
            yT = speed;
            
            theta--;
            
        }
        
        if(((x - radius) < 0) || ((x + radius) > pageWidth)) {
             reverseX = reverseX * -1;
        }
        x = x + (reverseX * (xT));

        // bounce off edges
        if(((y - radius) < 0) || (y + radius > pageHeight)) {
            reverseY = reverseY * -1;
        }
        y = y + (reverseY * (yT));
        
        
        
        return [x, y, name, radius, rgba];
        
    }
    
    this.get = function() {
     
        return [x, y, name, radius, rgba];
        
    }
    
    
    this.getColor = function() {
        
        return "rgba(" + r + "," + g + "," + b + ", 0.7)";
        
    }
    
}