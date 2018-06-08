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

     public function RecupererLesChantiers()
     {
        $requete = $this->db->get('chantier');
        return $requete->result_array();
     } // récupérerLesCatégories

     public function ModifierUnChantier($pDonneesAInserer, $id)
     {
        $this->db->where('NOCHANTIER', $id);
        return $this->db->update('chantier', $pDonneesAInserer);
     } // modifierUnChantier

     public function InsererUnChantier($pDonneesAInserer)
     {
         return $this->db->insert('chantier', $pDonneesAInserer);
     } // insererUnChantier

}