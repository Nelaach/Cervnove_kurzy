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
                </tr>                   

                <?php foreach ($kurzy as $kurz) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url('main/Detailne_PrehledKurzu/' . $kurz->id_hlavni) ?>">
                            <?= $kurz->nazev; ?></td>
                        <td><?= $kurz->pocet_mist; ?></td>
                        <td><?= $kurz->ucitel_jmeno; ?>&nbsp<?= $kurz->ucitel_prijmeni; ?></td> 

                        </a>
                    </tr>
                <?php } ?>

            </table>
        </div> 
        <?php
        $v = $this->session->userdata('email');
        $data['jmeno'] = $this->db->query('select jmeno from prihlasovani where email ="' . $v . '"')->result();
        $prijmeni = $this->db->query('select prijmeni from prihlasovani where email ="' . $v . '"')->result();
        ?>
    </body>
</html>
