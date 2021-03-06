<?php
class Qcm extends Model{


    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->tables[] = "qcm";
        $this->tables[] = "questionqcm";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function ajouterNouveauQcm($libelle, $arrQuestionIds){
        try{
            $this->_connexion->beginTransaction();
            $sql = "INSERT INTO ".$this->table[0]." (libelle, publie) VALUES (?,0)";
            $this->_connexion->prepare($sql)->execute([$libelle]);
            $idNewQcm = $this->_connexion->lastInsertId();
            for ($i=0; $i < count($arrQuestionIds); $i++){
                $sql = "insert into ".$this->table[1]." (idQuestion, idQcm, ordre) values (?,?,?)";
                $this->_connexion->prepare($sql)->execute([$arrQuestionIds[$i], $idNewQcm, $i]);
            }
            $this->_connexion->commit();
            return $idNewQcm;
        } catch (PDOException $exception){
            if (isset($this->_connexion)){
                $this->_connexion->rollback();
            }
            echo "Erreur:".$exception;
            return null;
        }
    }

    public function recupererQcms($publie=null){
        $sql = "select * from qcm";
        if ($publie != null){
            $sql .= " where publie=?";
        }
        $query = $this->_connexion->prepare($sql);
        if ($publie != null){
            $query->execute([$publie]);
        } else {
            $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function publierQcm($idQcm, $publie){
        $sql = "UPDATE ".$this->tables[0]." SET publie=? WHERE id=?";
        $nombreLigneModifiées = $this->_connexion->prepare($sql)->execute([$publie, $idQcm]);
        return $nombreLigneModifiées;
    }

    public function totalQuestions($idQcm){
        $sqlCount = "select count(idQuestion) as count from ".$this->tables[1]." where idQcm= ?";
        $query = $this->_connexion->prepare($sqlCount);
        $query->execute([$idQcm]);
        return $query->fetch(PDO::FETCH_ASSOC);

    }
}