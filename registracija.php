<?php
require_once("require.php");
$db=new Baza();
$db->connect();
if(isset($_GET['email']) and isset($_GET['broj']))
{
    $email=$_GET['email'];
    $validan=$_GET['broj'];
    if($email!="" and $validan!="")
    {
        $sql="UPDATE korisnici SET validan=1 WHERE email='{$email}' AND validan={$validan}";
        $db->query($sql);
        if($db->affected_rows()==1)
            echo "Uspešna registracija";
        else
            echo "Neuspešna potvrda registracije";
    }
    else
        echo "Podaci za potvrdu registracije nisu validni";
}
?>