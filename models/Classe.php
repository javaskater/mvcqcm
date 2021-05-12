<?php
class Classe extends Model{


    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->tables[] = "classe";
        $this->tables[] = "qcmclasse";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function get($idQcm){
        $sql = "select * from ".$this->tables[1]." where idQcm = ? order by idClasse";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$idQcm]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($idQcm){
        $sql = "delete from ".$this->tables[1]." where idQcm = ?";
        $query = $this->_connexion->prepare($sql);
        return $query->execute([$idQcm]);
    }

    public function ajouteQcm($uneClasse, $idQcm){
        $sql = "insert into ".$this->tables[1]." (idQcm, idClasse) values (?,?)";
        $this->_connexion->prepare($sql)->execute([$idQcm, $uneClasse]);
        $idNewClasseQcm = $this->_connexion->lastInsertId();
    }
}