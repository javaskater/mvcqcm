<div class="container">
    <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
        $msg="";
        $erreur = $_GET['error'];
        echo "<div class=\"alert alert-danger\">";
        if ($erreur == "upfvide"){
            $msg = "Le fichier image n'a pu être téléchargé";
        } else if ($erreur == "upftype") {
            $msg = "Le fichier image doit être de type png";
        }
        echo $msg;
        echo "</div>";
    }
    if (isset($_GET['succes']) && !empty($_GET['succes'])){
        echo "<div class=\"alert alert-success\" role=\"alert\">";
        echo "l'image de votre profil a bien été uploadée";
        echo "</div>";
    }
    ?>
        <h4>Profil de <?php echo $personneConnectee['email']; ?></h4>
        <form enctype="multipart/form-data"action="mettreAJourProfile.php" method="POST">
        <div class="form-group">
<?php
if ($personneConnectee['statut'] == "eleve"){
    $idClasseUtilisateur = $personneConnectee["idClasse"];
    echo "<label for=\"classe\">Sélectionnez une classe</label>";
    echo "<select id=\"classe\" name=\"classe\" class=\"form-control\">";
    foreach ($classes as $classe){
        echo "<option value=".$classe['id'];
        if (!empty($idClasseUtilisateur) && $idClasseUtilisateur == $classe['id']){
            echo " selected "; 
        }
        echo ">".$classe['nom']."</option>";
    }
    echo "</select>";
 }
?>
        </div>    
            <div class="form-group">
                <label for="userfile">Image à uploader</label>
                <input type="file" name="userfile" class="form-control" id="userfile" aria-describedby="userImage" >
                <small id="userFileHelp" class="form-text text-muted">Cette image sera votre avatar</small>
            </div>
            <button type="button" class="btn btn-secondary" onclick="reset()">Remettre à zero</button>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
<?php
    $utilisateurId = $personneConnectee['id'];
    $urlImage = $personneConnectee['urlImage'];
    if (isset($urlImage) && !empty($urlImage)){
        echo "<img src=\"".BASE_URL.$urlImage."\" class=\"img-fluid\" alt=\"Avatar\" />";
    }
?>
    </div>
    <script>
        function reset(){
            var fileInput = document.getElementById("userfile");
            fileInput.value = "";
        }
    </script>