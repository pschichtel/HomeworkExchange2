<?php
    error_reporting(-1);

    define('DS', DIRECTORY_SEPARATOR);
    define('BASE_DIR', dirname(__FILE__));
    define('INCLUDES_DIR', BASE_DIR . DS . 'includes');

    require_once INCLUDES_DIR . DS . 'AutoLoader.php';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/hwe_theme/jquery-ui-1.8.18.hwe.css"  />	
        <title>Homework Exchange Index</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="te   xt/javascript" src="jquery-ui.js"></script>
        <script type="text/javascript">
            (function(){
                var username = "",
                    animateOptions = {
                        top: null
                    },
                    loggedIn = false;
                
                $(function(){ //DOM ready
                    $("div#login").show("fadeIn");
                    
                    $("button#login").click(function(){
                        
                        if (!loggedIn)
                        {
                            username = $("input#username").val();
                            var password = $("input#password").val();
                            $.ajax({
                                url: 'login.php?username=' + username + "&password=" + password,
                                success: function(data, textStates, jqXHR) {
                                    alert("" + data);
                                    if(data == "succes")
                                    {
                                        loggedIn = true;
                                        $("span#user").text("Welcome " + username);
                                        $("span#user").show("fold");
                                        $("button#login").text("Logout");
                                        animateOptions.top = "-=149px";
                                    }
                                },
                                async: false
                            });
                            
                        }
                        else
                        {
                            loggedIn = false;
                            animateOptions.top = "+=149px";

                            $("span#user").hide();
                            $("button#login").text("Login");
                        }
                       
                        $("div#login").animate(animateOptions, 1200);
                    });
               })
            })();
        </script>
    </head>
    <body class="ui-helper-reset">
        <div id="error" class="ui-">
            
        </div>
        
        <div id="login" class="ui-widget ui-widget-content ui-corner-all hidden ui-helper-reset">
            <h3 class="ui-widget-header ui-corner-all">Login:</h3>
            
            <form>
                <span class="field">Username:</span>
                <input class="field" name="username" id="username" type="text">
                <br class="clear">
                
                <span class="field">Password:</span>
                <input class="field" name="password" id="password" type="password">
                <br class="clear">

                <span id="user" class="hidden"></span>
                <button type="button" id="login" class="ui-state-default ui-button">Login</button>
            </form>  
        </div>
    </body>
</html>

