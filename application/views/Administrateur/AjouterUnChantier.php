<h2><?php echo $TitreDeLaPage ?></h2>



<?php
echo form_open('Administrateur/AjouterUnChantier');
echo 
form_hidden('Noclient', $Client['NOCLIENT']);


echo form_label("Nom du chantier : ", 'lbltNom');
echo form_input('NomChantier','',array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Catégorie : ", 'lbltCategorie');
?>
<select name="CategorieChantier" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Categories as $uneCategorie)
{
    echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['NOM'].'</option>';
}
?>
</select><BR>

<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/AjouterUneCategorie') ?>">Ajouter une catégorie</a>
<?php
echo form_label("Type de chantier : ", 'lbltType').'<BR>';
echo form_radio('TypeChantier',"0", 'checked').'Renovation<BR>';
echo form_radio('TypeChantier',"1", '').'Neuf<BR>';

echo form_label("Pièce : ", 'lbltPiece');
?>
<select name="PieceChantier" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Pieces as $unePiece)
{
    echo '<option value ="'.$unePiece.'">'.$unePiece.'</option>';
}
?>
</select><BR>

<?php
echo form_label("Détails du chantier : ", 'lbltChantier').'<BR>';
echo form_textarea('DetailsChantier','').'<BR>';

echo form_label("Adresse : ", 'lbltAdresse');
echo form_input('AdresseClient',$Client["ADRESSE"],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP');
echo form_input('CPClient',$Client["CP"],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse');
echo form_input('VilleClient',$Client["VILLE"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';


echo form_submit('boutonAjouterChantier', 'Ajouter Un chantier').'<BR>';
echo form_close();
?>