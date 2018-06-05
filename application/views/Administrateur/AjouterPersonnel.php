<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/AjouterPersonnel');

echo form_label("Nom : ", 'lbltNom');
echo form_input('NomPersonnel','',array('pattern' =>'^[a-zA-Z]{3,8}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('PrenomPersonnel','',array('pattern' =>'^[a-zA-Z]{3,8}$','required'=>'required')).'<BR>';

echo form_label("Telephone : ", 'lbltTel');
echo form_input('TelPersonnel','',array('pattern' =>'^[0-9]{10,10}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('MailPersonnel','',array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';
  
echo form_label("Mot de passe : ", 'lbltMDP');
echo form_password('MdpPersonnel','',array('required'=>'required')).'<BR>';

echo form_label("Employé : ", 'lbltStatutEmployé');
echo form_radio('StatutPersonnel', '0', TRUE);
echo form_label("Administrateur : ", 'lbltStatutAdministrateur');
echo form_radio('StatutPersonnel', '1', FALSE).'<BR>';


echo form_submit('boutonAjouterPersonnel', 'Inscription').'<BR>';
echo form_close();
?>