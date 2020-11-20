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

            <label> <b> &nbsp&nbspPopis: </b><?= $kurzy[0]->popis ?></label> <br>
            <label> <b> &nbsp&nbspPočet míst: </b> <?= $kurzy[0]->pocet_mist ?></label><br>
            <label> <b> &nbsp&nbspUčitel/ka: </b> <?= $kurzy[0]->ucitel_jmeno ?> &nbsp<?= $kurzy[0]->ucitel_prijmeni ?></label><br>

            <label>    
                <button type="submit" name="register" class="btn btn-primary">Zapsat se</button>

            </label>
        </div>








    </body>
</html>