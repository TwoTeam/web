<!-- jQuery -->
<script src="js/jquery.js"></script>

<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>

<!-- select -->
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>

<!-- Custom Theme JavaScript -->
<script>
    $(".datetime").datetimepicker({
        language: "sl-SI"
    });
    // Closes the sidebar menu
    $("#menu-close").click(function (e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function () {
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstro.min.js"></script>
<script src="js/custom.js"></script>
<script async src="js/alertify.min.js"></script>
<script async src="js/jquery-1.11.0.min.js"></script>
<script async src="js/lightbox.min.js"></script>
</body>
</html>