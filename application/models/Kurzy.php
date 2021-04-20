<?php

class Kurzy extends CI_Model
{

        public function get_kurzy()
        {
                $this->db->select('idKurz, nazev, pocet_mist, cena, misto, uzavreni, popis, uzivatel.prijmeni as ucitel_prijmeni, uzivatel.jmeno as ucitel_jmeno');
                $this->db->from('kurz');
                $this->db->where('funkce', 'ucitel');
                $this->db->join('uzivatel', 'kurz_idKurz = idKurz');
                $query = $this->db->get();
                return $query->result();
        }

        public function get_kurz($id)
        {
                $this->db->select('idKurz, nazev, pocet_mist, cena, misto, uzavreni, popis, uzivatel.prijmeni as ucitel_prijmeni, uzivatel.jmeno as ucitel_jmeno');
                $this->db->where('idKurz', $id);
                $this->db->from('kurz');
                $this->db->join('uzivatel', 'kurz_idKurz = idKurz');
                $query = $this->db->get();
                return $query->result();
        }

        public function prihlaseny_kurz($email)
        {
                $this->db->select('nazev');
                $this->db->where('email', $email);
                $this->db->where('funkce', 'student');
                $this->db->from('kurz');
                $this->db->join('uzivatel', 'kurz_idKurz = idKurz');
                $query = $this->db->get();
                return $query->result();
        }

        public function prihlaseni_studenti_kurz($id)
        {
                $this->db->select('uzivatel.jmeno, uzivatel.prijmeni');
                $this->db->where('idKurz', $id);
                $this->db->where('funkce', 'student');
                $this->db->from('kurz');
                $this->db->join('uzivatel', 'kurz_idKurz = idKurz');
                $query = $this->db->get();
                return $query->result();
        }

        public function insert_entry($email)
        {
                $n = $_POST['pocet_mist'];
                $e = $_POST['nazev'];
                $p = $_POST['popis'];
                $m = $_POST['misto'];
                $c = $_POST['cena'];
                $d = $this->input->post('uzavreni');
                $uzavreni = str_replace("T", " ", "$d");

                $this->db->query("insert into kurz (pocet_mist, nazev, popis, misto, cena, uzavreni) values(?, ?, ?,?,?,?)", [$n, $e, $p, $m, $c, $uzavreni]);
                $this->db->query('UPDATE uzivatel SET kurz_idKurz = (select idKurz from kurz where nazev = "' . $e . '") WHERE email = "' . $email . '"');
        }
        public function existujici_kurz()
        {

                $e = $_POST['nazev'];
                $existujici = $this->db->query('select nazev from kurz where nazev="' . $e . '"')->result();
                if ($existujici) {
                        return true;
                } else {
                        return false;
                }
        }

        public function update_entry($email)
        {
                $e = $_POST['nazev'];
                $p = $_POST['popis'];
                $m = $_POST['misto'];
                $c = $_POST['cena'];
                $d = $_POST['uzavreni'];
                $uzavreni = str_replace("T", " ", "$d");

                $this->db->query("UPDATE kurz INNER JOIN uzivatel u ON idKurz= u.kurz_idKurz SET nazev='" . $e . "', popis='" . $p . "', misto='" . $m . "', cena='" . $c . "', uzavreni='" . $uzavreni . "' where u.funkce= 'ucitel' and u.email=?", $email);
        }

        public function zapis_do_kurzu($email, $id)
        {

                $this->db->query("UPDATE uzivatel SET kurz_idKurz='" . $id . "' where email='" . $email . "'");
        }
        public function ucitel_kurz($email)
        {

                $this->db->select('nazev, pocet_mist, cena, misto, uzavreni, popis');
                $this->db->from('kurz');
                $this->db->where('funkce', 'ucitel');
                $this->db->where('email', $email);
                $this->db->join('uzivatel', 'kurz_idKurz = idKurz');
                $query = $this->db->get();
                return $query->result();
  
       }
        public function existujici_ucitel_kurz($email) {
                $ucitel = $this->db->query('SELECT * FROM kurz INNER JOIN uzivatel ON kurz_idKurz = idKurz where uzivatel.funkce = "ucitel" and uzivatel.email="' . $email . '"')->result();
                if ($ucitel) {
                        return true;
                }



        }
}
