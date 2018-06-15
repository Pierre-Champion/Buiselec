<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnChantier');

echo form_label("Le chantier à modifier : ", 'lbltNoChantier');
?>
<select name="NoChantier" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($lesChantiers as $unChantier)
{
    echo '<option value ="'.$unChantier['NOCHANTIER'].'">'.$unChantier['NOM'].'</option>';
}
?>
</select><BR>

<?php
echo form_label("La categorie : ", 'lbltNoCategorie');
?>
<select name="NoCategorie" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($lesCategories as $uneCategorie)
{
    echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['NOM'].'</option>';
}
?>
</select><BR>
<?php
echo form_label("Nom du chantier : ", 'lbltNom');
echo form_input('NomChantier','',array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

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
echo form_input('AdresseChantier','',array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP');
echo form_input('CPChantier','',array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse');
echo form_input('VilleChantier','',array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_submit('boutonModification', 'Modifier le Chantier').'<BR>';
echo form_close();
?>