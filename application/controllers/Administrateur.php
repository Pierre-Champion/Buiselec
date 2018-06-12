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
       if (!isset($this->session->Profil) || $this->session->Profil != 1 && $this->session->Profil != 2)
       {
         redirect("/Visiteur/Home");
       }
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
    public function Home()
    {
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/home');
    }
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
        redirect('Administrateur/Personnel');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterPersonnel', $DonneesInjectees);
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
          'STATUT' => $this->input->post('StatutClient'),
        );
        $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
        redirect("Administrateur/Clients");
      }
      else
      {
        $DonneesInjectees['Statuts']=array
        (
          "Propriétaire" => "Propriétaire",
          "Locataire" => "Locataire",
        );
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUnClient', $DonneesInjectees);
      }
    } // ajouterUnPersonnel

    public function Clients()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste des clients';
      $DonneesInjectees['Clients']=$this->ModeleUtilisateur->RecupererLesClients();
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/Clients', $DonneesInjectees);
    }
    public function DetailsClient($NoClient)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du client';
      $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($NoClient);
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnClient($NoClient);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsClient', $DonneesInjectees);
    }
    public function Personnel()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste du personnel';
      $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererLePersonnel();
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/Personnel', $DonneesInjectees);
    }
    public function Chantiers()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste des chantiers';
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiers();
      foreach ($DonneesInjectees['Chantiers'] as $key => $UnChantier) 
      {
        $UnClient=$this->ModeleUtilisateur->RecupererUnClient($UnChantier["NOCLIENT"]);
        $UnClient=array("NOCLIENT"=>$UnClient["NOCLIENT"],"NOM"=>$UnClient["NOM"],"PRENOM"=>$UnClient["PRENOM"]);
        $DonneesInjectees['Chantiers'][$key]["NOCLIENT"]=$UnClient;
      }
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/Chantiers', $DonneesInjectees);
    }
    public function DetailsChantier($NoChantier)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du chantier';
      $DonneesInjectees['Chantier']=$this->ModeleChantier->RecupererUnChantier($NoChantier);
      $DonneesInjectees['Categorie']=$this->ModeleChantier->RecupererUneCategorie($DonneesInjectees['Chantier']["NOCATEGORIE"])["NOM"];
      $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($DonneesInjectees['Chantier']["NOCLIENT"]);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsChantier', $DonneesInjectees);
    }
    public function AjouterUnChantier($noclient=null)
    {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter Un Chantier';
    If ($this->input->post('boutonAjouterChantier'))
      {
        $donneesAInserer = array(
          
          'NOCLIENT' => $this->input->post('Noclient'),
          'NOCATEGORIE'=> $this->input->post('CategorieChantier'),
          'NOM'=> $this->input->post('NomChantier'),
          'TYPE'=> $this->input->post('TypeChantier'),
          'PIECE'=> $this->input->post('PieceChantier'),
          'DETAIL'=> $this->input->post('DetailsChantier'),
          'STATUT'=> 'Attente',
          'ACCORD'=> $this->input->post('AccordImage'),
          'ADRESSE' => $this->input->post('AdresseClient'),
          'CP' => $this->input->post('CPClient'),
          'VILLE' => $this->input->post('VilleClient'),
          
        );
        $this->ModeleChantier->InsererUnChantier($donneesAInserer); // appel du modèle
        redirect("Administrateur/chantiers");
      }
      else
      {
        if(isset($noclient) && is_string($noclient))
        {
          $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($noclient);
        }
        else
        {
          redirect("Administrateur/Clients");
        }
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
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUnChantier', $DonneesInjectees);
      }
    } // ajouterUnChantier

    public function ModifierUnChantier()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Chantier';
      $DonneesInjectees['lesChantiers'] = $this->ModeleChantier->RecupererLesChantiers();
      $DonneesInjectees['lesCategories'] = $this->ModeleChantier->RecupererLesCategories();
      If ($this->input->post('boutonModification'))
      {
        $donneesAInserer = array(
          'NOCHANTIER' => $this->input->post('NoChantier'),
          'NOCATEGORIE' => $this->input->post('NoCategorie'),
          
        );
        $id = $this->input->post('NoProduit');
        $this->ModeleChantier->ModifierUnChantier($donneesAInserer, $id);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModifierUnChantier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnChantier
    public function AjouterImageAvant()
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Chantier';
      $DonneesInjectees['lesChantiers'] = $this->ModeleChantier->RecupererLesChantiers();
      $DonneesInjectees['lesCategories'] = $this->ModeleChantier->RecupererLesCategories();
      If ($this->input->post('boutonModification'))
      {
        if(isset($_FILES['avatar']))
        { 
          $dossier = "C:/xampp/htdocs/buiselec/assets/images/";
          $fichier = basename($_FILES['avatar']['name']);
          if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
          {
            
            $DonneesInjectees["Upload"]="Done";
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/ImageAvant', $DonneesInjectees);
          }
          else //Sinon (la fonction renvoie FALSE).
          {
            $DonneesInjectees["Upload"]="Failed";
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/ImageAvant', $DonneesInjectees);
          }
        }
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ImageAvant', $DonneesInjectees);
      }
    }
}