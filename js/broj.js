function broj()
{
    $.get("ajax/ajax_korpa.php?funkcija=broj", function(response){
        $("#broj").html(response);
    })
}

broj();