<?php

Route::set('about-us', function(){
    AboutUs::CreateView("AboutUs");
});

Route::set('suscribe', function(){
    Suscribe::CreateView("Suscribe");
});

Route::set('testicouille', function(){
    echo "testicouille";
});

?>