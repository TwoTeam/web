$(".ajaxForm").on("submit", function () {
    //Pregleda osnovne elemente obrazca
    var $this = $(this),
            url = $this.attr('action'), //URL kam naj se pošljejo podatki
            method = $this.attr('method'), //Metoda za pošiljanje podatkov (POST, GET)
            data = {}; //Tabela, ki sprejme podatke za pošiljanje

    //Funkcija, ki pogleda vse elemente obrazca in jih nato shrani v tabelo data
    $this.find('[name]').each(function (index, value) {
        var $this = $(this),
                name = $this.attr('name'), //Ime, ki ga sprejme $_POST["name"]
                value = $this.val(); //Vrednost $_POST["name"]
        if (name === 'redirect')
        {
            $redirect = value; //Kam te preusmeri funkcija, če je pošiljanje forme uspešno in se v formi pošlje lokacija
        } else {
            $redirect = "";
        }
        data[name] = value; //Tabela se polni s podatki
    });
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function (comeback) {
            comeback = $.trim(comeback);
            comeback = comeback.split("|");
            if (comeback[0] === "success") { //Izpis če je nekaj bilo uspešno
                alertify.success(comeback[1]);
            } else if (comeback[0] === "redirect") { //Preusmeritev
                if ($redirect === "") {
                    window.location = comeback[1];
                } else {
                    window.location = $redirect;
                }
            } else if (comeback[0] === "error") { //Error
                alertify.error(comeback[1]);
            }
        }
    });
    return false;
});