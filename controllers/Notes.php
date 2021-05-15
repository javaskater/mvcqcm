<?php
class Notes extends Controller{

    
    public function gerer(){
        // On instancie le modèle "Theme"
        $this->loadModel('Note');
        $this->loadModel('Qcm');
        $this->loadModel('User');

        //on récupère la liste des élèves
        $lesEleves = $this->User->findByStatut('eleve');
        //on récupère la liste des QCM publiés (1)
        $lesQcm = $this->Qcm->recupererQcms(1);

        $eleveId = null;
        $qcmId = null;
        if (isset($_POST["selectEleve"]) && !empty($_POST["selectEleve"])){
            $eleveId = $_POST["selectEleve"];
        }
        if (isset($_POST["selectQcm"]) && !empty($_POST["selectQcm"])){
            $qcmId = $_POST["selectQcm"];
        }

        $notesAAfficher = $this->Note->findNotes($eleveId, $qcmId);
        $nbeQuestionsArr = [];
        foreach($notesAAfficher as $note){
            $idQcm = $note['qcmid'];
            $nbeQuestionsArr[] = $this->Qcm->totalQuestions($idQcm);
        }

        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];

        //var_dump($nbeQuestionsArr);
        $this->render('gerer', compact('personneConnectee','lesEleves','lesQcm','notesAAfficher', 'nbeQuestionsArr'));
    }
}