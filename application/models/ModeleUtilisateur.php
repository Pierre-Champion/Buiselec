<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 

    public function insererUnPersonnel($pDonneesAInserer)
     {
         return $this->db->insert('personnel', $pDonneesAInserer);
     } // insererUneCatégorie

}