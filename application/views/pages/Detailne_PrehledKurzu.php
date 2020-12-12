<html>
    <head>
        <title>Detailnější přehled kurzů</title>

    </head>
    <script>
        window.onload = function () {
            if (!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
        };
    </script>

    <style>
        button {color: white;border-color: orange; background-color: orange}
    </style>
    <body>

        <?php
        $email = $this->session->userdata('email');

        $funkce = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
        foreach ($funkce as $key) {
            $oFunkce = $key->funkce;
        }
        ?>
        <div><br>&nbsp</div>
        <div><br>&nbsp</div>

        <div class="container">
            <h4 class="text-center"><?= $kurzy[0]->nazev ?></h4>

            <br>

            <label> <b> &nbsp&nbspPopis: </b><?= $kurzy[0]->popis ?></label> <br>
            <label> <b> &nbsp&nbspPočet míst: </b> <?= $kurzy[0]->pocet_mist ?></label><br>
            <label> <b> &nbsp&nbspUčitel/ka: </b> <?= $kurzy[0]->ucitel_jmeno ?> &nbsp<?= $kurzy[0]->ucitel_prijmeni ?></label><br>
            <?php
            foreach ($kurzy as $key) {
                $oKurzy = $key->id_hlavni;
            }
            foreach ($kurzy as $key) {
                $oNazev = $key->nazev;
            }

            foreach ($stejnyKurz as $key) {
                $oStejnyKurz = $key->kurz;
            }
            ?> 

            <label><b>&nbsp&nbspPřihlášení studenti:</b></label>

            <?php foreach ($jmena as $jmeno) { ?>
            <td><br>&nbsp&nbsp<?= $jmeno->jmeno; ?>&nbsp<?= $jmeno->prijmeni; ?></td> 

            <?php } ?>


        </div>
        <?php
        if ($oFunkce == "student") {
            if ($oNazev !== $oStejnyKurz) {
                ?>


                <div class="container">
                    <label>    
                        <button type="button" class="btn btn-primary" onclick="window.location = '<?php echo site_url("Main/ZapisDat/" . $oKurzy); ?>'">Zapsat se</button>

                    </label>     

                </div>

            <?php }
        } ?>  


    </body>
</html>