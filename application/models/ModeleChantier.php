<?php
class ModeleChantier extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    } // __construct 

    public function InsererUneCategorie($pDonneesAInserer)
     {
         return $this->db->insert('CATEGORIE', $pDonneesAInserer);
     } // insererUneCatégorie

    public function RecupererLesCategories()
     {
        $requete = $this->db->get('CATEGORIE');
        return $requete->result_array();
     } // récupérerLesCatégories
     
    public function RecupererUneCategorie($NoCategorie)
     {
        $requete = $this->db->get_where('CATEGORIE', array("NOCATEGORIE"=>$NoCategorie));
        return $requete->row_array();
     } // récupérerUneCatégorie
    public function RecupererLesChantiers()
     {
        
        $requete = "select * from CHANTIER where STATUT='Attente'
        Union select * from CHANTIER where STATUT='Devis'
        Union select * from CHANTIER where STATUT='Confirmé'
        Union select * from CHANTIER where STATUT='Commencé'
        Union select * from CHANTIER where STATUT='Terminé'
        Union select * from CHANTIER where STATUT='Annulé'";
        $requete=$this->db->query($requete);
        return $requete->result_array();
     } // récupérerLesCatégories

    public function GetChantiersPublics()
     {
        $this->db->order_by("NOCHANTIER", "desc");
        $query = $this->db->get_where("CHANTIER", array("ACCORD"=>"1")); 
        return $query->result_array();
     }
    public function RecupererLesChantiersDUnPersonnel($NoPersonnel)
     {
        $requete = "Select c.NOCHANTIER, NOM, STATUT, HORAIRE from CHANTIER c, PARTICIPE p where p.NOCHANTIER=c.NOCHANTIER and NOPERSONNEL = ".$NoPersonnel." order by c.NOCHANTIER desc";
        $query=$this->db->query($requete);
        return $query->result_array();
     }
    public function RecupererLesChantiersPasAssignesAPersonnel($NoPersonnel)
     {
        $requete = "Select * from CHANTIER where NOCHANTIER not in (select NOCHANTIER from PARTICIPE where NOPERSONNEL=$NoPersonnel) order by NOCHANTIER desc";
        $query=$this->db->query($requete);
        return $query->result_array();
     }
    public function ModifierUnChantier($pDonneesAInserer, $id)
     {
        $this->db->where('NOCHANTIER', $id);
        return $this->db->update('CHANTIER', $pDonneesAInserer);
     } // modifierUnChantier

    public function InsererUnChantier($pDonneesAInserer)
     {
         return $this->db->insert('CHANTIER', $pDonneesAInserer);
     } // insererUnChantier

    public function RecupererLesChantiersDUnClient($NoClient)
     {
         return $this->db->get_where('CHANTIER', array("NOCLIENT"=>$NoClient))->result_array();
     }
     /*public function RecupererLesChantiersDUnPersonnel($NoPersonnel)
     {
         return $this->db->get_where('PARTICIPE', array("NOPERSONNEL"=>$NoPersonnel))->result_array();
     }*/

    public function RecupererUnChantier($NoChantier)
     {
         return $this->db->get_where('CHANTIER', array("NOCHANTIER"=>$NoChantier))->row_array();
     }
     public function RechercherUnChantier($pLibelle = False)
     {
        $this->db->like('NOM', $pLibelle, 'both');
        $this->db->or_like('STATUT', $pLibelle, 'after');
        $requete = $this->db->get('CHANTIER');
        return $requete->result_array(); // retour d'un tableau associatif
     } //RechercherUnProduit

}