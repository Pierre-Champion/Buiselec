<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnPersonnel');

echo form_hidden('NoPersonnel', $Personnel['NOPERSONNEL']);

echo form_label("Nom : ", 'lbltNom');
echo form_input('NomPersonnel',$Personnel["NOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('PrenomPersonnel',$Personnel["PRENOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('MailPersonnel',$Personnel["MAIL"],array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';

echo form_label("Telephone : ", 'lbltTel');
echo form_input('TelPersonnel',$Personnel["TELEPHONE"],array('pattern' =>'^[0-9]{10,10}$','required'=>'required')).'<BR>';
  
echo form_label("Mot de passe : ", 'lbltMDP');
echo form_password('MdpPersonnel',$Personnel["MDP"],array('required'=>'required')).'<BR>';

echo form_label("Employé : ", 'lbltStatutEmployé');
echo form_radio('StatutPersonnel', '1', TRUE);
echo form_label("Administrateur : ", 'lbltStatutAdministrateur');
echo form_radio('StatutPersonnel', '2', FALSE).'<BR>';


echo form_submit('boutonModificationPersonnel', 'Modifier le personnel').'<BR>';
echo form_close();
?>