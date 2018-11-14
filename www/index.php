<?php

require('models/Usermanager.php');



$userManager = new Usermanager();
$result = $userManager->add_user('bip', 'pass', 'mail');
echo ($result);
$result = $userManager->remove_user('b0p');
echo ($result);


/*
try
{
    
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
$req = $bdd->query('SELECT id, name, age FROM user_test ORDER BY id');
*/
?>

<html>
    <head>
        <title>Hello World</title>
    </head>

    <body>
        <?php
        /*
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
        */
        ?>
    </body>
</html>