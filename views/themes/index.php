<div class="container">
<?php
        if (isset($typeErreur) && !empty($typeErreur)) {
            echo "<div class=\"alert alert-danger\">";
            echo "<strong>Erreur!</strong>";
            if ($typeErreur == "vide") {
                echo "veuillez entrer un label non vide pour votre thème";
            }
            echo "</div>";
        }
    ?>
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="<?=BASE_URL?>/themes/ajouter">
              <div class="form-group">
                <label for="labelTheme">Label du Thème</label>
                <input type="text" class="form-control" id="labelTheme" name="labelTheme" aria-describedby="labelTheme" placeholder="Entrez le Thème">
                <small id="labelThemeHelp" class="form-text text-muted">Ceci sera le thème que vous choisirez</small>
              </div>
              <div class="form-group">
                <label for="textTheme">Description du thème</label>
                <input type="text" class="form-control" id="textTheme" name="textTheme" placeholder="description">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
		</div>
		<div class="col-12 col-md-6 col-xl-10">
        <ul class="list-group">
            <?php
                foreach($lesThemes as $unTheme):
                    echo "<li class=\"list-group-item\"><a href=\"editTheme.php?id=".$unTheme['id']."\">".$unTheme['label']."</li>";
                endforeach;
            ?>
        </ul>
        </div>
	</div>
</div>