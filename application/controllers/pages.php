<?php
class Pages extends CI_Controller {

        public function index()
        {            
		$this->load->view('templates/header');
		$this->load->view('pages/NovyKurz');  
		$this->load->view('templates/footer');
               
	}   
	public function save()
	{
		
            $n=$this->input->post('pocet_mist');
            $e=$this->input->post('nazev');
            $p=$this->input->post('popis');

            $que=$this->db->query("select * from hlavni where nazev=?", [$e]);          
            $row = $que->num_rows();
            if($row)
            {
                
                $data['error']="<h3>Tento název již existuje</h3>";
            }
            else
            {
                $que=$this->db->query("insert into hlavni (pocet_mist, nazev, popis) values(?, ?, ?)", [$n, $e, $p]);

                $data['error']="<h3>Úspěšně přidáno</h3>";
            }
            
                $this->load->view('templates/header');
		$this->load->view('pages/NovyKurz', $data);
                $this->load->view('templates/footer');
            }
            public function PrehledKurzu() 
                    {
                
                $data['kurzy'] = $this->db->query('SELECT * FROM hlavni ORDER BY id_hlavni')->result();
		$this->load->view('templates/header');
		$this->load->view('pages/PrehledKurzu', $data);  
		$this->load->view('templates/footer');
                 
                  


                
                    }



        
}