<!DOCTYPE html>
<html>

<head>
    <title>Úprava kurzu </title>
    <link href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css rel=stylesheet>
    <link href=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap4.min.css rel=stylesheet>

    <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }

        .sOrange {
            color: orange;

        }
    </style>
    <script>
        // https://datatables.net/examples/basic_init/filter_only.html
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "ordering": true,
                "info": false,
                "searching": true,
                "language": {
                    "search": "Vyhledat podle:",
                    "paginate": {
                        "first": "první",
                        "last": "poslední",
                        "next": "další",
                        "previous": "předchozí"
                    },

                }
            });
        });
    </script>
</head>

<body>
    <div><br>&nbsp</div>
    <div><br>&nbsp</div>


    <?php
    foreach ($kurz as $key) {
        $oNazev = $key->nazev;
        $oPopis = $key->popis;
        $oMisto = $key->misto;
        $oCena = $key->cena;
        $oUzavreni = $key->uzavreni;
    }

    $casT = str_replace(" ", "T", "$oUzavreni");
    $uzavrit = strtotime($oUzavreni); //Converted to a PHP date (a second count)

    $dnes = date('Y-m-d H:i:s');
    $dnesni = strtotime($dnes); //Converted to a PHP date (a second count)

    ;  ?>
    <div>&nbsp </div>


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
                        <input type="number" min="5" max="50" class="form-control" value="<?= $kurz[0]->pocet_mist ?>" readonly name="pocet_mist">
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
                        <input type="number" class="form-control" value="<?= $oCena ?>" name="cena">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Popis</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="popis"><?= $oPopis ?></textarea>
            </div>
            <div>&nbsp </div>
            <label>&nbsp&nbsp&nbspUzamknout v &nbsp</label><input type="datetime-local" id="uzavreni" name="uzavreni" value="<?= $casT ?>">
            <div>&nbsp </div>

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
                <label>&nbsp&nbsp&nbspKurz se uzamkne za:</label>
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
                echo "<label>&nbsp&nbsp&nbspKurz uzamknutý</label>";
            }
            ?>
            <div style="text-align: left">
                <button type="submit" name="register" class="btn btn-primary">Přepsat</button>
            </div>
        </form>

    </div>


    <div class="container">
        <table cellspacing=0 class="table table-bordered table-hover table-inverse" id=example width=100%>
            <thead>
                <tr>
                    <td> <b> Jméno </b> </td>
                    <td> <b> Přijmení </b> </td>
                    <td> <b> Kurz </b> </td>
                    <td></td>
                </tr>
            </thead>
            <?php foreach ($studenti as $student) { ?>
                <tr>
                    <td><?= $student->jmeno; ?></td>
                    <td><?= $student->prijmeni; ?></td>
                    <td><?= $student->nazev; ?></td>
                    <td> 
                    <?php if ($oNazev != $student->nazev) {?>
                    <a style="color: blue;" class="modra" href="<?php echo base_url('main/pridatStudenta/'.$student->idUzivatel) ?>">Přidat do svého kurzu
                    <?php } 
                       else { echo "Student je v kurzu"; } ?>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
    </div>


</body>

</html>