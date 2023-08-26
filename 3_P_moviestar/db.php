<?php
    $db_name = 'moviestar';
    $db_host = 'localhost';
    $db_user = 'postgres';
    $db_pass = 'welcome1';


    $conecao = new PDO('pgsql:dbname='.$db_name .';host='.$db_host, $db_user, $db_pass);


    $conecao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conecao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);