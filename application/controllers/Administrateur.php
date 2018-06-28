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
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUneCatégorie
    public function Home()
    {
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/Home');
      $this->load->view('templates/PiedDePage');
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
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnPersonnel

    public function ModifierUnPersonnel($NoPersonnel)
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
        $this->ModeleUtilisateur->ModifierUnPersonnel($donneesAInserer, $NoPersonnel);// appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        redirect('administrateur/detailspersonnel/'.$NoPersonnel);
      }
      else
      {
        if(isset($NoPersonnel) && is_string($NoPersonnel))
        {
          $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererUnPersonnel($NoPersonnel);
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
        
        {
          $Mail=$donneesAInserer["MAIL"];
          ini_set("SMTP","smtp.gmail.com");
          ini_set("smtp_port","487");
          ini_set('username','buiselec@gmail.com');
          ini_set('password','google1329');
          if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $Mail))
          {
              $passage_ligne = "\r\n";
          }
          else
          {
            $passage_ligne = "\n";
          }
          $message_txt = "Suites à votre demande, nous vous avons créé un compte sur le site buiselec.com. Vous pouvez vous-y connecter pour voir les demandes de chantiers que vous avez passé avec nous, ou modifier certaines données ou paramètres. Pour cela, vous aurez besoin de votre adresse mail et de votre mot de passe généré automatiquement: ".$MDP.".";
          $message_html = "<html><head></head><body>Suites &agrave; votre demande, nous vous avons cr&eacute;&eacute; un compte sur le site buiselec.com. Vous pouvez vous-y connecter pour voir les demandes de chantiers que vous avez pass&eacute;es avec nous, ou modifier certaines donn&eacute;es ou param&egrave;tres. Pour cela, vous aurez besoin de votre adresse mail et de votre mot de passe g&eacute;n&eacute;r&eacute; automatiquement: ".$MDP.".<br/>".anchor('http://127.0.0.1/Buiselec', 'Revenir sur le site')."</body></html>";
          $boundary = "-----=".md5(rand());
          $sujet = "Inscription Buiselec";
          $header = "From: \"Buiselec\"<buiselec@gmail.com>".$passage_ligne;
          $header .= "Reply-to: \"$Mail\" <$Mail>".$passage_ligne;
          $header .= "MIME-Version: 1.0".$passage_ligne;
          $header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
          $message = $passage_ligne."--".$boundary.$passage_ligne;
          $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
          $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
          $message.= $passage_ligne.$message_txt.$passage_ligne;
          $message.= $passage_ligne."--".$boundary.$passage_ligne;
          $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
          $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
          $message.= $passage_ligne.$message_html.$passage_ligne;
          $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
          $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
          $envoi=mail($Mail,$sujet,$message,$header);
          if ($envoi)
          {
            $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
            redirect('administrateur/clients');
          }
          else
          {
              $DonneesInjectees["EnvoiMail"]="Failed";
              $this->load->view('templates/Entete');
              $this->load->view('Administrateur/AjouterUnClient', $DonneesInjectees);
              $this->load->view('templates/PiedDePage');
          }
        }
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
        $this->load->view('templates/PiedDePage');
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
      $this->load->view('templates/PiedDePage');
    }
    public function DetailsClient($NoClient)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du client';
      $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($NoClient);
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnClient($NoClient);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsClient', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    public function Personnel()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste du personnel';
      $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererLePersonnel();
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/Personnel', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }

    public function DetailsPersonnel($NoPersonnel)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du Personnel';
      $DonneesInjectees['Personnel']=$this->ModeleUtilisateur->RecupererUnPersonnel($NoPersonnel);
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnPersonnel($NoPersonnel);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsPersonnel', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    public function AssignerChantier($NoPersonnel=0, $NoChantier=0)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Assigner Un Chantier';
      If ($NoChantier!=0)
      {
        $this->ModeleUtilisateur->AssignerChantier($NoPersonnel, $NoChantier);
        redirect("Administrateur/DetailsPersonnel/".$NoPersonnel);
      }
      else
      {
        $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersPasAssignesAPersonnel($NoPersonnel);
        $DonneesInjectees['NoPersonnel']=$NoPersonnel;
        $this->load->view('templates/Entete');
        $this->load->view('Administrateur/AssignerChantier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    }
    public function AjouterTemps($NoPersonnel, $NoChantier)
    {
      $this->ModeleUtilisateur->AjouterTemps($NoPersonnel, $NoChantier, $this->input->post("Heures"));
      redirect('administrateur/detailspersonnel/'.$NoPersonnel);
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
      $this->load->view('templates/PiedDePage');
    }
    public function DebutChantier($NoChantier)
    {
      $this->ModeleChantier->ModifierUnChantier(array("DATEDEBUT"=>date('Y-m-d'),"STATUT"=>"Commencé"), $NoChantier);
      redirect('administrateur/detailschantier/'.$NoChantier);
    }
    public function FinChantier($NoChantier)
    {
      $this->ModeleChantier->ModifierUnChantier(array("DATEFIN"=>date('Y-m-d'),"STATUT"=>"Terminé"), $NoChantier);
      redirect('administrateur/detailschantier/'.$NoChantier);
    }
    public function DetailsChantier($NoChantier=null)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Détails du chantier';
      $DonneesInjectees['Chantier']=$this->ModeleChantier->RecupererUnChantier($NoChantier);
      $DonneesInjectees['Categorie']=$this->ModeleChantier->RecupererUneCategorie($DonneesInjectees['Chantier']["NOCATEGORIE"])["NOM"];
      $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($DonneesInjectees['Chantier']["NOCLIENT"]);
      $this->load->view('templates/Entete');
      $this->load->view('Administrateur/DetailsChantier', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
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
        $this->load->view('templates/PiedDePage');
      }
    } // ajouterUnChantier
    public function DevisEnvoye($NoChantier)
    {
      $this->ModeleChantier->ModifierUnChantier(array("STATUT"=>"Devis"), $NoChantier);
      
      redirect('administrateur/detailschantier/'.$NoChantier);
      
    }
    public function ChantierConfirme($NoChantier)
    {
      $this->ModeleChantier->ModifierUnChantier(array("STATUT"=>"Confirmé"), $NoChantier);
      
      redirect('administrateur/detailschantier/'.$NoChantier);
      
    }
    public function ChantierAnnule($NoChantier)
    {
      $this->ModeleChantier->ModifierUnChantier(array("STATUT"=>"Annulé"), $NoChantier);
      
      redirect('administrateur/detailschantier/'.$NoChantier);
      
    }
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
          'ACCORD' => $this->input->post('AccordImages'),
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
                $this->ModeleChantier->ModifierUnChantier(array("IMAGEAVANT"=>$fichier), $NoChantier);
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
                $this->ModeleChantier->ModifierUnChantier(array("IMAGEAPRES"=>$fichier), $NoChantier);
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
    public function ResultatRechercher()
   { 
    $Libelle = $this->input->post('recherche');
    if (empty($Libelle))
     {   // pas d'article correspondant au n°
        $DonneesInjectees['Champ']="Vide";
     }
    $DonneesInjectees['Search'] = $this->ModeleChantier->RechercherUnChantier($Libelle);
    $DonneesInjectees['TitreDeLaPage'] = 'Resultats de votre recherche';
    $this->load->view('templates/Entete');
    $this->load->view('Administrateur/ResultatRechercher', $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  } // ResultatRechercheUnArticle
}