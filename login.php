<?php
include_once 'header.php';
?>

<div class="block-flat">
    <form style="width: 300px; margin: 0 auto;" method="post" action="">
        <h2 class="form-signin-heading">Prijava</h2>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="email" class="form-control" placeholder="Elektronski naslov">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" class="form-control" placeholder="Geslo">
        </div>
        <label class="checkbox">
            <input type="checkbox" value="1"> Zapomni si me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Prijava</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('[type="checkbox"]').checkbox();
    });
</script>
<?php
include_once 'footer.php';
?>