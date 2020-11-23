<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->login();
    }

    public function login() {
        $this->load->view('Login_view');
        $this->load->view('templates/footer');
    }

    public function data() {
        if ($this->session->userdata('currently_logged_in')) {
            $this->prehledKurzu();
        } else {
            redirect('Main/invalid');
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
            $this->load->view('templates/header', $data);

            if (!$vytvorenyKurz) {
                if ($oFunkce[0] == "ucitel") {

                    $this->load->view('pages/NovyKurz', $data);
                    $this->load->view('templates/footer');
                }
            }
        } else {
            redirect('Main/invalid');
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




            $kurz = $this->db->query("select * from hlavni where ucitel_email=?", [$v]);
            $omezeni = $kurz->num_rows();
            $this->load->view('templates/header', $data);
            if (!$vytvorenyKurz) {


                if ($omezeni >= 1) {
                    
                } else {
                    $this->db->query("insert into hlavni (pocet_mist, nazev, popis,ucitel_jmeno, ucitel_prijmeni, ucitel_email) values(?, ?, ?,?,?,?)", [$n, $e, $p, $oJmeno[0], $oPrijmeni[0], $v]);
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


            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni ORDER BY id_hlavni')->result();

            $email = $this->session->userdata('email');
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $this->load->view('templates/header', $data);
            $this->load->view('pages/PrehledKurzu', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Main/invalid');
        }
    }

    public function Detailne_PrehledKurzu($id) {
        if ($this->session->userdata('currently_logged_in')) {
            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni where id_hlavni =' . $id)->result();

            $email = $this->session->userdata('email');
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();



            $this->load->view('pages/Detailne_PrehledKurzu', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Main/invalid');
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

            $funkce = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $this->load->view('templates/header', $data);
            if ($funkce) {
                $this->load->view('pages/UcitelKurz', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect('Main/invalid');
        }
    }

    public function zmena() {
        if ($this->session->userdata('currently_logged_in')) {
            $email = $this->session->userdata('email');


            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result();

            $data['nazev'] = $this->db->query('SELECT nazev FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['popis'] = $this->db->query('SELECT popis FROM hlavni where ucitel_email="' . $email . '"')->result();
            $data['pocet'] = $this->db->query('SELECT pocet_mist FROM hlavni where ucitel_email="' . $email . '"')->result();

            $e = $this->input->post('nazev');
            $p = $this->input->post('popis');



            $this->db->query("UPDATE hlavni SET nazev='" . $e . "',popis='" . $p . "' where ucitel_email=?", $email);
            $data['error'] = "<h3>Úspěšně upraveno</h3>";


            $this->load->view('templates/header', $data);
            $this->load->view('pages/UcitelKurz', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('Main/invalid');
        }
    }

    public function invalid() {
        $this->load->view('invalid');
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
            $this->load->view('login_view');
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
        redirect('Main/login');
    }

}
