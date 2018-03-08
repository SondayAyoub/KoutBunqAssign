<?php
    /**************************************
    *        Create databases and         *
    *         open connections            *
    **************************************/
    try{
        $pdo = new PDO('sqlite:'.dirname(__FILE__).'/chatDB.db');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        echo $e->getMessage();
        die();
    }
?>