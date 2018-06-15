<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnPersonnel');
echo form_label("Le personnel à modifier : ", 'lbltNoPersonnel');
?>
<select name="NoPersonnel" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($LesPersonnels as $unPersonnel)
{
    echo '<option value ="'.$unPersonnel['NOPERSONNEL'].'">'.$unPersonnel['NOM'].' '.$unPersonnel['PRENOM'].'</option>';
}
?>
</select><BR>

<?php
echo form_label("Nom : ", 'lbltNom');
echo form_input('NomPersonnel','',array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('PrenomPersonnel','',array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('MailPersonnel','',array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';

echo form_label("Telephone : ", 'lbltTel');
echo form_input('TelPersonnel','',array('pattern' =>'^[0-9]{10,10}$','required'=>'required')).'<BR>';
  
echo form_label("Mot de passe : ", 'lbltMDP');
echo form_password('MdpPersonnel','',array('required'=>'required')).'<BR>';

echo form_label("Employé : ", 'lbltStatutEmployé');
echo form_radio('StatutPersonnel', '1', TRUE);
echo form_label("Administrateur : ", 'lbltStatutAdministrateur');
echo form_radio('StatutPersonnel', '2', FALSE).'<BR>';


echo form_submit('boutonModificationPersonnel', 'Modifier le personnel').'<BR>';
echo form_close();
?>