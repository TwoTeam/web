<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    </head>
    <body>
    <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
    <div id="fb-root"></div>
    <span id="fetch">Test</span>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1578916112375369',
                xfbml      : true,
                version    : 'v2.3'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $("#fetch").click(function(){
            FB.api(
                "search?q=Velenje&type=event&access_token=1578916112375369|eToyVOWKTKmG5Yjq6eWTxmmZQqw",
                function (response) {
                    if (response && !response.error) {
                        console.log(response);
                    }
                }
            );
        });
    </script>
    </body>
</html>