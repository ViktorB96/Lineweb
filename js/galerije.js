$(function(){
    //alert("Radi");
    let odgovor=$("#odgovor");
    $("#tagovi").tokenInput("ajax/lineweb_korisnici.php", {
        theme: "facebook"
    });
    popuniGalerije();
    $("#btnSnimiGaleriju").click(function(){
        //alert("Radi");
        let naziv=$("#nazivGalerije").val();
        let komentar=$("#komentarGalerije").val();
        if(naziv=="")
        {
            odgovor.html("<span style='color:red'>Niste uneli naziv</span>");
            return false;
        }
        $.post("ajax/ajax_galerije.php?funkcija=snimiGaleriju", {naziv: naziv, komentar: komentar}, function(response){
            odgovor.html(response);
            popuniGalerije();
        })
            
    })
    $("#obrisiGaleriju").click(function(){
        if(!confirm("Da li ste sigurni da želite da izbrišete galeriju")) return false;
        let id=$("#idGalerije").val();
        if(id=="0")
        {
            odgovor.html("<span style='color:red'>Niste izabrali galeriju za brisanje</span>");
            return false;
        }
        $.post("ajax/ajax_galerije.php?funkcija=obrisiGaleriju", {id: id}, function(response){
            odgovor.html(response);
            popuniGalerije();
        })
    })

    
    $("#btnSnimiSliku").click(function(){
        $.ajax({
            url: "ajax/ajax_galerije.php?funkcija=snimiSliku",
            type: "POST",
            data: new FormData(document.getElementById('forma')),
            contentType: false,
            cache: false,
            processData: false,
            success: uspeh,
            error: greska,
            //beforeSend: preSlanja
        })
    })

})

function popuniGalerije()
{
    let odgovor=$("#odgovor");
    $.post("ajax/ajax_galerije.php?funkcija=popuniGalerije", function(response){
        //odgovor.html(response);
        g=JSON.parse(response);
        let sel=$("#idGalerije");
        sel.empty().append(new Option("--Izaberite galeriju--", "0"));
        for(i=0;i<g.length;i++)
            sel.append(new Option(g[i].naziv, g[i].id));
    })
}

function popuniSlike()
{
    let idGalerije=$("#idGalerije").val();
    let div=$("#divPrikazSlika");
    if(idGalerije=="0")
    {
        div.html("");
        return false;
    }
    $.post("ajax/ajax_galerije.php?funkcija=popuniSlike", {idGalerije: idGalerije}, function(response){
        div.html(response);
        
    })

}

function uspeh(response){
    $("#odgovor").html(response);
    popuniSlike();
}
function greska(xhr){
    $("#odgovor").html("GREŠKA!!!!<br>"+xhr.status+"<br>"+xhr.statusText);
}

function obrisiSliku(id)
{
    $.post("ajax/ajax_galerije.php?funkcija=obrisiSliku", {id:id}, function(response){
        $("#slika_"+id).remove();
        popuniSlike();
    })
}