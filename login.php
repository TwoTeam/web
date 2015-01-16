<?php
include_once 'header.php';
?>
<div class="block-flat">
    <form style="width: 300px; margin: 0 auto;" method="post" action="login_check.php">
        <h2 class="form-signin-heading">Prijava</h2>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="email" class="form-control" placeholder="Elektronski naslov">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" class="form-control" placeholder="Geslo">
        </div>
        <br />
        <div class="input-group">
            Ostani prijavljen
            <div class="onoffswitch tick">
                <input type="checkbox" value="1" name="remember" class="onoffswitch-checkbox" id="myonoffswitch-tick">
                <label class="onoffswitch-label" for="myonoffswitch-tick">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch tickswitch-switch"></span>
                </label>
            </div>
        </div>
        <div class="clear"></div>
        <br />
        <button class="btn btn-large btn-primary" type="submit">Prijava</button>
    </form>
</div>
<?php
include_once 'footer.php';
?>