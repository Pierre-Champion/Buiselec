<?php
class Administrateur extends CI_Controller 
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->library("pagination");
      $this->load->model('ModeleUtilisateur');
       $this->load->model('ModeleChantier');
    } // __construct

    public function ajouterUneCategorie()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesInjectees['TitreDeLaPage'] = 'Ajouter une catégorie';
      $this->form_validation->set_rules('NomCategorie', 'Categorie', 'required');
      if ($this->form_validation->run() === FALSE)
      {   // formulaire non validé, on renvoie le formulaire
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUneCategorie', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
      else
      {
        $donneesAInserer = array(
        'NOM' => $this->input->post('NomCategorie'),
        ); // NOMARQUE, NOM : champs de la table tabarticle
        $this->ModeleChantier->InsererUneCategorie($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
    } // ajouterUneCatégorie

    public function AjouterPersonnel()
    {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un personnel';
    If ($this->input->post('boutonAjouterPersonnel'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomPersonnel'),
          'PRENOM' => $this->input->post('PrenomPersonnel'),
          'MAIL' => $this->input->post('MailPersonnel'),
          'MDP' => $this->input->post('MdpPersonnel'),
          'TELEPHONE' => $this->input->post('TelPersonnel'),
          'STATUT' => $this->input->post('StatutPersonnel'),
        );
        $this->ModeleUtilisateur->InsererUnPersonnel($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterPersonnel', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnPersonnel

    public function AjouterUnClient()
    {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter Un client';
    If ($this->input->post('boutonAjouterClient'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomClient'),
          'PRENOM' => $this->input->post('PrenomClient'),
          'MAIL' => $this->input->post('MailClient'),
          'TELEPHONE' => $this->input->post('TelClient'),
          'ADRESSE' => $this->input->post('AdresseClient'),
          'CP' => $this->input->post('CPClient'),
          'VILLE' => $this->input->post('VilleClient'),
          'MDP' => $this->input->post('MdpClient'),
          'STATUT' => '1',
        );
        $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUnClient', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnPersonnel

    public function AjouterUnChantier()
    {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter Un Chantier';
    If ($this->input->post('boutonAjouterChantier'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomClient'),
          
        );
        $this->ModeleUtilisateur->InsererUnChantier($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
      else
      {
        $DonneesInjectees['Categories']=$this->ModeleChantier->RecupererLesCategories();
        $DonneesInjectees['Pieces']=array
        (
          "Salon" => "Salon",
          "Salle à manger" => "Salle à manger",
          "Cuisine" => "Cuisine",
          "Salle de bain" => "Salle de bain",
          "Extérieur" => "Extérieur",
          "Cave / Garage / Grenier" => "Cave / Garage / Grenier",
          "Chambre" => "Chambre"
        );
        $DonneesInjectees['Categories']=$this->ModeleUtilisateur->RecupererLesClients();
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUnChantier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnChantier
}