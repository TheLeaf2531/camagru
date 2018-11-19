<?php

print_r($data);

?>


<h1> Suscribe page </h1>

<form action="/suscribe" method="post">
    Mail :<br>
    <input type="email" name="user_mail"><br>
    Login name :<br>
    <input type="text" name="user_login"><br>
    Passeword :<br>
    <input type="password" name="user_password"><br>
    <p><input type="submit" /></p>
</form>