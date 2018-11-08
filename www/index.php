<?php

try
{
    $bdd = new PDO('mysql:host=192.168.99.100:9906;dbname=test;charset=utf8', 'root', 'pass');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
$req = $bdd->query('SELECT id, name, age FROM user_test ORDER BY id');

?>

<html>
    <head>
        <title>Hello World</title>
    </head>

    <body>
        <?php
        while ($donnees = $req->fetch())
        {
        ?>
            <h3>
                <?php
                    echo $donnees['name'];
                ?>
            </h3>
        </div>
        <?php
        }
        echo "Hello, World!";
        ?>
    </body>
</html>