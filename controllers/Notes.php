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

    public function update(){
        //var_dump($_POST);
        $this->loadModel('Note');
        $publie = 0;
        if (isset($_POST['publication']) && !empty($_POST['publication']) && $_POST['publication'] == 'on'){
            $publie = 1;
        }
        $idNote = $_POST['noteId'];
        //$maConn = openconnection();
        //$sql = "update notes set publie=".$publie." where id=".$idNote;
        //$result = mysqli_query($maConn,$sql) or die("requete mise à jour note en erreur");
        $result = $this->Note->publierNote($idNote, $publie);
        
        // envoyer un mail si publié
        if ($publie == 1){
            //$sql = 'select p.email as email, n.note as note, q.libelle as titreQcm, q.id as qcmid from personne p, qcm q, notes n where n.idQcm = q.id and n.idPersonne = p.id and n.id='.$idNote;
            //$result = mysqli_query($maConn,$sql) or die("paramètres mail note en erreur");
            if($line = $this->Note->findNote($idNote)){
                $this->loadModel('Qcm');
                if ($lineCount = $this->Qcm->totalQuestions($line['qcmId'])){
                    $nbeQuestions = $lineCount['count'];
                    $note = $line['note']."/".$nbeQuestions;
                    $destinataire = $line['email'];
                    $titreQcm = $line['titreQcm'];
                    $to      = $destinataire;
                    $subject = 'le résultat de votre QCM';
                    $message = 'Pour votre QCM '.$titreQcm.'\r\n';
                    $message = 'vous avez obtenu la note de '.$note.' pour le QCM: '.$titreQcm;
                    $headers = 'From: jpm@jpmena.eu' . "\r\n" .
                    'Reply-To: jpm@jpmena.eu' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                }
            }
        }
        header("Location:".BASE_URL."/notes/gerer");
    }
}