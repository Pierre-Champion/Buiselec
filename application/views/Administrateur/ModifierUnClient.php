<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnClient');

echo form_hidden('NoClient', $Client['NOCLIENT']);

echo form_label("Nom : ", 'lbltNom');
echo form_input('NomClient',$Client["PRENOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom');
echo form_input('PrenomClient',$Client["NOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail');
echo form_input('MailClient',$Client["MAIL"],array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';

echo form_label("Telephone : ", 'lbltTel');
echo form_input('TelClient',$Client["TELEPHONE"],array('pattern' =>'^([0-9]{10,10}|\+[0-9]{11})$')).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse');
echo form_input('AdresseClient',$Client["ADRESSE"],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP');
echo form_input('CPClient',$Client["CP"],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse');
echo form_input('VilleClient',$Client["VILLE"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Statut du client : ", 'lbltPiece');
?>
<select name="StatutClient" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Statuts as $key => $unstatut)
{
    echo '<option value ="'.$key.'">'.$unstatut.'</option>';
}
?>
</select><BR>
<?php
echo form_submit('boutonModificationClient', 'Modifier le client').'<BR>';
echo form_close();
?>