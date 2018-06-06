<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 
    public function RecupererLesClients()
     {
        return $this->db->get('Client');
     } // récupérerLesClients
    public function InsererUnPersonnel($pDonneesAInserer)
     {
         return $this->db->insert('personnel', $pDonneesAInserer);
     } // insererUneCatégorie

     public function InsererUnClient($pDonneesAInserer)
     {
         return $this->db->insert('client', $pDonneesAInserer);
     } // insererUneCatégorie

}