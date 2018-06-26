<html>
<head>
<title>Buiselec</title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="<?=base_url();?>assets\css\Styles.css">
<link rel="icon" type="image/png" href="<?=base_url();?>assets/images/favicon.ico" />
</head>
<body>
<div class="GifBuiselec">
<?php echo img("buiselec.gif", "", array("style"=>"width: 50%; display: block;margin-left: auto; margin-right: auto;")); ?></div>
<div class="Entete">
<a class="Buiselec-Button" href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil<?php if (isset($this->session->Profil) && ($this->session->Profil==1 || $this->session->Profil==2)) echo " des clients";?></a>
<a class="Buiselec-Button" href="<?php echo site_url('visiteur/Galerie') ?>">Galerie</a>
<?php if (!isset($this->session->Profil))
{?>
<div onclick="document.getElementById('id01').style.display='block'" class="Buiselec-Button">Connexion / Inscription</div>
<?php
}
else
{
?>
<div onclick="document.getElementById('id02').style.display='block'" class="Buiselec-Button">Deconnexion</div>
<?php
if($this->session->Profil==0)
{
?>
<a class="Buiselec-Button" href="<?php echo site_url('visiteur/VosChantiers') ?>">Vos Chantiers</a>

<?php
}
}
if($this->session->Profil!=1 && $this->session->Profil!=2)
{?>
<a class="Buiselec-Button" href="<?php echo site_url('visiteur/Contact') ?>">Contactez-nous</a>

<?php 
}
?>
</div>

<?php
if (isset($this->session->Profil) && ($this->session->Profil==1 || $this->session->Profil==2))
{?>
<div class="Admin">
<a class="Buiselec-Button" href="<?php echo site_url('administrateur/Home') ?>">Page d'acceuil personnel</a>
<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/DetailsPersonnel/'.$this->session->personnel["NOPERSONNEL"]) ?>">Mon profil</a>
<?php
if ($this->session->Profil==2)
{?>
<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/Clients') ?>">Liste des clients</a>
<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/Personnel') ?>">Liste du personnel</a>
<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/Chantiers') ?>">Liste des chantiers</a>
<?php
}
?>
</div>
<?php
}
?>
<div class="w3-container">
  
  

  <div id="id01" class="w3-modal">
      <?php
      if($this->session->Connexion=="Echec" || $this->session->Inscription=="MailExistant")
      {
        echo "<script> document.getElementById('id01').style.display='block' </script>";
      }
      ?>
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-black"> 
        <span class="close" onclick="document.getElementById('id01').style.display='none'" 
          class="w3-button w3-display-topright">&times;</span>
        <h2>Connexion / Inscription</h2>
      </header>
      <div class="w3-container">
      <table class="seConnecter">
        <tr>
            <td>
        <?php
            echo form_open('Visiteur/SeConnecter');
            
            echo form_label('Mail : ', 'Mail')."<BR/>";
            echo form_input('MailClient', $this->session->DonneesConnexion['MAIL'],array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required'))."<BR/>";

            echo form_label('Mot de passe : ', 'MDP')."<BR/>";
            echo form_password('MDP', $this->session->DonneesConnexion['MDP'], "required")."<BR/><BR/>";

            if($this->session->Connexion=="Echec")
            {
                echo "<div class='echec'>Mail ou mot de passe incorrect.</div>";
            }
            echo form_submit('boutonConnexion', 'Se connecter');
            

            echo form_close();
            
            $this->session->Connexion="";
        ?>    
            En vous connectant, vous pouvez faire une demande de chantier ou voir les demandes de chantiers que vous avez en cours avec nous.
            </td>
            <td>
            <?php
            
            echo form_open('Visiteur/Inscription');
            echo form_label("Nom : ", 'lbltNom').'<BR>';
            echo form_input('NomClient',$this->session->DonneesInscription['NOM'],array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR>';

            echo form_label("Prenom : ", 'lbltPrenom').'<BR>';
            echo form_input('PrenomClient',$this->session->DonneesInscription['PRENOM'],array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR>';

            echo form_label("Email : ", 'lbltEmail').'<BR>';
            echo form_input('MailClient',$this->session->DonneesInscription['MAIL'],array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';
  
            if($this->session->Inscription=="MailExistant")
            {
                echo "<div class='echec'>Mail déja utilisé.</div>";
            }
            
            echo form_label("Mot de passe : ", 'lbltMDP').'<BR>';
            echo form_password('MdpClient',$this->session->DonneesInscription['MDP'],array('required'=>'required')).'<BR>';

            echo form_label("Telephone : ", 'lbltTel').'<BR>';
            echo form_input('TelClient',$this->session->DonneesInscription['TELEPHONE'],array('pattern' =>'^[0-9]{10,10}$')).'<BR>';

            echo form_label("Adresse : ", 'lbltAdresse').'<BR>';
            echo form_input('AdresseClient',$this->session->DonneesInscription['ADRESSE'],array('required'=>'required')).'<BR>';

            echo form_label("Code Postale : ", 'lbltCP').'<BR>';
            echo form_input('CPClient',$this->session->DonneesInscription['CP'],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

            echo form_label("Ville : ", 'lbltVille').'<BR>';
            echo form_input('VilleClient',$this->session->DonneesInscription['VILLE'],array('pattern' =>'^[a-zA-Z\-]{3,24}$','required'=>'required')).'<BR><BR>';

            echo form_label("Etes-vous : ", 'lbltStatut').'<BR>';
            if(isset($this->session->DonneesInscription['STATUT']) && $this->session->DonneesInscription['STATUT']=="0")
            {
              echo form_radio('StatutClient','1', "", 'required').'Propriétaire<BR><BR>';
              echo form_radio('StatutClient','0', "checked", 'required').'Locataire<BR><BR>';
            }
            else
            {
              echo form_radio('StatutClient','1', "checked", 'required').'Propriétaire<BR><BR>';
              echo form_radio('StatutClient','0', "", 'required').'Locataire<BR><BR>';
            }
            ?>
            <table class="consent">
                <tr>
                    <td>
            <?php
            echo form_label("En continuant, vous acceptez la collecte de vos données.", 'lbltConsent');
            ?>
                    </td>
                    <td>
            <?php
            echo form_checkbox('Consent', 'consent', FALSE, 'required').'<BR><BR>';
            ?>
                    </td>
                </tr>
            </table>
            <?php
            echo form_submit('boutonInscription', 'Inscription').'<BR>';
            echo form_close();
            $this->session->Inscription="";
        ?>
            </td>
        </tr>
      </table>
      </div>
    </div>
  </div>
  <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Déconnexion</h2>
      </header>
      <div class="w3-container">
        <h4>Voulez-vous vraiment vous déconnecter?</h4>
        <?php
        echo form_open('Visiteur/Deconnexion');
        echo form_submit('btnSubmit', 'Oui');
        ?>
            <button type="button" onclick="document.getElementById('id02').style.display='none'">Non</button>
        <?php
        echo form_close();
        ?>
      </div>
    </div>
  </div>
</div>
<div class="Page">