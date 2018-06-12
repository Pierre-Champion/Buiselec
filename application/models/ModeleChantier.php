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
    public function RecupererUneCategorie($NoCategorie)
     {
        $requete = $this->db->get_where('categorie', array("nocategorie"=>$NoCategorie));
        return $requete->row_array();
     } // récupérerUneCatégorie
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

    public function RecupererLesChantiersDUnClient($NoClient)
     {
         return $this->db->get_where('chantier', array("NOCLIENT"=>$NoClient))->result_array();
     }
    public function RecupererUnChantier($NoChantier)
     {
         return $this->db->get_where('chantier', array("NOCHANTIER"=>$NoChantier))->row_array();
     }

}