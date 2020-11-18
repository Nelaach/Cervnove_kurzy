<html>
    <head>
        <title>Přehled kurzů</title>
   </head>
    <body>
    <div class="container">
        <div><br>&nbsp</div>
        <div><br>&nbsp</div>
   
    <br>
   <table class="table">
               <tr>
            <td>  <b> Název kurzu </b> </td>
        <td>  <b> Počet míst </b> </td>
        </tr>                   

        <?php foreach ($kurzy as $kurz) { ?>
            <tr>
                <td>
                    <a href="<?php echo base_url('main/Detailne_PrehledKurzu/'.$kurz->id_hlavni) ?>">
                            <?= $kurz->nazev; ?></td>
                            <td><?= $kurz->pocet_mist; ?></td>                  
                    </a>
               
            </tr>
        <?php } ?>
    </table>
    </div>
       
        
    </body>
</html>
