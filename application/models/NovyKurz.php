<?php

            $data['ucitel'] = $this->db->query('SELECT funkce FROM prihlasovani where email="' . $email . '"')->result()=$ucitel;
            $data['shoda'] = $this->db->query('SELECT * FROM hlavni where ucitel_email="' . $email . '"')->result()=$shoda;

