<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->login();
    }

    public function login() {
        $this->load->view('Login_view');
        $this->load->view('templates/Footer');
    }

    public function data() {
        if ($this->session->userdata('currently_logged_in')) {
            $this->prehledKurzu();
        } else {
            redirect('Main/Invalid');
        }
    }

    public function NovyKurz() {
        if ($this->session->userdata('currently_logged_in')) {


            $email = $this->session->userdata('email');
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $funkce = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
            $oFunkce = array();
            foreach ($funkce as $row) {
                $oFunkce[] = $row->funkce;
            }
            $vytvorenyKurz = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $this->load->view('templates/Header', $data);

            if (!$vytvorenyKurz) {
                if ($oFunkce[0] == "ucitel") {
                    
                    $this->load->view('pages/NovyKurz', $data);
                    $this->load->view('templates/Footer');
                }
            }
        } else {
            redirect('Main/Invalid');
        }
    }

    public function save() {
        if ($this->session->userdata('currently_logged_in')) {


            $v = $this->session->userdata('email');
            $prijmeni = $this->db->query('select prijmeni from prihlasovani where email ="' . $v . '"')->result();

            $jmeno = $this->db->query('select jmeno from prihlasovani where email ="' . $v . '"')->result();
            $email = $this->session->userdata('email');


            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
            $data['nazev'] = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['popis'] = $this->db->query('SELECT popis FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['pocet'] = $this->db->query('SELECT pocet_mist FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['misto'] = $this->db->query('SELECT misto FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['cena'] = $this->db->query('SELECT cena FROM hlavni where ucitel_email="' . $email . '"')->result();

            $vytvorenyKurz = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni ORDER BY id_hlavni')->result();





            $oJmeno = array();
            foreach ($jmeno as $row) {
                $oJmeno[] = $row->jmeno;
            }

            $oPrijmeni = array();
            foreach ($prijmeni as $row) {
                $oPrijmeni[] = $row->prijmeni;
            }


            $n = $this->input->post('pocet_mist');
            $e = $this->input->post('nazev');
            $p = $this->input->post('popis');
            $m = $this->input->post('misto');
            $c = $this->input->post('cena');



            $kurz = $this->db->query("select * from hlavni where ucitel_email=?", [$v]);
            $omezeni = $kurz->num_rows();
            $this->load->view('templates/header', $data);
            if (!$vytvorenyKurz) {


                if ($omezeni >= 1) {
                    
                } else {
                    $this->db->query("insert into hlavni (pocet_mist, nazev, popis,ucitel_jmeno, ucitel_prijmeni, ucitel_email, misto, cena, uzamknuto) values(?, ?, ?,?,?,?,?,?,?)", [$n, $e, $p, $oJmeno[0], $oPrijmeni[0], $v, $m, $c,'0']);
                    $data['error'] = "<h3>Úspěšně přidáno</h3>";
                }

                $this->prehledKurzu();
            }
        } else {
            redirect('Main/invalid');
        }
    }

    public function PrehledKurzu() {
        if ($this->session->userdata('currently_logged_in')) {

            $email = $this->session->userdata('email');
            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni ORDER BY id_hlavni')->result();
            $data['uzamknuto'] = $this->db->query('SELECT uzamknuto FROM hlavni where ucitel_email="' . $email . '"')->result();

            
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $this->load->view('templates/Header', $data);
            $this->load->view('pages/PrehledKurzu', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function Detailne_PrehledKurzu($id) {
        if ($this->session->userdata('currently_logged_in')) {
            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni where id_hlavni =' . $id)->result();
            $email = $this->session->userdata('email');

            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
            $data['stejnyKurz'] = $this->db->query('SELECT kurz FROM prihlasovani where email="' . $email . '"')->result();
            $stejnyKurz = $this->db->query('SELECT nazev FROM hlavni where id_hlavni =' . $id)->result();

            
            $oStejnyKurz = array();
            foreach ($stejnyKurz as $row) {
                $oStejnyKurz[] = $row->nazev;
            }

            $data['jmena'] = $this->db->query('SELECT jmeno, prijmeni FROM prihlasovani where kurz="' . $oStejnyKurz[0] . '"')->result();
            $this->load->view('pages/Detailne_PrehledKurzu', $data);
            $this->load->view('templates/Header', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function ZapisDat($id) {
        if ($this->session->userdata('currently_logged_in')) {
            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni where id_hlavni =' . $id)->result();
            $email = $this->session->userdata('email');
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
            $data['stejnyKurz'] = $this->db->query('SELECT kurz FROM prihlasovani where email="' . $email . '"')->result();
            $stejnyKurz = $this->db->query('SELECT kurz FROM prihlasovani where email="' . $email . '"')->result();

            $oStejnyKurz = array();
            foreach ($stejnyKurz as $row) {
                $oStejnyKurz[] = $row->kurz;
            }
        $funkce = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();
        foreach ($funkce as $key) {
            $oFunkce = $key->funkce;
        }
            
            if ($oFunkce=="student"){
            $data['jmena'] = $this->db->query('SELECT jmeno, prijmeni FROM prihlasovani where kurz="' . $oStejnyKurz[0] . '"')->result();
            $kurzy = $this->db->query('SELECT nazev FROM hlavni where id_hlavni =' . $id)->result();

            }
            $oKurzy = array();
            foreach ($kurzy as $row) {
                $oKurzy[] = $row->nazev;
            }



            $this->db->query("UPDATE prihlasovani SET kurz='" . $oKurzy[0] . "' where email='" . $email . "'");



            $this->load->view('pages/Detailne_PrehledKurzu', $data);
            $this->load->view('templates/Header', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function UcitelKurz() {
        if ($this->session->userdata('currently_logged_in')) {

            $email = $this->session->userdata('email');
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $data['nazev'] = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['popis'] = $this->db->query('SELECT popis FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['pocet'] = $this->db->query('SELECT pocet_mist FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['misto'] = $this->db->query('SELECT misto FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['cena'] = $this->db->query('SELECT cena FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['uzamknuto'] = $this->db->query('SELECT uzamknuto FROM hlavni where ucitel_email="' . $email . '"')->result();

            $funkce = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $this->load->view('templates/Header', $data);
            if ($funkce) {
                $this->load->view('pages/UcitelKurz', $data);
                $this->load->view('templates/Footer');
            }
        } else {
            redirect('Main/Invalid');
        }
    }

    public function zmena() {
        if ($this->session->userdata('currently_logged_in')) {
            $email = $this->session->userdata('email');


            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $data['nazev'] = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $nazev = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['popis'] = $this->db->query('SELECT popis FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['pocet'] = $this->db->query('SELECT pocet_mist FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['misto'] = $this->db->query('SELECT misto FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['cena'] = $this->db->query('SELECT cena FROM hlavni where ucitel_email="' . $email . '"')->result();

            $e = $this->input->post('nazev');
            $p = $this->input->post('popis');
            $m = $this->input->post('misto');
            $c = $this->input->post('cena');


            $oNazev = array();
            foreach ($nazev as $row) {
                $oNazev[] = $row->nazev;
            }


            $this->db->query("UPDATE hlavni SET nazev='" . $e . "', popis='" . $p . "', misto='" . $m . "', cena='" . $c . "' where ucitel_email=?", $email);
            $this->db->query("UPDATE prihlasovani SET kurz='" . $e . "' where kurz='".$oNazev[0]."'");
            $data['error'] = "<h3>Úspěšně upraveno</h3>";


            $this->load->view('templates/Header', $data);
            $this->load->view('pages/UcitelKurz', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function uzamknout() {
        if ($this->session->userdata('currently_logged_in')) {
            /* header */$email = $this->session->userdata('email');

             /* header */$data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
             /* header */$data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

             $uzamknuto = $this->db->query('SELECT uzamknuto FROM hlavni where ucitel_email="' . $email . '"')->result();

             $oUzamknuto = array();
             foreach ($uzamknuto as $row) {
                 $oUzamknuto[] = $row->uzamknuto;
             }

             if ($oUzamknuto[0]=="1"){

                $this->db->query("UPDATE hlavni SET uzamknuto='0' where ucitel_email=?", $email);
             }

             if ($oUzamknuto[0]=="0"){
               $this->db->query("UPDATE hlavni SET uzamknuto='1' where ucitel_email=?", $email);
            }

            $this->load->view('templates/Header', $data);
            $this->load->view('templates/UcitelKurz', $data);
            $this->load->view('templates/Footer');
 
    } else {
        redirect('Main/Invalid');
    }

    }


    public function invalid() {
        $this->load->view('Invalid');
    }

    public function login_action() {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');



        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'currently_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('Main/data');
        } else {
            $this->load->view('Login_view');
        }
    }

    public function validation() {
        $this->load->model('login_model');

        if ($this->login_model->log_in_correctly()) {

            return true;
        } else {
            $this->form_validation->set_message('validation', 'Špatně zadaný email/heslo.');
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Main/Login');
    }

}
