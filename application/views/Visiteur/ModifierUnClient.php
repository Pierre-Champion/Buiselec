<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('visiteur/ModifierProfil');

echo form_hidden('NoClient', $Client['NOCLIENT']);

echo form_label("Nom : ", 'lbltNom').'<BR>';
echo form_input('NomClient',$Client["NOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{2,24}$','required'=>'required')).'<BR>';

echo form_label("Prenom : ", 'lbltPrenom').'<BR>';
echo form_input('PrenomClient',$Client["PRENOM"],array('pattern' =>'^[A-Z][a-zA-Z \-]{2,24}$','required'=>'required')).'<BR>';

echo form_label("Email : ", 'lbltEmail').'<BR>';
echo form_input('MailClient',$Client["MAIL"],array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required')).'<BR>';

echo form_label("Telephone : ", 'lbltTel').'<BR>';
echo form_input('TelClient',$Client["TELEPHONE"],array('pattern' =>'^([0-9]{10,10}|\+[0-9]{11})$')).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse').'<BR>';
echo form_input('AdresseClient',$Client["ADRESSE"],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP').'<BR>';
echo form_input('CPClient',$Client["CP"],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse').'<BR>';
echo form_input('VilleClient',$Client["VILLE"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Statut du client : ", 'lbltPiece').'<BR>';
?>
<select name="StatutClient" required>
<?php
foreach ($Statuts as $key => $unstatut)
{
    if($unePiece==$Chantier["PIECE"])
    {
        $selection=" selected";
    }
    echo '<option value ="'.$key.'"' .$selection. '>'.$unstatut.'</option>';
}
?>
</select><BR><BR>
<?php
echo form_submit('boutonModificationClient', 'Modifier').'<BR>';
echo form_close();
?>