<!DOCTYPE html>
<html>
    <head>
        <title>Kurzy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
        <table class="table">

                    <div><br>&nbsp</div>
                    <div><br>&nbsp</div>
        <tr>
            <td>  <b> Název kurzu </b> </td>
        <td>  <b> Počet míst </b> </td>
        </tr>                   

    <?php foreach ($kurzy as $kurz) { ?>
        <tr>
            <td><?= $kurz->nazev; ?></td>
            <td><?= $kurz->pocet_mist; ?></td>
        </tr>
    <?php } ?>
        </table>
        <br>
        </div>       
    </body>
</html>