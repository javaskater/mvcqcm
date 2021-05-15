<div class="container-fluid">
	<div class="row flex-xl-nowrap mt-2">
        <div class="col-12 col-md-3 col-xl-2">
            <form method="post" action="<?=BASE_URL?>/notes/gerer">
              <div class="form-group">
                <label for="selectEleve">Choix de l'élève</label>
                <select class="form-control" id="selectEleve" name="selectEleve">
                    <option value="">Neant</option>
                	<?php 
                	foreach ($lesEleves as $eleve){
                	    echo "<option value=".$eleve['id'].">".$eleve['nom']."</option>";
                	}
                	?>
                </select>
              </div>
              <div class="form-group">
                <label for="selectQcm">Choix d'un QCM</label>
                <select class="form-control" id="selectQcm" name="selectQcm">
                    <option value="">Neant</option>
                	<?php 
                	foreach ($lesQcm as $qcm){
                	    echo "<option value=".$qcm['id'].">".$qcm['libelle']."</option>";
                	}
                	?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
		</div>
		<div class="col-12 col-md-6 col-xl-10">
		<?php
		echo "<ul class=\"list-group\">";
    for ($i = 0; $i < count($notesAAfficher); $i++){
      $line = $notesAAfficher[$i];
      $nbeQuestions = $nbeQuestionsArr[$i]['count'];
      $msgPublication = $line['publie'] == 1?"publié":"non publié"; 
		  echo "<li class=\"list-group-item\"><a href=\"#\" id=".$line['id']." class=\"openModal\">".$line['libelle']." (eléve:".$line['nom']."). Note: ".$line['note']."/".$nbeQuestions." ".$msgPublication."</li>";
      echo "<div class=\"modal fade\" data-backdrop=\"backdrop\" id=\"exampleModal".$line['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">";
?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="updateNote.php">
      <div class="modal-body">
      <?php 
        echo "<div class=\"form-group\">";
        echo "<label for=\"publierElement\">Publier Note</label>";
        echo "<input type=\"checkbox\" id=\"publierElement\" name=\"publication\"";
        $pub = $line['publie'] == 1?"checked":""; 
        echo " ".$pub." />";
        echo "<input type=\"hidden\" name=\"nodeId\" value=".$line['id']." />";
        echo "</div>";
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<?php
    }
		echo "</ul>";
        ?>
		</div>
	</div> <!-- fin du Row -->
</div> <!-- fin du Container -->
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?=BASE_URL?>/assets/js/jquery/jquery-3.6.0.js"></script>
    <script src="<?=BASE_URL?>/assets/js/bootstrap/bootstrap.js"></script>
    <script>
        $('.openModal').on('click', function(e){
        console.log("lmsqkdqmlkdqmldk:"+ e.target.id);
        var id = e.target.id;
        $('#exampleModal'+id).modal('show');
        //e.preventDefault();
        });
    </script>