<?php
class User extends Model{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table[] = "personne";
        $this->table[] = "classe";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne une la liste des classes
     */
    public function findClasses(){
        $sql = "SELECT * FROM ".$this->table[1]." order by id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

    /**
     * Retourne une personne en fonction de son email
     *
     * @param string $slug
     * @return void
     */
    public function findByEmail(string $email){
        $sql = "SELECT * FROM ".$this->table[0]." WHERE `email`= ?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_ASSOC);    
    }

    /**
     * Retourne une liste de personnes en fonction de son statut
     *
     * @param string $slug
     * @return void
     */
    public function findByStatut(string $statut){
        $sql = "SELECT * FROM ".$this->table[0]." WHERE `statut`= ?";
        $query = $this->_connexion->prepare($sql);
        $query->execute([$statut]);
        return $query->fetchAll(PDO::FETCH_ASSOC);    
    }

}