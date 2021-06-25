<?php
class Log{
    public static function upisiLog($imeDatoteke, $tekstZaUpis){
        $tekstZaUpis=date("d.m.Y H:i:s", time())." - $tekstZaUpis\r\n";
        /*$f=fopen($imeDatoteke, "a");
        fwrite($f, $tekstZaUpis);
        fclose($f);*/
        $tekst="";
        if(file_exists($imeDatoteke)) $tekst=file_get_contents($imeDatoteke);
        $tekstZaUpis=$tekstZaUpis.$tekst;
        file_put_contents($imeDatoteke, $tekstZaUpis);
    }
}
?>