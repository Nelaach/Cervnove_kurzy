

<!DOCTYPE html>
<html>

    <head> 
        <title>Úprava kurzu </title> 
        
    </head>
<script>
    window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
};
</script>
    <body>
        <div><br>&nbsp</div>
        <div><br>&nbsp</div>
 <?php
foreach ($nazev as $key ) {$oNazev=$key->nazev;}
foreach ($popis as $key ) {$oPopis=$key->popis;}


?>
        

        <div class="container">	
            <form method="post" action="http://localhost/Kurzy/index.php/main/zmena">
                <h4 style="text-align: center">Úprava kurzu</h4>
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Název kurzu</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control" name="nazev" value="<?= $oNazev ?>">
                        </div>
                    </div>      


                    <div class="col-md-6">
                        <label>Počet účastníků</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">                               
                            </div>
                            <input type="number" min="5" max="50" class="form-control" value="<?= $pocet[0]->pocet_mist ?>" readonly name="pocet_mist">
                        </div> 
                    </div>
                </div>


                <div class="form-group">
                    <label>Popis</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1"  rows="3" name="popis"><?= $oPopis?></textarea>
                </div>





                <div style="text-align: left">
                    <button type="submit" name="register" class="btn btn-primary">Přepsat</button>
                </div>
            </form>

       </div>



    </body>
</html>