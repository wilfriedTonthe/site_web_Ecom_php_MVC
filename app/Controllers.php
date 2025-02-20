<?php

abstract class Controllers
{
    public function __construct()
    {
    }

    public function render($fichier, $data = [])
    {
        extract($data);
        ob_start();
        include_once ROOT . "views/" . lcfirst(get_class($this)) . "/" . $fichier . ".php";
        $contenu = ob_get_clean();
        include_once ROOT . "views/layout/default.php";

    }

    public function isValid($data)
    {
        foreach ($data as $element) {
            if (empty($element)) {
                return false;
            }
        }
        return true;

    }

}

?>