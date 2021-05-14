<?php
class Notes extends Controller{

    
    public function gerer(){
        // On instancie le modèle "Theme"
        //$this->loadModel('Note');
        $this->loadModel('Qcm');
        $this->loadModel('User');

        //on récupère la liste des élèves
        $lesEleves = $this->User->findByStatut('eleve');
        //on récupère la liste des QCM
        $lesQcm = $this->Qcm->recupererQcms(1);

        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];

        $this->render('gerer', compact('personneConnectee','lesEleves','lesQcm'));
    }
}