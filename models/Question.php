<?php
class Question extends Model{


    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table[] = "question";
        $this->table[] = "personne";
        $this->table[] = "reponse";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne une la liste des thèmes
     */
    public function findAllQuestions(){
        $sql = "select q.id as id, p.nom as nom, q.texte as texte from ".$this->table[0]." q, ".$this->table[1]." p where q.idAuteur = p.id order by q.id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function ajouterQuestion($idTheme, $idAuteur, $texte){
        $sql = "INSERT INTO ".$this->table[0]." (idTheme, idAuteur, texte) VALUES (?,?,?)";
        $this->_connexion->prepare($sql)->execute([$idTheme, $idAuteur, $texte]);
        return $idNewQuestion = $this->_connexion->lastInsertId();
    }
    
    public function ajouterReponse($idNewQuestion, $texteReponse, $bonneReponse){
        $sql = "INSERT INTO ".$this->table[2]." (idQuestion, texte, bonneReponse) VALUES (?,?,?)";
        $this->_connexion->prepare($sql)->execute([$idNewQuestion, $texteReponse, $bonneReponse]);
        return $idNewQuestion = $this->_connexion->lastInsertId();
    }
}