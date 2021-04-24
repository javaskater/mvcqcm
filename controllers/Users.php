<?php

class Users extends Controller{
    /**
     * Cette méthode affiche la liste des articles
     *
     * @return void
     */
    public function index(){
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
            // On instancie le modèle "Utilisateur"
            $this->loadModel('User');

            // On stocke le nom de la personne connectee
            $personneConnectee = $this->User->findByEmail($email);
            $motDePasseBase = $personneConnectee['motdepasse'];
            if($motDePasseBase == $password){
                // On envoie les données à la vue index
                session_start();
                $_SESSION['utilisateur'] = $personneConnectee;
                $this->render('index', compact('personneConnectee'));
            } else {
                header("Location:".BASE_URL."?error=incorrect");
            }
            
        } else {
            header("Location:".BASE_URL."?error=vide");
        }
    }

    public function profile($erreur = null){
        // On instancie le modèle "Utilisateur"
        session_start();
        //var_dump($_SESSION);
        $this->loadModel('User');
        $classes = $this->User->findClasses();
        //var_dump($classes);
        $personneConnectee = $_SESSION['utilisateur'];
        $this->render('profile', compact('classes','personneConnectee'));
    }

    public function logout(){
        session_start();
        unset($_SESSION['utilisateur']);
        session_destroy();
        header("Location:".BASE_URL);
    }
}