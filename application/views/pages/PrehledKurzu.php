<html>

<head>
    <title>Přehled kurzů</title>
    <script src="https://kit.fontawesome.com/d089b36c07.js" crossorigin="anonymous"></script>
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
                "paging": false,
                "ordering": true,
                "info": false,
                "searching": true,
                "language": {
                    "search": "Vyhledat podle:"

                }
            });
        });
    </script>
</head>

<body>
    <?php foreach ($funkce as $key) {
        $oFunkce = $key->funkce;
    }
    ?>

    <?php $dnes = date('Y-m-d H:i:s'); ?>
    <div class="container">
        <div><br>&nbsp</div>
        <div><br>&nbsp</div>

        <div class="container">
            <b>Uzamknuto -</b> <i class="fas fa-lock"></i>
            <table cellspacing=0 class="table table-bordered table-hover table-inverse" id=example width=100%>
                <thead>
                    <tr>
                        <td> <b> Název kurzu </b> </td>
                        <td> <b> Počet míst </b> </td>
                        <td> <b> Učitel/ka </b> </td>
                        <td> <b> Místo </b> </td>
                        <td> <b> Cena </b> </td>
                        <?php if ($funkce = "admin") {
                            echo "<td> <b> Smazat </b> </td>";
                        } 
                        ?>
                    </tr>
                </thead>
                <?php foreach ($kurzy as $kurz) { ?>
                    <tr>
                        <td>
                            <a style="color: blue;" class="modra" href="<?php echo base_url('main/Detailne_PrehledKurzu/' . $kurz->idKurz) ?>">
                                <?= $kurz->nazev; ?><?php if ($kurz->uzavreni < $dnes) { ?>&nbsp<i class="fas fa-lock"></i><?php } ?>
                        </td>
                        <td><?= $kurz->pocet_mist; ?></td>
                        <td><?= $kurz->ucitel_jmeno; ?>&nbsp<?= $kurz->ucitel_prijmeni; ?></td>
                        <td><?= $kurz->misto; ?></td>
                        <td><?= $kurz->cena; ?></td>
                        <?php if ($funkce = "admin") { ?>
                           <td> 
                           <a style="color: red;" href="<?php echo base_url('main/smazatKurz/' . $kurz->idKurz) ?>">
                           <i class="fas fa-times"></i> </td>
                        <?php } ?>
                        
                    </tr>
                <?php } ?>

            </table>
            <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
            <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
            <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
        </div>

</body>

</html>