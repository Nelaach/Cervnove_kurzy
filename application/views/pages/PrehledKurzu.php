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
                    <td>  <b> Učitel/ka </b> </td>
                    <td>  <b> Místo </b> </td>
                    <td>  <b> Cena </b> </td>
                </tr>                   

                <?php foreach ($kurzy as $kurz) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url('main/Detailne_PrehledKurzu/' . $kurz->id_hlavni) ?>">
                            <?= $kurz->nazev; ?></td>
                        <td><?= $kurz->pocet_mist; ?></td>
                        <td><?= $kurz->ucitel_jmeno; ?>&nbsp<?= $kurz->ucitel_prijmeni; ?></td> 
                        <td><?= $kurz->misto; ?></td>
                        <td><?= $kurz->cena; ?></td>
                        </a>
                    </tr>
                <?php } ?>

            </table>
        </div> 

    </body>
</html>
