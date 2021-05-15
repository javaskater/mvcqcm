<?php
class Note extends Model{


    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table[] = "notes";
        $this->table[] = "personne";
        $this->table[] = "qcm";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne une la liste des liste de Notes
     */
    public function findNotes($personneId=null, $qcmId=null){
        $sql = "select p.nom as nom, qcm.id as qcmid, qcm.libelle as libelle, n.note as note, n.id as id, n.publie as publie from ".$this->table[1];
        $sql .= " p, ".$this->table[2]." qcm, ".$this->table[0]." n ";
        $sql .= "where n.idPersonne = p.id and n.idQcm = qcm.id";
        if ($personneId != null){
            $sql .= " and p.id = ".$personneId;
        }
        if ($qcmId != null){
            $sql .= " and qcm.id = ".$qcmId;
        }
        //echo "sql vaut".$sql;
        $query = $this->_connexion->prepare($sql);
        $query->execute([]);
        return $query->fetchAll(PDO::FETCH_ASSOC);    
    }

    /**
     * Retourne une note particulière
     */
    public function findNote($noteId){
        $sql = "select p.email as email, n.note as note, q.libelle as titreQcm, q.id as qcmId ";
        $sql .= "from ".$this->table[1]." p, ".$this->table[2]." q, ".$this->table[0]." n ";
        $sql .= "where n.idQcm = q.id and n.idPersonne = p.id and n.id=?";
        //echo "sql vaut".$sql;
        $query = $this->_connexion->prepare($sql);
        $query->execute([$noteId]);
        return $query->fetch(PDO::FETCH_ASSOC);    
    }

    public function publierNote($idNote, $publie){
        $sql = "update notes set publie=? where id=?";
        $nombreLigneModifiées = $this->_connexion->prepare($sql)->execute([$publie, $idNote]);
        return $nombreLigneModifiées;
    }
}