<?php
class Questions extends Controller{

    
    public function index($param1=null){
        // On instancie le modèle "Theme"
        $this->loadModel('Theme');

        //on récupère la liste des thèmes
        $lesThemes = $this->Theme->findAllThemes();

        $this->loadModel('Question');
        $lesQuestions = $this->Question->findAllQuestions();

        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];
        //cas où param1 n'est pas vide
        if (isset($param1) && !empty($param1)){
            $typeErreur = $param1;
            //var_dump($typeErreur);
            $this->render('index', compact('personneConnectee', 'typeErreur', 'lesThemes', 'lesQuestions'));
        } else {
            $this->render('index', compact('personneConnectee','lesThemes', 'lesQuestions'));
        }
    }

    public function ajouter(){
        $this->loadModel('Question');
        $enErreur = false;
        $error = "";
        if(empty($_POST['texteQuestion'])){
            $error = $error. "qvide";
            $enErreur = true;
        }
        $nombreReponses = $_POST['choixNombreReponses'];
        for ($i=0; $i < $nombreReponses; $i++){
            $indexReponse = "r".$i;
            if(empty($_POST[$indexReponse])){
                if (!empty($error)){
                    $error = $error. "_";
                }
                $error = $error. "rvide";
                $enErreur = true;
                break;
            }
        }
        if(!isset($_POST['bonneReponse']) || empty($_POST['bonneReponse'])){ 
            if (!empty($error)){
                $error = $error. "_";
            }
            $error = $error. "rbvide";
            $enErreur = true;
        }
        if ($enErreur){
            setcookie("postValues", json_encode($_POST));//on renvoie les valeurs POST au formulaire
            header("Location:http://".BASE_URL."/questions/index/".$error);
        } else {
            unset($_COOKIE['postValues']);
            setcookie('postValues', '', time() - 3600, '/'); // empty value and old timestamp
            $idTheme = $_POST['selectTheme'];
            session_start();
            $idAuteur = $_SESSION['utilisateur']['id'];
            $texte = $_POST['texteQuestion'];
            $idNewQuestion = $this->Question->ajouterQuestion($idTheme, $idAuteur, $texte);
            for ($i=0; $i < $nombreReponses; $i++){
                $indexReponse = "r".$i;
                $texteReponse = $_POST[$indexReponse];
                $indexBonneReponse = "rb".$i;
                $bonneReponse = 0;
                if ($_POST['bonneReponse'] == $indexBonneReponse){
                    $bonneReponse = 1;
                }
                $this->Question->ajouterReponse($idNewQuestion, $texteReponse, $bonneReponse);
            }
            header("Location:http://".BASE_URL."/questions/index/");
        }
    }
}

?>