<?php
/**
 * Dit is de basecontroller waar alle nieuw te maken controllers van erven
 */
class Controller
{
    public function model($model)
    {
        // Pad naar modelclass bestand opgeven
        require_once '../app/models/' . $model . '.php';
        // Nieuw object van de model
        return new $model();
    }

    public function view($view, $data = [])
    {
        // Check of het bestand bestaat
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            echo ('View bestaat niet');
        }
    }
}