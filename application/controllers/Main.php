<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Main extends CI_Controller {  

    public function index()  
    {  
        $this->login();  

    }  
  
    public function login()  
    {  
		$this->load->view('Login_view');  
		$this->load->view('templates/footer');                
     
    }  
   
    public function data()  
    {  
        if ($this->session->userdata('currently_logged_in'))   
        {  
            $this->prehledKurzu(); 
        } else {  
            redirect('Main/invalid');  
        }  
    } 
        public function NovyKurz()
    {  
        if ($this->session->userdata('currently_logged_in'))   
        {  
		$this->load->view('templates/header');
		$this->load->view('pages/NovyKurz');  
		$this->load->view('templates/footer');               

        } else {  
            redirect('Main/invalid');  
        }  
    } 
    
	public function save()
	{
        if ($this->session->userdata('currently_logged_in'))   
        {  
            $n=$this->input->post('pocet_mist');
            $e=$this->input->post('nazev');
            $p=$this->input->post('popis');

            $que=$this->db->query("select * from hlavni where nazev=?", [$e]);          
            $row = $que->num_rows();
            if($row)
            {               
                $data['error']="<h4>Tento název již existuje</h4>";
            }
            else
            {
                $que=$this->db->query("insert into hlavni (pocet_mist, nazev, popis) values(?, ?, ?)", [$n, $e, $p]);
                $data['error']="<h3>Úspěšně přidáno</h3>";
            }
            
                $this->load->view('templates/header', $data);
		$this->load->view('pages/NovyKurz', $data);
                $this->load->view('templates/footer');

        } else {  
            redirect('Main/invalid');  
        }              
		            }
        public function PrehledKurzu() 
        {
        if ($this->session->userdata('currently_logged_in'))   
        {  
                            $data['kurzy'] = $this->db->query('SELECT * FROM hlavni ORDER BY id_hlavni')->result();
		$this->load->view('templates/header', $data);
		$this->load->view('pages/PrehledKurzu', $data);  
		$this->load->view('templates/footer');                                                 
  
        } else {  
            redirect('Main/invalid');  
        }  
    }  
            
                
      
        public function Detailne_PrehledKurzu($id) 
        {
        if ($this->session->userdata('currently_logged_in'))   
        {  
            		$data['kurzy'] = $this->db->query('SELECT * FROM hlavni where id_hlavni ='.$id)->result();		
		$this->load->view('pages/Detailne_PrehledKurzu', $data);  
                $this->load->view('templates/header', $data);
		$this->load->view('templates/footer');                
  
        } else {  
            redirect('Main/invalid');  
        }  
    }  
            
   
    public function invalid()  
    {  
        $this->load->view('invalid');  
    }  

    public function login_action()  
    {  
        $this->load->helper('security');  
        $this->load->library('form_validation');  
  
        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');  
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');  
              

  
        if ($this->form_validation->run())   
        {  
            $data = array(  
                'username' => $this->input->post('username'),  
                'currently_logged_in' => 1  
                );    
                    $this->session->set_userdata($data);  
                redirect('Main/data');  
        }   
        else {  
            $this->load->view('login_view');  
        }  
    }  
  
    public function validation()  
    {  
        $this->load->model('login_model');  
  
        if ($this->login_model->log_in_correctly())  
        {  
  
            return true;  
        } else {  
            $this->form_validation->set_message('validation', 'Incorrect username/password.');  
            return false;  
        }  
    }  
  
    public function logout()  
    {  
        $this->session->sess_destroy();  
        redirect('Main/login');  
    }  
  
}  
