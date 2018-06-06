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

   public function Inscription() {
    $DonneesInjectees['TitreDeLaPage'] = "Inscription";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/Inscription", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
   }// Image

   public function SeConnecter() {
    $this->load->helper('form');
    $DonneesInjectees['TitreDeLaPage'] = "Connexion";
    $this->load->view('templates/Entete');
    $this->load->view("visiteur/SeConnecter", $DonneesInjectees);
    $this->load->view('templates/PiedDePage');
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