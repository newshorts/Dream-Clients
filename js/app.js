/* 
 * App JS also manages particles
 * 
 * @author Mike Newell
 * @version 0.1.1
 * 
 * requestAnimationFrame() WAS REINSTITUTED AFTER FURTHER REVIEW. IT SEEMS TO 
 * IMPACT THE DRAWING MINIMALLY AND HAS A LOWER MEMORY FOOTPRINT - SO I'M GOING
 * WITH THAT - AND IT HAS THE ADDED BENEFIT OF BEING MORE BATTERY EFFICIENT
 * 
 * VERSION 5 ADDS SOME PERFORMANCE OPTIMIZATIONS LIKE LESS FUNCTION CALLS AND 
 * CALLING ARRAYS INSTEAD OF OBJECTS
 * 
 * COMMENTED OUT SOME DEPRECATED FUNCTIONS CLEANED CODE 
 * - adding support for window resizing without skewing mouse interactions
 * - redirect to chuck buck print form
 * TODO - interaction, must have atleast one submission for a chuck buck
 
 
 * TODO - mouse gravity instead of bubble floating
 
 * - submit button bubble colors
 * - updated connection information for mysql
 * 
 */

var App = {
    
    init: function() {
        
        this.Ajax.init();
        this.Page.init();
        
    },
    
    Ajax: {
        
        init: function() {
            
            this.getClients();
            
            this.listenSubmit();
            
        },
        
        getClients: function() {
            
            $.getJSON("get-clients.php", function(data) {
                
                
                
//                console.dir(data);
            
                $(data).each(function(index) {
                    
                    console.debug("pushing new client: " + data[index][0] + " with votes: " + data[index][1]);
                    
                    data[index][0] = data[index][0].replace('&#39;', "'");
                    
                    App.Page.clients.push(new App.Client(data[index]));

                });
                
                if(App.Page.userAnimationFrame()) {
                    $.getScript('js/animate.js');
                } else {
                    $.getScript('js/animate-safari.js');
                }
                
                
                
//                var lastRender = new Date();
                
//                App.Page.step();

                
                
            });
            
        },
        
        getCategories: function() {
            
            $.getJSON("get-categories.php", function(data) {
                
//                console.dir(data);

                
            
                $(data).each(function(index) {
                    
                    console.debug("pushing new client: " + data[index][0] + " with votes: " + data[index][1]);
                    
                    data[index][1] = data[index][1] / 4;
                    
                    data[index][0] = data[index][0].replace('&#39;', "'");
                    
                    App.Page.clients.push(new App.Client(data[index]));

                });
                
                if(App.Page.userAnimationFrame()) {
                    $.getScript('js/animate.js');
                } else {
                    $.getScript('js/animate-safari.js');
                }
                
//                var lastRender = new Date();
                
//                App.Page.step();

                
                
            });
            
        },
        
        listenSubmit: function() {
            
            var submit = document.getElementById('submit');
        
            submit.addEventListener('click', function(e) {

                e.preventDefault();
                
                var clientArr = [];

                // check for validation
                clientArr.push($('#clientForm').find('input[name="client1"]').val());
                clientArr.push($('#clientForm').find('input[name="client2"]').val());
                clientArr.push($('#clientForm').find('input[name="client3"]').val());
                clientArr.push($('#clientForm').find('input[name="client4"]').val());
                clientArr.push($('#clientForm').find('input[name="client5"]').val());
                
                var count = 0,
                    msg = "Oops, it looks like you didn't fill out form field(s) ";
                
                // check for values in the form
                for(var i = 0; i < clientArr.length; i++) {
                    if(clientArr[i]) {
                        // do nothing
                    } else {
                        msg = msg + (i + 1) + ", ";
                        count++;
                    }
                }
                
                if(count === 0) {
                    $.post('submit.php', 
                        {
                            c1: clientArr[0],
                            c2: clientArr[1],
                            c3: clientArr[2],
                            c4: clientArr[3],
                            c5: clientArr[4]
                        },
                        function(data) {
                            if(data.response) {
                                console.debug(data.response);
                                
                                if(data.response == true) {
                                    
                                    var ts = Math.round((new Date()).getTime() / 1000);
                                    
                                    window.location = "chuck.html#" + ts;
                                    
                                } else {
                                    alert("Sorry, we didn't get that. Please re-submit the form to get your chuck buck!")
                                }
                                
                            }
                        }, "json"
                    );
                } else {
                    
                    alert(msg.substr(0, msg.lastIndexOf(',')));
                    
                }

            }, false);
            
        }
        
    },
    
    Page: {
        
        c: {},
        c1: $('#c1'),
        clientRoster: $('#client-roster'),
        ctx: {},
        cWidth: 0,
        cHeight: 0,
        cMinX: 0,
        cMinY: 0,
        docHeight: 0,
        clients: [],
        mouseX: -99999,
        mouseY: -99999,
        pi2: Math.PI*2,
        
        init: function() {
            
            this.c = document.getElementById('c1');
            this.ctx = this.c.getContext('2d');

            this.cWidth = this.c.clientWidth;
            this.cHeight = this.c.clientHeight;
            
            this.cMinX = this.c1.offset().left;
            this.cMinY = this.c1.offset().top;
            
            this.docHeight = document.body.clientHeight;
            
            this.setButtonColor();
            
            this.listenMouse();
            /*
             *
             *  DEPRECATED IN FAVOR OF css [overflow: hidden;]
             *  
             **/
            this.listenClientHover();
            this.listenBuildingHover();
            this.listenWindowResize();
            
        },
        
        userAnimationFrame: function() {
            
            var userAgentString = navigator.userAgent;
            
            console.debug(userAgentString)
            
            if(userAgentString.search(/Safari/) > -1) {
                return false;
            } else if(userAgentString.search(/Opera/) > -1) {
                return false;
            } else {
                return true;
            }
            
        },
        
        setButtonColor: function() {
            
            var roundButton = false;
            
            $('#submit').css({
                'background-color' : 'rgba('+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+',0.6)'
            });
            
            if(roundButton) {
                
                $('#submit').css({
                    'width' : 120,
                    'height' : 120,
                    'border-radius' : 60,
                    'padding' : '0px 10px',
                    'margin-left' : 124,
                    'margin-top' : 8,
                    'border' : 'none'
                });
                
            } 
            
            $('#submit').hover(function() {
                $(this).css({
                    'background-color' : 'rgba('+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+',0.2)'
                });
            }, function() {
                $(this).css({
                    'background-color' : 'rgba('+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+','+Math.floor(Math.random()*254 + 1)+',0.6)'
                });
            });
            
        },
        
        listenMouse: function() {
            
            var self = this;
            
            self.c1.mousemove(function(evt) {
                self.mouseX = evt.pageX;
                self.mouseY = evt.pageY;
            });
            
            self.c1.hover(function(evt) {
                // do nothing
            }, function(evt) {
                self.mouseX = -999999;
                self.mouseY = -999999;
            });
            
//            this.c1.hover(function(evt) {
//
//                self.c1.mousemove(function(evt) {
//                    
//                    self.mouseX = evt.pageX;
//                    self.mouseY = evt.pageY;
//                    
//                });
//                
//            }, function(evt) {
//                // do nothing
//                self.mouseX = -999999;
//                self.mouseY = -999999;
//            });
            
        },
        
        listenClientHover: function() {
            
            var self = this;
            
            var positioner = $('#client-positioner');
            
            var roster = $('#client-roster');
            
            
            positioner.hover(function(evt) {
                
                roster.css({'height' : 250});
                
            }, function(evt) {
                
                roster.css({'height' : 0});
                
            });
            
        },
        
        listenBuildingHover: function() {
            
            $('.floor-image').hover(function() {
                $(this).children("img").css({'opacity' : 1});
            }, function() {
                $(this).children("img").css({'opacity' : 0});
            });
            
        },
        
        listenWindowResize: function() {
            
            var self = this;
            
            $(window).resize(function(evt) {
                self.cMinX = self.c1.offset().left;
                self.cMinY = self.c1.offset().top;
            });
          
        },
        
        step: function() {
            
            var self = App.Page;
            
            self.ctx.clearRect(0, 0, self.cWidth, self.cHeight);
            self.ctx.save();
            
            // do while loop instead of a for loop
            var i = self.clients.length - 1;
            
            do {
//                console.debug(self.clients[i].get());
                // move the bubbles
                self.clients[i].step();
                
                // cArr = [x, y, name, radius];
                var cArr = self.clients[i].get();
                
                self.ctx.fillStyle = "rgba(0, 0, 0, 0.3)";
                self.ctx.beginPath();
                self.ctx.arc(cArr[0] - 3,cArr[1] + 5,cArr[3],0,self.pi2,false); 
                self.ctx.fill();

                self.ctx.fillStyle = self.clients[i].getColor();
                self.ctx.beginPath();
                self.ctx.arc(cArr[0],cArr[1],cArr[3],0,self.pi2,false); 
                self.ctx.fill();
                
                self.ctx.font="16px arial";
                self.ctx.fillStyle = "white";
                var textWidth = self.ctx.measureText(cArr[2]);
                
                if(cArr[3] > ((textWidth.width / 2) + 10)) {
                    self.ctx.fillText(cArr[2], (cArr[0] - (Math.ceil(textWidth.width) / 2)), cArr[1] + 4);
                }
                
                
            } while(i--);
            
            var tempMX = self.mouseX - self.cMinX;
            var tempMY = self.mouseY - self.cMinY;
            
            
            requestAnimationFrame(self.step);  
            
        }
        
    }
    
}