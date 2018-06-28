<?php
class Visiteur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
      $this->load->helper('form');
      $this->load->library("pagination");
      $this->load->library('form_validation');
      $this->load->library('session');
      if (!isset($this->session))
      {
          session_start();
      }
      $this->load->model('ModeleChantier');
      $this->load->model('ModeleUtilisateur');
   } // __construct
   
   public function Home() {
    $DonneesInjectees['TitreDeLaPage']="Page d'accueil";
    $DonneesInjectees['Chantiers']=$this->ModeleChantier->GetChantiersPublics();
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Home", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function Contact() {
    $DonneesInjectees['TitreDeLaPage'] = "Contact";
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Contact", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Contact

   public function Inscription()
    {
        $donneesAInserer = array(
          'NOM' => $this->input->post('NomClient'),
          'PRENOM' => $this->input->post('PrenomClient'),
          'MAIL' => $this->input->post('MailClient'),
          'MDP' => $this->input->post('MdpClient'),
          'TELEPHONE' => $this->input->post('TelClient'),
          'ADRESSE' => $this->input->post('AdresseClient'),
          'CP' => $this->input->post('CPClient'),
          'VILLE' => $this->input->post('VilleClient'),
          'STATUT' => $this->input->post('StatutClient'),
        );
        if ($this->ModeleUtilisateur->RecupererUnClient(array('MAIL' => $this->input->post('MailClient')))==null)
        {
            
            $this->session->Inscription="MailNonExistant";
            $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
            $this->session->DonneesConnexion=array(
                'MAIL' => $this->input->post('MailClient'),
                'MDP' => $this->input->post('MdpClient'),
            );
            redirect('Visiteur/SeConnecter');
        }
        else
        {
            $this->session->DonneesInscription=$donneesAInserer;
            $this->session->Inscription="MailExistant";
            redirect("Visiteur/Home");
        }
    }// Inscription
    public function personnel()
    {
        $DonneesInjectees['TitreDeLaPage'] = 'Se connecter (personnel)';
        If ($this->input->post('boutonPersonnel'))
        {
            $donneesPersonnel = array(
                'MAIL' => $this->input->post('MailClient'),
                'MDP' => $this->input->post('MDP'),
            );
            $personnel=$this->ModeleUtilisateur->RecupererUnPersonnel($donneesPersonnel);
            if($personnel!=null)
            {
                $DonneesInjectees['Connexion']=true;
                $this->session->personnel=$personnel;
                $this->session->Profil=$personnel['STATUT'];
                redirect('Administrateur/Home');
            }
            else
            {
                $DonneesInjectees['Connexion']=false;
                $this->load->view('templates/Entete');
                $this->load->view('Administrateur/SeConnecter', $DonneesInjectees);
                $this->load->view('templates/PiedDePage');
            }
        }
        else
        {
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/SeConnecter', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
    }
    public function ModifierProfil($noclient=null)
    {
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Modifier mon profil';
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
        $this->session->Modif="Reussie";
        redirect('Visiteur/profil/'.$id);
      }
      else
      {
        $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($noclient);
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/ModifierUnClient', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    } // ModificationUnCLient
    public function MDPOublie($Mail)
    {
      if($this->ModeleUtilisateur->RecupererUnCLient($Mail))
      {
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
    public function ModifierMDP($NoClient)
    {
        $DonneesInjectees['TitreDeLaPage'] = 'Modifier mot de passe';
        If ($this->input->post('boutonModificationMDP'))
      {
        $AncienMDP = array(
          'NOCLIENT'=>$NoClient,
          'MDP' => $this->input->post('AnciMdpClient'),
        );
        if($this->ModeleUtilisateur->RecupererUnCLient($AncienMDP))
        {
            $this->ModeleUtilisateur->ModifierUnCLient(array("MDP"=>$this->input->post('NouvMdpClient')), $NoClient);
            $this->session->Modif="Reussie";
            redirect('Visiteur/profil/'.$NoClient);
        }
        else
        {
            $DonneesInjectees["MDP"]="Incorrect";
            $this->load->view('templates/Entete');
            $this->load->view('Visiteur/ModifMDP', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
      }
      else
      {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/ModifMDP', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
    }
    public function Profil($NoClient)
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Mon Profil';
      $DonneesInjectees['Client']=$this->ModeleUtilisateur->RecupererUnClient($NoClient);
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/DetailsClient', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   public function SeConnecter() {
    if(!isset($this->session->DonneesConnexion))
    {
        $this->session->DonneesConnexion=array("MAIL"=>$this->input->post('MailClient'), "MDP"=>$this->input->post('MDP'));
    }
        $Client=$this->ModeleUtilisateur->RecupererUnClient($this->session->DonneesConnexion);
        if($Client)
        {
            $this->session->Client=array(
                'NOCLIENT' => $Client['NOCLIENT'],
                'NOM' => $Client['NOM'],
                'PRENOM' => $Client['PRENOM'],
                'MAIL' => $Client['MAIL'],
                'TELEPHONE' => $Client['TEL'],
                'ADRESSE' => $Client['ADRESSE'],
                'CP' => $Client['CP'],
                'VILLE' => $Client['VILLE'],
                'STATUT' => $Client['STATUT'],
            );
            $this->session->Profil=0;
            unset($this->session->DonneesConnexion);
            $this->session->Connexion="Reussite";
            redirect("Visiteur/Home");
        } 
        else
        {

            $this->session->Connexion="Echec";
            redirect("Visiteur/Home");
        }
    
   }// Connexion
   public function ChantierConfirme($NoChantier)
   {
     $this->ModeleChantier->ModifierUnChantier(array("STATUT"=>"Confirmé"), $NoChantier);
     
     redirect('visiteur/detailschantier/'.$NoChantier);
     
   }
   public function ChantierAnnule($NoChantier)
   {
     $this->ModeleChantier->ModifierUnChantier(array("STATUT"=>"Annulé"), $NoChantier);
     
     redirect('visiteur/detailschantier/'.$NoChantier);
     
   }
   public function ModifierUnChantier($NoChantier=null)
   {
     $this->load->helper('form');
     $DonneesInjectees['TitreDeLaPage'] = 'Modifier un Chantier';
     $DonneesInjectees['Chantier'] = $this->ModeleChantier->RecupererUnChantier($NoChantier);
     if($DonneesInjectees['Chantier']["NOCLIENT"]==$this->session->Client["NOCLIENT"])
     {
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
           
           redirect('visiteur/detailschantier/'.$NoChantier);
           
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
             redirect("visiteur/VosChantiers");
           }
           $this->load->view('templates/Entete');
           $this->load->view('Visiteur/ModifierUnChantier', $DonneesInjectees);
           $this->load->view('templates/PiedDePage');
         }
     }
     else
     {
         $this->session->ChantierInvalide=true;
         redirect('visiteur/home');
     }
   } // ModificationUnChantier
   public function CreerChantier()
   {
    $DonneesInjectees['TitreDeLaPage'] = "Créer un chantier";
    If ($this->input->post('boutonAjouterChantier'))
    {
        if ($this->input->post('TypeChantier')==1)
        {
            $type="Neuf";
        }
        else
        {
            $type="Rénovation";
        }
        $donneesAInserer = array(
          
          'NOCLIENT' => $this->session->Client['NOCLIENT'],
          'NOCATEGORIE'=> $this->input->post('CategorieChantier'),
          'NOM'=> $this->input->post('PieceChantier').", ".$this->session->Client['NOM'],
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
        redirect("visiteur/voschantiers");
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
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/CréerChantier', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
   }// Créer un chantier

   public function VosChantiers()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste de vos chantiers';
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnClient($this->session->Client['NOCLIENT']);
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/Chantiers', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   public function DetailsChantier($NoChantier)
    {
        $DonneesInjectees['TitreDeLaPage'] = 'Détails du chantier';
        $DonneesInjectees['Chantier']=$this->ModeleChantier->RecupererUnChantier($NoChantier);
        if($DonneesInjectees['Chantier']["NOCLIENT"]==$this->session->Client["NOCLIENT"])
        {
          $DonneesInjectees['Categorie']=$this->ModeleChantier->RecupererUneCategorie($DonneesInjectees['Chantier']["NOCATEGORIE"])["NOM"];
          $this->load->view('templates/Entete');
          $this->load->view('Visiteur/DetailsChantier', $DonneesInjectees);
          $this->load->view('templates/PiedDePage');
        }
        else
        {
            $this->session->ChantierInvalide=true;
            redirect('visiteur/home');
        }
    }
   public function Galerie() 
   {
    $DonneesInjectees['TitreDeLaPage'] = "Galerie";
    $DonneesInjectees['Chantiers'] = $this->ModeleChantier->GetChantiersPublics();
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Image", $DonneesInjectees);
    //$this->load->view('templates/PiedDePage');
   }// Image
   
   public function MentionsLegales()
   {
    $DonneesInjectees['TitreDeLaPage'] = "Mentions légales";
    $this->load->view('templates/Entete');
    $this->load->view("MentionsLegales");
    $this->load->view('templates/PiedDePage');
   }//Mentions légales
   public function Deconnexion()
   {
       session_destroy();
       redirect('Visiteur/Home');
   }
}