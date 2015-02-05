<?php

/* Simple php app to test AWS */

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

$string = 'Chaine aleatoire : '.rand(0,999);
$string .= 'Êl síla erin lû e-govaned vîn.';

//IP du l'instance AWS du serveur MySQL
$link = new PDO(
    'mysql:host=54.171.240.167;dbname=testaws;charset=utf8mb4',
    'root',
    'root'
);

$handle = $link->prepare('insert into TestTable (body) values (?)');
$handle->bindValue(1, $string);
$handle->execute();
 
$result = $link->query('select * from TestTable',PDO::FETCH_OBJ);

header('Content-Type: text/html; charset=UTF-8');
?><!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AWS test page</title>
    </head>
    <body>
        <?php
        foreach($result as $row){
            print($row->body) . "<br>";
        }
        ?>
    </body>
</html>