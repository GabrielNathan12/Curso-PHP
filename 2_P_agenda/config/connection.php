<?php
    $host = 'localhost';
    $dbname = 'agenda';
    $user = 'root';
    $pass = '';

    try{
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $error){
        $erro = $error->getMessage();
        echo "Error: $erro".'<br>';
    }