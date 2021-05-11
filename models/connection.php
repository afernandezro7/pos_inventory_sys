<?php

class Connection {

    static public function connect(){
        $host = 'localhost';
        $dBName = 'pos';
        $dBUser = 'root';
        $password = '';

        $link = new PDO("mysql:host=$host;dbname=$dBName",$dBUser, $password);
        $link->exec("set names utf8");

        return $link;
    }
}