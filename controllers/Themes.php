<?php

class Themes extends Controller{

    
    public function index($param1=null){
        // On instancie le modèle "Theme"
        $this->loadModel('Theme');

        //on récupère la liste des thèmes
        $lesThemes = $this->Theme->findAllThemes();

        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];
        //cas où param1 n'est pas vide
        if (isset($param1) && !empty($param1)){
            $typeErreur = $param1;
            $this->render('index', compact('personneConnectee', 'typeErreur', 'lesThemes'));
        } else {
            $this->render('index', compact('personneConnectee','lesThemes'));
        }
    }

    public function ajouter(){
        if (isset($_POST['labelTheme']) && !empty($_POST['labelTheme']) && isset($_POST['textTheme']) && !empty($_POST['textTheme'])){
            // On instancie le modèle "Theme"
            $this->loadModel('Theme');
            //on ajoute le thème
            $lesThemes = $this->Theme->ajouterTheme($_POST['labelTheme'],  $_POST['textTheme']);
            header("Location:".BASE_URL."/themes/index");
        } else {
            header("Location:".BASE_URL."/themes/index/vide");
        }
    }
}

?>