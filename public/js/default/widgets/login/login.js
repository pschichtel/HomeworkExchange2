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