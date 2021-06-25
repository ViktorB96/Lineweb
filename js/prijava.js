$(function () {
  //alert("Radi!!!");
  let poruka = $("#poruka");
  $("#btnPrijava").click(function () {
    let email = $("#korime").val();
    let lozinka = $("#lozinka").val();
    $.post(
      "ajax/ajax_prijava.php?funkcija=prijava",
      { email: email, lozinka: lozinka },
      function (response) {
        //poruka.html(response);
        let odgovor = JSON.parse(response);
        if (odgovor.greska != "")
          poruka.html("<span style='color:red'>" + odgovor.greska + "</span>");
        else window.location.assign(odgovor.poruka);
      }
    );
  });
  $("#btnPrikaziRegistraciju").click(function () {
    $("#divLozinka").hide();
    $("#divRegistracija").toggle();
  });

  $("#btnPrikaziLozinku").click(function () {
    $("#divRegistracija").hide();
    $("#divLozinka").toggle();
  });

  $("#btnSnimiRegistraciju").click(function () {
    let ime = $("#rime").val();
    let prezime = $("#rprezime").val();
    let email = $("#remail").val();
    $.post(
      "ajax/ajax_prijava.php?funkcija=registracija",
      { ime: ime, prezime: prezime, email: email },
      function (response) {
        poruka.html(response);
      }
    );
  });

  $("#btnPosaljiLozinku").click(function () {
    let email = $("#lemail").val();
    $.post(
      "ajax/ajax_prijava.php?funkcija=lozinka",
      { email: email },
      function (response) {
        poruka.html(response);
      }
    );
  });
});
