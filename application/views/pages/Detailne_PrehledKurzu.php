<html>
    <head>
                <title>Detailnější přehled kurzů</title>

    </head>
<style>
button {color: white;border-color: orange; background-color: orange}
</style>
    
    <body>
 <div><br>&nbsp</div>
  <div><br>&nbsp</div>
  
<div class="container">
    <h4 class="text-center"><?= $kurzy[0]->nazev ?></h4>

    <br>
    
    <label> <b> Popis: </b><?= $kurzy[0]->popis?></label> <br>
     <label> <b> Počet míst: </b> <?= $kurzy[0]->pocet_mist?></label><br>
</div>
  <div><br>&nbsp</div>
  <div><br>&nbsp</div>
    <div class="container">
    <div style="text-align: left">
        <button type="submit" name="register" class="btn btn-primary">Zapsat se</button>
    </div>
    </div>

   
    
    
        

        

    </body>
    </html>