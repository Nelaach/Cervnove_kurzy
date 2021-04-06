<html>

<head>
    <title>Detailnější přehled kurzů</title>

</head>
<script>
//JavaScript function that enables or disables a submit button depending
//on whether a checkbox has been ticked or not.
function terms_changed(termsCheckBox){
    //If the checkbox has been checked
    if(termsCheckBox.checked){
        //Set the disabled property to FALSE and enable the button.
        document.getElementById("submit_button").disabled = false;
    } else{
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
        <label> <b> &nbsp&nbspMísto: </b> <?= $kurzy[0]->misto ?></label><br>
        <label> <b> &nbsp&nbspCena: </b> <?= $kurzy[0]->cena ?></label><br>
        <?php
        foreach ($kurzy as $key) {
            $oKurzy = $key->id_hlavni;
            $oNazev = $key->nazev;
            $oUzamknuto = $key->uzamknuto;
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
            if ($oUzamknuto == "0") {
    ?>


            <div class="container">
            <form method="post">
    <div>
        <label for="terms_and_conditions">&nbsp&nbspSouhlasím s pokyny</label>
        <input type="checkbox" id="terms_and_conditions" value="1" onclick="terms_changed(this)" />
    </div>
                <label>
                    <button type="button" class="btn btn-primary" id="submit_button" disabled onclick="window.location = '<?php echo site_url("Main/ZapisDat/" . $oKurzy); ?>'">Zapsat se</button>

                </label>

            </div>
            </form>
    <?php  }else{
?>
        <div class="container">
            <h5> <b>Uzamknuto - nelze se přihlásit </b> </h5>
        </div>
 
<?php
    }}
    } ?>


</body>

</html>