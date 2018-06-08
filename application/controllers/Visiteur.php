<?php
class Visiteur extends CI_Controller 
{
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets');
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
    $config["base_url"] = site_url('visiteur/Home');  
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Home");
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function Contact() {
    $this->session->TitreDeLaPage = "Contact";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Contact");
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
          'STATUT' => '1',
        );
        $this->ModeleUtilisateur->InsererUnClient($donneesAInserer); // appel du modèle
        
        $this->session->Client=array(
            'NOM' => $this->input->post('NomClient'),
            'PRENOM' => $this->input->post('PrenomClient'),
            'MAIL' => $this->input->post('MailClient'),
            'MDP' => $MDP,
            'TELEPHONE' => $this->input->post('TelClient'),
            'ADRESSE' => $this->input->post('AdresseClient'),
            'CP' => $this->input->post('CPClient'),
            'VILLE' => $this->input->post('VilleClient'),
            'STATUT' => '1',
        );
        redirect('Visiteur/SeConnecter');
        
    }// Inscription

   public function SeConnecter() {
    if (isset($this->session->Client))
    {
        $this->session->Profil=0;
        $this->session->Connexion="Reussite";
        redirect("Visiteur/Home");
    }
    elseif(!isset($this->session->Client))
    {
        $this->session->DonneesConnexion=array("MAIL"=>$this->input->post('MailClient'), "MDP"=>$this->input->post('MDP'));
        $Client=$this->ModeleUtilisateur->RecupererUnClient($this->session->DonneesConnexion);
        if($Client)
        {
            $this->session->Client=array(
                'NOM' => $Client['NomClient'],
                'PRENOM' => $Client['PrenomClient'],
                'MAIL' => $Client['MailClient'],
                'MDP' => $Client['MDP'],
                'TELEPHONE' => $Client['TelClient'],
                'ADRESSE' => $Client['AdresseClient'],
                'CP' => $Client['CPClient'],
                'VILLE' => $Client['VilleClient'],
                'STATUT' => '1',
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
    }
   }// Connexion

   public function Image() {
    $this->session->TitreDeLaPage = "Image";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Image");
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

   public function upload()
   {
    if(isset($_FILES['avatar']))
    { 
        $dossier = base_url()."assets/images/";
        echo $dossier;
        $fichier = basename($_FILES['avatar']['name']);
        echo $fichier;
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }
    }
   }
}