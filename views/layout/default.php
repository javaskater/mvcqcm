<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/bootstrap/bootstrap.css">
    <!--Font awesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <?php
        if (!isset($personneConnectee) || empty($personneConnectee)){
    ?>
        <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/signin.css">
    <?php  
        }
    ?>
</head>
<body class="text-center">
    <?php
       if (isset($personneConnectee) && !empty($personneConnectee)){
        if ($personneConnectee['statut'] == 'eleve'){
                ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Eleve</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=BASE_URL?>/users/profile"><i class="fas fa-user"></i>&nbsp;<?php echo $personneConnectee['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/qcmeleve/choixqcm.php">QCM</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://localhost/qcmcnam/notes/consulterNotes.php">Notes</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="users/logout">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="fas fa-sign-out-alt"></i> Log out
        </button>
    </form>
  </div>
</nav>
<?php
        } else if ($personneConnectee['statut'] == 'professeur'){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Professeur</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=BASE_URL?>/users/profile"><i class="fas fa-user"></i>&nbsp;<?php echo $personneConnectee['nom'];?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=BASE_URL?>/themes/index">Themes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=BASE_URL?>/questions/index">Questions Réponses</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          QCM
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://localhost/qcmcnam/qcm/creerqcm.php">Créer un QCM</a>
          <a class="dropdown-item" href="http://localhost/qcmcnam/qcm/publishqcm.php">Publier un QCM</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarNotesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarNotesDropdown">
          <a class="dropdown-item" href="http://localhost/qcmcnam/notes/gererNotes.php">Gérer Notes</a>
        </div>
      </li>    
    </ul>
    <form class="form-inline my-2 my-lg-0" action="<?=BASE_URL?>/users/logout">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="fas fa-sign-out-alt"></i> Log out
        </button>
    </form>
  </div>
</nav>
<?php
        }
    }
    ?>
        <?= $content ?>
    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?=BASE_URL?>/assets/js/jquery/jquery-3.6.0.js"></script>
    <script src="<?=BASE_URL?>/assets/js/bootstrap/bootstrap.js"></script>
  </body>
</html>