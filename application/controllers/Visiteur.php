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
    $this->session->TitreDeLaPage = "Page d'acceuil"; 
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Home");
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function Contact() {
    $this->session->TitreDeLaPage = "Contact";
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Contact");
   }// Contact

   public function Inscription()
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
        
        $this->session->DonneesConnexion=array(
            'MAIL' => $this->input->post('MailClient'),
            'MDP' => $MDP,
        );
        redirect('Visiteur/SeConnecter');
        
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
            }
        }
        else
        {
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/SeConnecter', $DonneesInjectees);
        }
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
            $this->session->Connexion="Reussite";
            redirect("Visiteur/Home");
        } 
        else
        {

            $this->session->Connexion="Echec";
            redirect("Visiteur/Home");
        }
    
   }// Connexion

   public function CreerChantier()
   {
    $this->session->TitreDeLaPage = "Créer un chantier";
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
      }
   }// Créer un chantier

   public function VosChantiers()
    {
      $DonneesInjectees['TitreDeLaPage'] = 'Liste de vos chantiers';
      $DonneesInjectees['Chantiers']=$this->ModeleChantier->RecupererLesChantiersDUnClient($this->session->Client['NOCLIENT']);
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/Chantiers', $DonneesInjectees);
    }

   public function Image() {
    $this->session->TitreDeLaPage = "Image";
    $this->load->view('templates/Entete');
    $this->load->view("Visiteur/Image");
   }// Image
   
   public function MentionsLegales()
   {
    $this->session->TitreDeLaPage = "Mentions légales";
    $this->load->view('templates/Entete');
    $this->load->view("MentionsLegales");
   }//Mentions légales
   public function Deconnexion()
   {
       session_destroy();
       redirect('Visiteur/Home');
   }
}