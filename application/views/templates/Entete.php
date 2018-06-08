<html>
<head>
<title>Buiselec</title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="<?=base_url();?>assets\css\Styles.css">
</head>
<body>

<a href="<?php echo site_url('visiteur/Home') ?>">Page d'acceuil</a>&nbsp;&nbsp;
<a href="<?php echo site_url('visiteur/Image') ?>">Image</a>&nbsp;&nbsp;
<div onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Connexion / Inscription</div>&nbsp;&nbsp;
<a href="<?php echo site_url('visiteur/Contact') ?>">Contactez-nous</a>&nbsp;&nbsp;


<a href="<?php echo site_url('Administrateur/AjouterUnClient') ?>">Ajouter un client</a>&nbsp;&nbsp;
<a href="<?php echo site_url('Administrateur/AjouterPersonnel') ?>">Ajouter un personnel</a>&nbsp;&nbsp;
<a href="<?php echo site_url('Administrateur/AjouterUneCategorie') ?>">Ajouter une catégorie</a>&nbsp;&nbsp;
<a href="<?php echo site_url('Administrateur/SelectionnerUnClient') ?>">Ajouter un chantier</a>&nbsp;&nbsp;
<a href="<?php echo site_url('Administrateur/ModifierUnChantier') ?>">Modifier un chantier</a>&nbsp;&nbsp;

<a href="<?php echo site_url('Administrateur/AjouterUnChantier') ?>">Ajouter un chantier</a>&nbsp;&nbsp;
<div class="w3-container">
  
  

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-black"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
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
            echo form_input('MailClient', '')."<BR/>";

            echo form_label('Mot de passe : ', 'MDP')."<BR/>";
            echo form_password('MDP', '')."<BR/><BR/>";

            echo form_submit('submit', 'Se connecter');
            

            echo form_close();
            
        ?>    
            </td>
            <td>
            <?php
            
            echo form_open('Visiteur/Inscription');
            echo form_label("Nom : ", 'lbltNom').'<BR>';
            echo form_input('NomClient','',array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR>';

            echo form_label("Prenom : ", 'lbltPrenom').'<BR>';
            echo form_input('PrenomClient','',array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR>';

            echo form_label("Email : ", 'lbltEmail').'<BR>';
            echo form_input('MailClient','',array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';

            echo form_label("Telephone : ", 'lbltTel').'<BR>';
            echo form_input('TelClient','',array('pattern' =>'^[0-9]{10,10}$')).'<BR>';

            echo form_label("Adresse : ", 'lbltAdresse').'<BR>';
            echo form_input('AdresseClient','',array('required'=>'required')).'<BR>';

            echo form_label("Code Postale : ", 'lbltCP').'<BR>';
            echo form_input('CPClient','',array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

            echo form_label("Ville : ", 'lbltAdresse').'<BR>';
            echo form_input('VilleClient','',array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR><BR>';
            ?>
            <table class="consent">
                <tr>
                    <td>
            <?php
            echo form_label("En continuant, vous acceptez que nous collections vos données.", 'lbltConsent');
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
            
        ?>
            </td>
        </tr>
      </table>
      </div>
    </div>
  </div>
</div>