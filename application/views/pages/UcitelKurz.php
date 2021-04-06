

<!DOCTYPE html>
<html>

    <head> 
        <title>Úprava kurzu </title> 
        
    </head>


    <body>
        <div><br>&nbsp</div>
        <div><br>&nbsp</div>
 <?php
foreach ($nazev as $key ) {$oNazev=$key->nazev;}
foreach ($popis as $key ) {$oPopis=$key->popis;}
foreach ($misto as $key ) {$oMisto=$key->misto;}
foreach ($cena as $key ) {$oCena=$key->cena;}
foreach ($uzamknuto as $key ) {$oUzamknuto=$key->uzamknuto;}
?>
        

        <div class="container">	
            <form method="post" action="<?php echo base_url('main/zmena') ?>">
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
                <div class="row">
                    <div class="col-md-6">
                        <label>Místo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            </div>
                            <input type="text" class="form-control" name="misto" value="<?= $oMisto ?>">
                        </div>
                    </div>      


                    <div class="col-md-6">
                        <label>Cena</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">                               
                            </div>
                            <input type="number"  class="form-control" value="<?= $oCena ?>" name="cena">
                        </div> 
                    </div>
                </div>


                <div class="form-group">
                    <label>Popis</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1"  rows="3" name="popis"><?= $oPopis?></textarea>
                </div>





                <div style="text-align: left">
                    <button type="submit" name="register" class="btn btn-primary">Přepsat</button>
                    <?php
        if ($oUzamknuto == "1") {
                ?>
                    <a class="btn btn-primary " href="<?php echo base_url('main/uzamknout') ?>" role="button">Odemknout</a>
            <?php } ?>  

            <?php
        if ($oUzamknuto == "0") {
                ?>
                    <a class="btn btn-primary " href="<?php echo base_url('main/uzamknout') ?>" role="button">Uzamknout</a>
            <?php } ?>  

               </div>
            </form>
 
       </div>




    </body>
</html>