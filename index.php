<?php
 // don't know why

    $var = "I don't know why I'm making a variable, I certainly don't need it...";
    $var2 = "so why the hell not, let's make some more variables cause we're bored...";
    
    $arr = array($var, $var2);
    
?><!--
Dream Clients v23 (valid HTML5)

Design By: David Byrd
  
Copy & Direction: Sarah Becker
  
Developed By:
01001101 01101001 01101011 01100101 00100000 01001110 01100101 01110111 01100101 01101100 01101100
  
TODO: bubbles should move according to your mouse - the small ones start out 
        small and don't have text, they expand on hover. The large ones start
        out with text.
  
5.16.12 - removed agency section so you can only see the visualizations

-->
<!DOCTYPE html>
<html>
    <head>
        <title>Dream Clients</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" /> 
<!--        <link type="text/css" rel="stylesheet" href="http://freebaselibs.com/static/suggest/1.3/suggest.min.css" />-->
    </head>
    <body>
        <div id="wrap">
            <header>
                <h1><a href="#" title="Goodby Silverstein and Partners">Goodby Silverstein &amp; Partners</a></h1>
            </header>
<!--            <section id="gsp">
                
                <div class="inside" id="top-floor"><img src="images/street_1200x760.jpg" alt="Top Floor" /></div>
                
                <div class="dialog-positioner" id="agency-positioner">
                    <div class="dialog-container">
                        <article class="dialog">
                            <h2 id="your-agency" class="light-shadow">HEY, IT'S YOUR AGENCY.</h2>
                            <p>What do you want to work on?</p>
                            <P>Take a look at our current client roster and use the form below to tell us what we're missing.</p>
                        </article>
                        <div class="dialog-border"></div>
                        <div class="dialog-shadow"></div>
                    </div>
                </div>
                
                <div class="dialog-positioner" id="client-positioner">
                    <div class="dialog-container">
                        <article class="dialog">
                            <h3 class="heavy-shadow">Current Client Roster </h3>
                            <div id="client-roster">
                                <ul>
                                    <li>ADOBE</li>
                                    <li>CHEETOS</li>
                                    <li>CHEVROLET</li>
                                    <li>COMCAST</li>
                                    <li>CORONA LIGHT</li>
                                    <li>CROWN: MODELO</li>
                                    <li>DORITOS</li>
                                    <li>DREYERS</li>
                                    <li>FOSTER FARMS</li>
                                    <li>GOOGLE</li>
                                    <li>HAAGEN DAZS</li>
                                </ul>
                                <ul>
                                    <li>MILK</li>
                                    <li>NATIONAL GEOGRAPHIC</li>
                                    <li>NBA</li>
                                    <li>NEST</li>
                                    <li>NETFLIX</li>
                                    <li>NINTENDO</li>
                                    <li>RUFFLES</li>
                                    <li>SONIC</li>
                                    <li>TD AMERITRADE</li>
                                    <li>TSING TAO</li>
                                    <li>YOUTUBE</li>
                                </ul>
                            </div>
                            
                        </article>
                        <div class="dialog-border"></div>
                        <div class="dialog-shadow"></div>
                    </div>
                </div>

                <div class="floor-image" id="first">
                    <img src="images/building-hovers/1st_floor.png" alt="First" />
                </div>
                <div class="floor-image" id="third">
                    <img src="images/building-hovers/3rd_floor_2.png" alt="Third" />
                </div>
                <div class="floor-image" id="fourth">
                    <img src="images/building-hovers/4th_floor_3.png" alt="Fourth" />
                </div>
                <div class="floor-image" id="fifth">
                    <img src="images/building-hovers/5th_floor_3.png" alt="Fifth" />
                </div>
                <div class="floor-image" id="lift">
                    <img src="images/building-hovers/THE_LIFT_2.png" alt="Lift" />
                </div>
                <div class="floor-image" id="parking">
                    <img src="images/building-hovers/parking_342x205.png" alt="Parking" />
                </div>
                
            </section>-->
            <div id="clients">
<!--                <div class="radial"></div>-->
<!--                <canvas id="c1" width="1200" height="761"></canvas>-->
                <iframe id="dynamic-bubbles" src=""></iframe>
<!--                <div id="form-container">
                    <form id="clientForm" method="post" action="submit.php" name="clients">
                        <h2 id="wish-list" class="heavy-shadow">YOUR PITCH WISH LIST</h2>
                        <p>Tell us your top five dream clients and check out what's trending here on the right.</p>
                        <ul>
                            <li><input type="text" class="client-intput" id="client1" name="client1" /></li>
                            <li><input type="text" class="client-intput" id="client2" name="client2" /></li>
                            <li><input type="text" class="client-intput" id="client3" name="client3" /></li>
                            <li><input type="text" class="client-intput" id="client4" name="client4" /></li>
                            <li><input type="text" class="client-intput" id="client5" name="client5" /></li>
                        </ul>
                        <input id="submit" type="submit" name="submit" value="SUBMIT" class="submit button" />
                    </form>
                </div>-->
                <div id="category-switcher">
                    <div id="category-switcher-wrap">
                        <a class="switcher brand-view" href="#" title="click here to switch to industry category view" data-dest="iframe-brands.html"></a>
                        <br />
                        <a class="switcher category-view" href="#" title="click here to switch to industry category view" data-dest="iframe-category.html"></a>
                    </div>
                        
                </div>
<!--                <div id="loader"></div>-->
            </div>
<!--            <footer>
                <p>&copy; Goodby Silverstein &amp; Partners 2012</p>
            </footer>-->
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>window.jQuery || document.write("<script src='js/jquery-1.7.1.min.js'>\x3C/script>")</script>
        <script type="text/javascript" src="js/toolbox.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
<!--        <script type="text/javascript" src="js/client.js"></script>-->
        
<!--        <script type="text/javascript" src="http://freebaselibs.com/static/suggest/1.3/suggest.min.js"></script>-->
        
        <script>
            (function($) {
                $(window).load(function() {
                    
                    var bub = $('#dynamic-bubbles');
                    var form = $('#form-container');
                    
                    bub.attr('src', window.location.protocol + '//' + window.location.host + window.location.pathname.replace('index.php', '') + 'iframe-brands.html');
                    
                    $('#category-switcher a').click(function(evt) {
                        
                        evt.preventDefault();
                        
                        bub.css({opacity: 0});
                        
                        var dest = $(this).data('dest');
                        
                        if($(this).hasClass('category-view')) {
                            form.css({opacity: 0});
                        } 
                        
                        var self = this;
                        
                        setTimeout(function() {
                            
                            // load preloader
                            var self2 = self;
                            
                            bub.attr('src', window.location.protocol + '//' + window.location.host + window.location.pathname.replace('index.php', '') + dest);
                            
                            setTimeout(function() {
                                
                                if($(self2).hasClass('brand-view')) {
                                    form.css({display: 'block'});
                                    form.css({opacity: 1});
                                } else {
                                    form.css({display: 'none'});
                                }
                                
                                bub.css({opacity: 1});
                                
                            }, 900);
                            
                        }, 900);
                        
                    });
                    
                });
            })(jQuery);
            // removed 5.15.12
//            App.Ajax.listenSubmit();
//            
            App.Page.setButtonColor();
//            
            App.Page.listenClientHover();
//            
            App.Page.listenBuildingHover();
//            // this has been removed for a while
//            App.Page.listenWindowResize();
//            App.Page.init();
            
        </script>
    </body>
</html>
