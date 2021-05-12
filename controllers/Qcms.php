<?php
class Qcms extends Controller{
    function creer(){

        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];

        $this->loadModel('Question');
        $lesQuestions = $this->Question->findQuestionsByQcm();
        
        $this->render('creer', compact('personneConnectee','lesQuestions'));
    }
    
    function ajouter($libelle=null, $idQuestions=null){
        //var_dump($libelle);
        //var_dump($idQuestions);
        $this->loadModel('Qcm');
        $arrQuestionIds = explode('_', $idQuestions );
        
        $lesQuestions = $this->Qcm->ajouterNouveauQcm($libelle, $arrQuestionIds);
        header("Location:".BASE_URL."/qcms/creer");
    }

    /*
    récupère tous les QCM et notent leurs ids line
    récupère toutes les classes et note leur nom et Id 
    on récupère les idClasses de qcmclasse pour un idQcm vaut i
    */
    function publish(){
        //on n'oublie pas les personnes connectées pour l'entête
        session_start();
        $personneConnectee = $_SESSION['utilisateur'];
        $this->loadModel('Qcm');
        $this->loadModel('Classe');
        $arrayQcmClasses = array();
        $arrayQcms = $this->Qcm->getAll();
        foreach ($arrayQcms as $qcm){
            $arrClasses = $this->Classe->get($qcm['id']);
            $arrayQcmClasses[] = ['qcmId' => $qcm['id'], 'classes' => $arrClasses];
        }
        
        $arrayClasses = $this->Classe->getAll();

        /*foreach ($arrayQcmClasses as $qcm){
            print_r($qcm);
            echo "<hr />";
        }*/

        $this->render('publish', compact('personneConnectee', 'arrayQcms', 'arrayClasses', 'arrayQcmClasses'));
    }

    function publishAction(){
        $arrLesCases = explode('+',$_POST["cases"]);
        //var_dump($arrLesCases);
        //$maConn = openconnection();
        $this->loadModel('Qcm');
        $this->loadModel('Classe');
        foreach ($arrLesCases as $idQcm){
            $checkBoxName = 'cb'.$idQcm;
            if (isset($_POST[$checkBoxName]) && !empty($_POST[$checkBoxName]) && $_POST[$checkBoxName] == "on"){
                //echo $checkBoxName. " selectionnée <br />";
                //$sql = "update qcm set publie = 1 where id=".$laCase;
                $this->Qcm->publierQcm($idQcm, 1);
            } else {
                //echo $checkBoxName. " non selectionnée <br />";
                //$sql = "update qcm set publie = 0 where id=".$laCase;
                $this->Qcm->publierQcm($idQcm, 0);
            }
            //$result = mysqli_query($maConn,$sql) or die("requete publish QCM en erreur");
            $selectName = 's'.$idQcm;
            //$laCase est l'idQcm les données de $POST[]
            //$sqldelete = "delete from qcmclasse where idQcm = ".$laCase;
            //$result = mysqli_query($maConn,$sqldelete) or die("requete supprimer QcmClasse en erreur");
            $this->Classe->delete($idQcm);
            $arrLesClasses = $_POST[$selectName];
            foreach($arrLesClasses as $uneClasse){
                //$sqlinsert = "insert into qcmclasse (idQcm, idClasse) values (".$idQcm.",".$uneClasse.")";
                //$result = mysqli_query($maConn,$sqlinsert) or die("requete insérer QcmClasse en erreur");
                $this->Classe->ajouteQcm($uneClasse, $idQcm);
            }
        }
        
        //mysqli_close($maConn);
        header("Location:".BASE_URL."/qcms/publish");
    }
}