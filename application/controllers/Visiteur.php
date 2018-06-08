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
      
      $this->load->model('ModeleChantier');
      $this->load->model('ModeleUtilisateur');
   } // __construct

   public function Home() {
    $DonneesInjectees['TitreDeLaPage'] = "Page d'acceuil";
    $config["base_url"] = site_url('visiteur/Home');  
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Home", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Page d'acceuil

   public function Contact() {
    $DonneesInjectees['TitreDeLaPage'] = "Contact";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Contact", $DonneesInjectees);
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
    $this->load->helper('form');
    $DonneesInjectees['TitreDeLaPage'] = "Connexion";
    $this->load->view('templates/Entete');
    print_r($this->session->Client);
    echo $this->session->Client["NOM"]."/".$this->session->Client["MAIL"]."/".$this->session->Client["MDP"];
   }// Connexion

   public function Image() {
    $DonneesInjectees['TitreDeLaPage'] = "Image";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Image", $DonneesInjectees);
   }// Image
   
   public function MentionsLegales()
   {
    $DonneesInjectees['TitreDeLaPage'] = "Contact";
    $this->load->view('templates/Entete');
    $this->load->view("MentionsLegales", $DonneesInjectees);
   }//Mentions légales

}