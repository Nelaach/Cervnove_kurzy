<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kurzy');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $this->load->view('Login_view');
        $this->load->view('templates/Footer');
    }

    public function data()
    {
        if ($this->session->userdata('currently_logged_in')) {
            $this->prehledKurzu();
        } else {
            redirect('Main/Invalid');
        }
    }

    public function NovyKurz()
    {
        if ($this->session->userdata('currently_logged_in')) {

            $this->load->view('templates/Header');
            $this->load->view('pages/NovyKurz');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function save()
    {
        if ($this->session->userdata('currently_logged_in')) {

            $email = $this->session->userdata('email');

            $this->load->view('templates/header');

            if ($this->kurzy->existujici_kurz() == false) {
                $this->kurzy->insert_entry($email);
                $data['error'] = "<h3>Úspěšně přidáno</h3>";
                $this->prehledKurzu();
            } else {
?>
                <style>
                    .center {
                        text-align: center;
                        padding-top: 60px;
                    }
                </style>

<?php
                $this->novyKurz();
                echo '<h3 class="center">Tento název již existuje, vyberte si, prosím, jiný.</h3>';
            }
        } else {
            redirect('Main/invalid');
        }
    }

    public function PrehledKurzu()
    {
        if ($this->session->userdata('currently_logged_in')) {

            $data['kurzy'] = $this->kurzy->get_kurzy();

            $this->load->view('templates/Header');
            $this->load->view('pages/PrehledKurzu', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function Detailne_PrehledKurzu($id)
    {
        if ($this->session->userdata('currently_logged_in')) {
            $email = $this->session->userdata('email');

            $data['kurzy'] = $this->kurzy->get_kurz($id);
            $data['prihlaseny_kurz'] = $this->kurzy->prihlaseny_kurz($email);
            $data['prihlaseni'] = $this->kurzy->prihlaseni_studenti_kurz($id);

            $this->load->view('templates/Header');
            $this->load->view('pages/Detailne_PrehledKurzu', $data);
            $this->load->view('templates/Footer');
        } else {
            redirect('Main/Invalid');
        }
    }

    public function ZapisKurzu($id)
    {
        if ($this->session->userdata('currently_logged_in')) {
            $email = $this->session->userdata('email');
            $data['prihlaseni'] = $this->kurzy->zapis_do_kurzu($email, $id);

            $this->Detailne_PrehledKurzu($id);
        } else {
            redirect('Main/Invalid');
        }
    }

    public function UcitelKurz()
    {
        if ($this->session->userdata('currently_logged_in')) {

            $email = $this->session->userdata('email');
            $this->load->view('templates/Header');

            if ($this->kurzy->existujici_ucitel_kurz($email) == true) {
                $data['kurz'] = $this->kurzy->ucitel_kurz($email);

                $this->load->view('pages/UcitelKurz', $data);
                $this->load->view('templates/Footer');
            }
        } else {
            redirect('Main/Invalid');
        }
    }

    public function zmena()
    {
        if ($this->session->userdata('currently_logged_in')) {
            $email = $this->session->userdata('email');

            $this->kurzy->update_entry($email);
            $data['error'] = "<h3>Úspěšně upraveno</h3>";


            $this->ucitelKurz();
        } else {
            redirect('Main/Invalid');
        }
    }


    public function invalid()
    {
        $this->load->view('Invalid');
    }

    public function login_action()
    {
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

    public function validation()
    {
        $this->load->model('login_model');

        if ($this->login_model->log_in_correctly()) {

            return true;
        } else {
            $this->form_validation->set_message('validation', 'Špatně zadaný email/heslo.');
            return false;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Main/Login');
    }
}
