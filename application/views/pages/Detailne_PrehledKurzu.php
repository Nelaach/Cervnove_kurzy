<html>

<head>
    <title>Detailnější přehled kurzů</title>

</head>
<script>
    //JavaScript function that enables or disables a submit button depending
    //on whether a checkbox has been ticked or not.
    function terms_changed(termsCheckBox) {
        //If the checkbox has been checked
        if (termsCheckBox.checked) {
            //Set the disabled property to FALSE and enable the button.
            document.getElementById("submit_button").disabled = false;
        } else {
            //Otherwise, disable the submit button.
            document.getElementById("submit_button").disabled = true;
        }
    }
</script>

<style>
    button {
        color: white;
        border-color: orange;
        background-color: orange
    }

    h5 {
        color: red;

    }
</style>

<body>

    <?php
    $email = $this->session->userdata('email');

    $funkce = $this->db->query('SELECT funkce FROM uzivatel where email="' . $email . '"')->result();
    foreach ($funkce as $key) {
        $oFunkce = $key->funkce;
    }
    $query = $this->db->query('select * from uzivatel where kurz_idKurz = ' . $kurzy[0]->idKurz . ' and funkce = "student"');
    $prihlaseni_studenti = $query->num_rows();
    ?>
    <div><br>&nbsp</div>
    <div><br>&nbsp</div>
    <div class="container">
        <h4 class="text-center"><?= $kurzy[0]->nazev ?></h4>

        <br>

        <label> <b> &nbsp&nbspPopis: </b><?= $kurzy[0]->popis ?></label> <br>
        <label> <b> &nbsp&nbspPočet obsazených míst: </b> <?php echo $prihlaseni_studenti;
                                                            echo "/";
                                                            echo $kurzy[0]->pocet_mist ?></label><br>
        <label> <b> &nbsp&nbspUčitel/ka: </b> <?= $kurzy[0]->ucitel_jmeno ?> &nbsp<?= $kurzy[0]->ucitel_prijmeni ?></label><br>
        <label> <b> &nbsp&nbspMísto: </b> <?= $kurzy[0]->misto ?></label><br>
        <label> <b> &nbsp&nbspCena: </b> <?= $kurzy[0]->cena ?></label><br>
        <?php
        foreach ($kurzy as $key) {
            $oKurzy = $key->idKurz;
            $oNazev = $key->nazev;
            $oUzavreni = $key->uzavreni;
        }
        $email = $this->session->userdata('email');
        $oStejnyKurz = "";
        if (!is_null($prihlaseny_kurz)) {
            foreach ($prihlaseny_kurz as $key) {
                $oStejnyKurz = $key->nazev;
            }
        }
        $casT = str_replace(" ", "T", "$oUzavreni");
        $uzavrit = strtotime($oUzavreni); //Converted to a PHP date (a second count)

        $dnes = date('Y-m-d H:i:s');
        $dnesni = strtotime($dnes); //Converted to a PHP date (a second count)
        ?>

        <label><b>&nbsp&nbspPřihlášení studenti:</b></label>

        <?php foreach ($prihlaseni as $jmeno) { ?>
            <td>&nbsp&nbsp<?= $jmeno->jmeno; ?>&nbsp<?= $jmeno->prijmeni; ?>,&nbsp</td>

        <?php } ?>


    </div>
    <div class="container">
        <?php
        if ($oUzavreni > $dnes) {

            $seconds = strtotime($casT) - strtotime($dnes);

            $days = floor($seconds / 86400);
            $seconds %= 86400;

            $hours = floor($seconds / 3600);
            $seconds %= 3600;

            $minutes = floor($seconds / 60);
            $seconds %= 60;

        ?>
            <label>&nbsp&nbspKurz se uzamkne za:</label>
        <?php
            if ($days > 0) {
                echo "&nbsp $days d";
            }
            if ($hours > 0) {
                echo "&nbsp$hours h";
            }
            if ($minutes > 0) {
                echo "&nbsp$minutes min";
            }
            if ($seconds > 0) {
                echo "&nbsp$seconds sec";
            }
        } else {
            echo "<label>&nbsp&nbspKurz uzamknutý</label>";
        }
        ?>
    </div>
    <?php

    if ($oFunkce == "student") {
        if ($oNazev !== $oStejnyKurz) {
            if ($oUzavreni > $dnes) {
                if ($prihlaseni_studenti < $kurzy[0]->pocet_mist) {
    ?>
                    <div class="container">
                        <form method="post">
                            <div>
                                <label for="terms_and_conditions">&nbsp&nbspSouhlasím s pokyny</label>
                                <input type="checkbox" id="terms_and_conditions" value="1" onclick="terms_changed(this)" />
                            </div>
                            <label>
                                <button type="button" class="btn btn-primary" id="submit_button" disabled onclick="window.location = '<?php echo site_url("Main/ZapisKurzu/" . $oKurzy); ?>'">Zapsat se</button>

                            </label>

                    </div>
    
                    </form>
    <?php  }
    else {
        echo "<div class='container'> <label style='color:red'>&nbsp&nbspV kurzu je již přihlášený maximální počet účastníků</label></div>";
    }
            }
        }
    }
    ?>


</body>

</html>