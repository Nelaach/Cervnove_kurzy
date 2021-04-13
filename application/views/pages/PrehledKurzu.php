<html>
    <head>
        <title>Přehled kurzů</title>
        <script src="https://kit.fontawesome.com/d089b36c07.js" crossorigin="anonymous"></script>
    </head>
    <body>
      
<?php $dnes = date('Y-m-d H:i:s'); ?>
        <div class="container">
            <div><br>&nbsp</div>
            <div><br>&nbsp</div>
<div class="container"> 
<b>Uzamknuto -</b> <i class="fas fa-lock"></i>

</div>
            <br>
            <table class="table">
                <tr>
                    <td>  <b> Název kurzu </b> </td>
                    <td>  <b> Počet míst </b> </td>
                    <td>  <b> Učitel/ka </b> </td>
                    <td>  <b> Místo </b> </td>
                    <td>  <b> Cena </b> </td>
                </tr>                   

                <?php foreach ($kurzy as $kurz) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url('main/Detailne_PrehledKurzu/' . $kurz->id_hlavni) ?>">
                            <?= $kurz->nazev; ?><?php if ($kurz->uzavreni < $dnes) {?>&nbsp<i class="fas fa-lock"></i><?php } ?>  </td>
                        <td><?= $kurz->pocet_mist; ?></td>
                        <td><?= $kurz->ucitel_jmeno; ?>&nbsp<?= $kurz->ucitel_prijmeni; ?></td> 
                        <td><?= $kurz->misto; ?></td>
                        <td><?= $kurz->cena; ?></td>
                    </tr>
                <?php } ?>

            </table>
        </div> 

    </body>
</html>

