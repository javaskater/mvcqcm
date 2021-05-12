<div class="container-fluid">
    <form method="POST" action="<?=BASE_URL?>/qcms/publishAction">
    	<div class="row flex-xl-nowrap mt-2">
            <div class="col-12 col-md-12 col-xl-12">
                <ul class="list-group" id="questionsQcm">
                <?php 
                    $casesaCocher = "";
                    //$sql = "select * from qcm order by id";
                    //echo $sql;
                    //$result = mysqli_query($maConn,$sql) or die("requete affiche QCM publish en erreur");
                    foreach ($arrayQcms as $line){
                        $casesaCocher = $casesaCocher.$line['id']."+";
                        echo "<li class='list-group-item'>";
                        echo $line['libelle']. " <input type='checkbox' name='cb".$line['id']."' value='on'";
                        if($line['publie'] == 1){
                            echo " checked";
                        }
                        echo " />";
                        //$sqlClasses = "select id, nom from classe";
                        //$resultClasses = mysqli_query($maConn,$sqlClasses) or die("requete recupere classe en erreur");
                        echo "<div class=\"form-group\">";
                        echo "<label for=\"classesSelect\">Sélectionnez une ou des classe(s)</label>";
                        echo "<select multiple class=\"form-control\" name=\"s".$line['id']."[]\" id=\"s".$line['id']."\">";
                        foreach ($arrayClasses as $lineClasses){
                            echo "<option value=".$lineClasses['id'];
                            //$sqlQcmClasses = "select idClasse from qcmclasse where idQcm = ".$line['id'];
                            //$resultQcmClasses = mysqli_query($maConn,$sqlQcmClasses) or die("requete recupere  qcm classe en erreur");
                            foreach ($arrayQcmClasses as $linetQcmClasses){
                                if ($linetQcmClasses['qcmId'] == $line['id']){
                                    foreach ($linetQcmClasses['classes'] as $linetQcmClasse){
                                        if ($linetQcmClasse['idClasse'] == $lineClasses['id']){
                                            echo " selected ";
                                        }
                                    }   
                                }
                            } 
                            echo ">".$lineClasses['nom']."</option>";
                        }
                        echo "</select>";
                        echo "</li>";
                    }
                    $casesaCocher=substr($casesaCocher, 0, -1);
                    echo "<input type='hidden' name='cases' value='".$casesaCocher."' />";
                    //fermerConnection($result, $maConn);
                ?>
        		</ul>
        		<button type="submit" class="btn btn-primary">publier</button>
            </div>
        </div>
    </form>
</div>