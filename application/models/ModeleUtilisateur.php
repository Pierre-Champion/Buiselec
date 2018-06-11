<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 
    public function RecupererLesClients()
     {
        return $this->db->get('Client')->result_array();
     } // récupérerLesClients
     public function RecupererLePersonnel()
     {
        return $this->db->get('personnel')->result_array();
     } // récupérerLePersonnel
    public function RecupererUnClient($DonneesClient)
     {
        if(is_array($DonneesClient))
        {
            return $this->db->get_where('Client', $DonneesClient)->row_array();
        }
        else
        {
            return $this->db->get_where('Client', array("NOCLIENT"=>$DonneesClient))->row_array();
        }
     } // récupérerLesClients

    public function InsererUnPersonnel($pDonneesAInserer)
     {
         return $this->db->insert('personnel', $pDonneesAInserer);
     } // insererUnPersonnel
    public function RecupererUnPersonnel($pDonneesPersonnel)
     {
         return $this->db->get_where('personnel', $pDonneesPersonnel)->row_array();
     } // recupererUnPersonnel
     public function InsererUnClient($pDonneesAInserer)
     {
         return $this->db->insert('client', $pDonneesAInserer);
     } // insererUneCatégorie

}