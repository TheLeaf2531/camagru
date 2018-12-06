<?php

    class Controller
    {
        public function model($model)
        {
            require_once '../app/models/' . $model . '.php';

            return new $model();
        }

        public function view($view, $data = [])
        {
            //echo "Search view : " . '../app/views/' . $view . '.php';
            if (file_exists('../app/views/' . $view . '.php'))
            {
                require_once '../app/views/' . $view . '.php';
            }
            else
            {
                die('View does not exist');
            }
        }
    }