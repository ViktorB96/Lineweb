$(function(){
    popuniKorpu();
    popuniKupljene();
})

function popuniKorpu()
{
    $.get("ajax/ajax_korpa.php?funkcija=popuniKorpu", function(response){
        $("#divKorpa").html(response);
    })
}

function popuniKupljene()
{
    $.get("ajax/ajax_korpa.php?funkcija=popuniKupljene", function(response){
        $("#divKupljeni").html(response);
    })
}

function kupi(idKupovine){
    $.post("ajax/ajax_korpa.php?funkcija=kupi", {idKupovine: idKupovine}, function(response){
        popuniKorpu();
        popuniKupljene();
        broj();
        alert(response);
    })
}

function obrisi(idKupovine){
    if(!confirm("Da li ste sigurni da želite da obrišete")) return false;
    $.post("ajax/ajax_korpa.php?funkcija=obrisi", {idKupovine: idKupovine}, function(response){
        popuniKorpu();
        broj();
        alert(response);
    })
}

function kupiSve(){
    $.post("ajax/ajax_korpa.php?funkcija=kupiSve", function(response){
        popuniKorpu();
        popuniKupljene();
        broj();
        alert(response);
    })
}