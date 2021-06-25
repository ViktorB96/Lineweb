<?php
function validanString($str)
{
    if(strpos($str, "=")!==false) return false;
    if(strpos($str, " ")!==false) return false;
    if(strpos($str, "(")!==false) return false;
    if(strpos($str, ")")!==false) return false;
    if(strpos($str, "'")!==false) return false;
    if(strpos($str, "/")!==false) return false;
    return true;
}

function login()
{
    if(isset($_SESSION['id']) and isset($_SESSION['ime']) and isset($_SESSION['status']))
        return true;
    elseif(isset($_COOKIE['id']) and isset($_COOKIE['ime']) and isset($_COOKIE['status']))
    {
        $_SESSION['id']=$_COOKIE['id'];
        $_SESSION['ime']=$_COOKIE['ime'];
        $_SESSION['status']=$_COOKIE['status'];
        $_SESSION['email']=$_COOKIE['email'];
        return true;
    }
    else
        return false;
    
}

function unistiSesiju()
{
    session_unset();
	session_destroy();
	setcookie("id", "", time()-1, "/");
	setcookie("ime", "", time()-1, "/");
    setcookie("status", "", time()-1, "/");
    setcookie("email", "", time()-1, "/");
}

function napraviSesiju($id, $ime, $prezime, $status, $email)
{
    $_SESSION['id']=$id;
    $_SESSION['ime']=$ime." ".$prezime;
    $_SESSION['status']=$status;
    $_SESSION['email']=$email;
    if(isset($_POST['zapamti']))
    {
        setcookie("id", $id, time()+86400, "/");
        setcookie("ime", "$ime $prezime", time()+86400, "/");
        setcookie("status", $status, time()+86400, "/");
        setcookie("email", $status, time()+86400, "/");
    }
}

function generisiLozinku()
{
    $ms=['a', 'b', 'c'];
    $vs=['A', 'B', 'C'];
    $br=[1, 2, 3, 4,5, 6, 7, 8, 9, 0];
    $zn=['!', "."];
    $lozinka=$ms[round(mt_rand(0, count($ms)-1))].$ms[round(mt_rand(0, count($ms)-1))].$vs[round(mt_rand(0, count($vs)-1))].$vs[round(mt_rand(0, count($vs)-1))].$br[round(mt_rand(0, count($br)-1))].$zn[round(mt_rand(0, count($zn)-1))];
	return  $lozinka;
}
?>