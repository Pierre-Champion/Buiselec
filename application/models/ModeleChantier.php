<?php
class ModeleChantier extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 

    public function InsererUneCategorie($pDonneesAInserer)
     {
         return $this->db->insert('categorie', $pDonneesAInserer);
     } // insererUneCatégorie

    public function RecupererLesCategories()
     {
        $requete = $this->db->get('categorie');
        return $requete->result_array();
     } // récupérerLesCatégories

}