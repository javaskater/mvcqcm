<?php
class Theme extends Model{


    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table[] = "notes";
    
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    /**
     * Retourne une la liste des thèmes
     */
    public function findAllThemes(){
        $sql = "SELECT * FROM ".$this->table[0]." order by id";
        $query = $this->_connexion->prepare($sql);
        $query->execute([]);
        return $query->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function ajouterTheme($label, $description){ //TODO traiter la PDOException
        $sql = "INSERT INTO ".$this->table[0]." (label, description) VALUES (?,?)";
        $this->_connexion->prepare($sql)->execute([$label, $description]);
    }


}