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
      $this->load->view('Administrateur/Home');
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

    public function ModifierUnPersonnel($nopersonnel=null)
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Personnel';

          If ($this->input->post('boutonModificationPersonnel'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomPersonnel'),
          'PRENOM' => $this->input->post('PrenomPersonnel'),
          'MAIL' => $this->input->post('MailPersonnel'),
          'MDP' => $this->input->post('MdpPersonnel'),
          'TELEPHONE' => $this->input->post('TelPersonnel'),
          'STATUT' => $this->input->post('StatutPersonnel'),
        );
        $id = $this->input->post('NoPersonnel');
        $this->ModeleUtilisateur->ModifierUnPersonnel($donneesAInserer, $id);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/InsertionReussie');
      }
      else
      {
        if(isset($nopersonnel) && is_string($nopersonnel))
        {
          $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererUnPersonnel($nopersonnel);
        }
        else
        {
          redirect("Administrateur/Personnel");
        }
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModifierUnPersonnel', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnCLient

    public function AjouterUnClient()
    {
      
      $path=random_int(0,2);
      if($path==2)
          {
              $MDP=$path=chr(random_int(97,122));
          }
      elseif($path==1)
          {
              $MDP=$path=chr(random_int(65,90));
          }
      else
          {
              $MDP=$path=chr(random_int(48,57));
          }
      for ($i=1; $i <= 10; $i++) { 
          $path=random_int(0,2);
          if($path==2)
          {
             $MDP=$MDP.$path=chr(random_int(97,122));
          }
          elseif($path==1)
          {
              $MDP=$MDP.$path=chr(random_int(65,90));
          }
          else
          {
              $MDP=$MDP.$path=chr(random_int(48,57));
          }
      }
    $this->load->helper('form');
    $this->load->library('form_validation');
    $DonneesInjectees['TitreDeLaPage'] = 'Ajouter Un client';
    If ($this->input->post('boutonAjouterClient'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomClient'),
          'PRENOM' => $this->input->post('PrenomClient'),
          'MAIL' => $this->input->post('MailClient'),
          'MDP' => $MDP,
          'TELEPHONE' => $this->input->post('TelClient'),
          'ADRESSE' => $this->input->post('AdresseClient'),
          'CP' => $this->input->post('CPClient'),
          'VILLE' => $this->input->post('VilleClient'),
          'STATUT' => $this->input->post('StatutClient'),
        );
        $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
        redirect("Administrateur/Clients");
      }
      else
      {
        $DonneesInjectees['Statuts']=array
        (
          "1" => "Propriétaire",
          "0" => "Locataire",
        );
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AjouterUnClient', $DonneesInjectees);
      }
    } // ajouterUnClient

    public function ModifierUnCLient($noclient=null)
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Client';
      $DonneesInjectees['Statuts']=array
        (
          "1" => "Propriétaire",
          "0" => "Locataire",
        );
      If ($this->input->post('boutonModificationClient'))
      {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomClient'),
          'PRENOM' => $this->input->post('PrenomClient'),
          'MAIL' => $this->input->post('MailClient'),
          'TELEPHONE' => $this->input->post('TelClient'),
          'ADRESSE' => $this->input->post('AdresseClient'),
          'CP' => $this->input->post('CPClient'),
          'VILLE' => $this->input->post('VilleClient'),
          'STATUT' => $this->input->post('StatutClient'),
          
        );
        $id = $this->input->post('NoClient');
        $this->ModeleUtilisateur->ModifierUnCLient($donneesAInserer, $id);// appel du modèle
        redirect('Administrateur/DetailsClient/'.$id);
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
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModifierUnClient', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnCLient

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

    public function DetailsPersonnel($NoPersonnel)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du Personnel';
      $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererUnPersonnel($NoPersonnel);
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnPersonnel($NoPersonnel);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsPersonnel', $DonneesInjectees);
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
    public function DetailsChantier($NoChantier=null)
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

    public function ModifierUnChantier($NoChantier=null)
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Chantier';
      $DonneesInjectees['Chantier'] = $this->ModeleChantier->RecupererUnChantier($NoChantier);
      $DonneesInjectees['lesCategories'] = $this->ModeleChantier->RecupererLesCategories();
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
      If ($this->input->post('boutonModification'))
      {
        $donneesAInserer = array(
          'NOCATEGORIE' => $this->input->post('NoCategorie'),
          'NOM'=> $this->input->post('NomChantier'),
          'TYPE'=> $this->input->post('TypeChantier'),
          'PIECE'=> $this->input->post('PieceChantier'),
          'DETAIL'=> $this->input->post('DetailsChantier'),
          'ADRESSE' => $this->input->post('AdresseChantier'),
          'CP' => $this->input->post('CPChantier'),
          'VILLE' => $this->input->post('VilleChantier'),
          
        );
        $id = $this->input->post('NoChantier');
        $this->ModeleChantier->ModifierUnChantier($donneesAInserer, $id);// appel du modèle
        
        redirect('administrateur/detailschantier/'.$NoChantier);
        
      }
      else
      {
        if(isset($NoChantier) && is_string($NoChantier))
        {
          $DonneesInjectees['Chantier'] = $this->ModeleChantier->RecupererUnChantier($NoChantier);
          $DonneesInjectees['lesCategories'] = $this->ModeleChantier->RecupererLesCategories();
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
        }
        else
        {
          redirect("Administrateur/Chantiers");
        }
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/ModifierUnChantier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnChantier

    public function AjouterImageAvant($NoChantier)
    {
      ini_set('upload_max_filesize', '10M');
      ini_set('post_max_size', '10M');
      ini_set('max_input_time', 300);
      ini_set('max_execution_time', 300);
      $this->load->helper('form');
      $DonneesInjectees['NoChantier'] = $NoChantier;
      if ($this->input->post('boutonModification'))
      {
        if(isset($_FILES['ImageAvant']))
        {
          $dossier = "C:\\xampp\htdocs\Buiselec\assets\images\\";
          $_FILES['ImageAvant']['name']=$_FILES['ImageAvant']['name'] = str_replace(' ', '_', $_FILES['ImageAvant']['name']);
          $fichier = basename($_FILES['ImageApres']['name']);
          /*if (strpos($fichier, ".png") !== FALSE || strpos($fichier, ".jpg") !== FALSE || strpos($fichier, ".jpeg") !== FALSE)
          {*/
            $i=1;
            do
            {
              if(file_exists($dossier . $fichier))
              {
                $fichier=str_replace('.jpg', "(".strval($i).").jpg", $_FILES['ImageAvant']['name']);
                $fichier=str_replace('.jpeg', "(".strval($i).").jpeg", $_FILES['ImageAvant']['name']);
                $fichier=str_replace('.png', "(".strval($i).").png", $_FILES['ImageAvant']['name']);
              }
              if(move_uploaded_file($_FILES['ImageAvant']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
              {
                $this->session->Upload="Done";
                $this->ModeleChantier->AjouterImage(array("IMAGEAVANT"=>$fichier), $NoChantier);
                redirect('administrateur/detailschantier/'.$NoChantier);
              }
              $i+=1;
            }
            while(file_exists($dossier . $fichier));
            $this->session->Upload="Failed";
            redirect('administrateur/detailschantier/'.$NoChantier);        
          /*}
          else
          {
            $this->session->Upload="FlawedType";
            redirect('administrateur/detailschantier/'.$NoChantier);
          }*/
        }
      }
      else
      {
        $this->session->Upload="Error";
        redirect('administrateur/detailschantier/'.$NoChantier);
      }
    }
    public function AjouterImageApres($NoChantier)
    {
      ini_set('upload_max_filesize', '10M');
      ini_set('post_max_size', '10M');
      ini_set('max_input_time', 300);
      ini_set('max_execution_time', 300);
      $this->load->helper('form');
      $DonneesInjectees['NoChantier'] = $NoChantier;
      If ($this->input->post('boutonModification'))
      {
        if(isset($_FILES['ImageApres']))
        { 
          $dossier = "C:\\xampp\htdocs\Buiselec\assets\images\\";
          $_FILES['ImageAvant']['name']=$_FILES['ImageAvant']['name'] = str_replace(' ', '_', $_FILES['ImageAvant']['name']);
          $fichier = basename($_FILES['ImageApres']['name']);
          if (strpos($fichier, ".png") !== FALSE || strpos($fichier, ".jpg") !== FALSE || strpos($fichier, ".jpeg") !== FALSE)
          {
            $i=1;
            do
            {
              if(file_exists($dossier . $fichier))
              {
                $fichier=basename($_FILES['ImageApres']['name'])."(".strval($i).")";
              }
              if(move_uploaded_file($_FILES['ImageApres']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
              {
               $this->session->Upload="Done";
                $this->ModeleChantier->AjouterImage(array("IMAGEAPRES"=>$fichier), $NoChantier);
                redirect('administrateur/detailschantier/'.$NoChantier);
              }
              $i+=1;
            }
            while(file_exists($dossier . $fichier));
            $this->session->Upload="Failed";
            redirect('administrateur/detailschantier/'.$NoChantier);
          }
          else
          {
            $this->session->Upload="FlawedType";
            redirect('administrateur/detailschantier/'.$NoChantier);
          }
        }
      }
      else
      {
        $this->session->Upload="Error";
        redirect('administrateur/detailschantier/'.$NoChantier);
      }
    }
}