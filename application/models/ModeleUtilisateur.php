<?php
class ModeleUtilisateur extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 

    public function RecupererLesClients()
     {
        return $this->db->get('CLIENT')->result_array();
     } // récupérerLesClients

     public function RecupererLePersonnel()
     {
        return $this->db->get('PERSONNEL')->result_array();
     } // récupérerLePersonnel

    public function RecupererUnClient($DonneesClient)
     {
        if(is_array($DonneesClient))
        {
            return $this->db->get_where('CLIENT', $DonneesClient)->row_array();
        }
        else
        {
            return $this->db->get_where('CLIENT', array("NOCLIENT"=>$DonneesClient))->row_array();
        }
     } // récupérerLesClients

    public function InsererUnPersonnel($pDonneesAInserer)
     {
         return $this->db->insert('PERSONNEL', $pDonneesAInserer);
     } // insererUnPersonnel

    public function RecupererUnPersonnel($pDonneesPersonnel)
     {
        if(is_array($pDonneesPersonnel))
        {
            return $this->db->get_where('PERSONNEL', $pDonneesPersonnel)->row_array();
        }
        else
        {
            return $this->db->get_where('PERSONNEL', array("NOPERSONNEL"=>$pDonneesPersonnel))->row_array();
        }
     } // recupererUnPersonnel

     public function InsererUnClient($pDonneesAInserer)
     {
         return $this->db->insert('CLIENT', $pDonneesAInserer);
     } // insererUneCatégorie

     public function ModifierUnCLient($pDonneesAInserer, $id)
     {
        $this->db->where('NOCLIENT', $id);
        return $this->db->update('CLIENT', $pDonneesAInserer);
     } // modifierUnClient

     public function ModifierUnPersonnel($pDonneesAInserer, $id)
     {
        $this->db->where('NOPERSONNEL', $id);
        return $this->db->update('PERSONNEL', $pDonneesAInserer);
     } // modifierUnClient



}