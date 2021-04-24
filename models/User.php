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
        $sql = "SELECT * FROM ".$this->table[0]." WHERE `email`='".$email."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);    
    }

}