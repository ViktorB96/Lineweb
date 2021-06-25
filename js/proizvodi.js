function ubaciUKorpu(idProizvoda)
{
    $.post("ajax/ajax_proizvodi.php", {idProizvoda: idProizvoda}, function(response){
        broj();
        alert(response);
    })
}