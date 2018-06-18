<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnChantier/'.$Chantier['NOCHANTIER']);

echo form_hidden('NoChantier', $Chantier['NOCHANTIER']);

echo form_label("La categorie : ", 'lbltNoCategorie');
?>
<select name="NoCategorie" required>
<?php
foreach ($lesCategories as $uneCategorie)
{
    if($Chantier['NOCATEGORIE']==$uneCategorie['NOCATEGORIE'])
    {
        echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'" selected>'.$uneCategorie['NOM'].'</option>';
    }
    else
    {
        echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['NOM'].'</option>';
    }
}
?>
</select><BR>
<?php
echo form_label("Nom du chantier : ", 'lbltNom');
echo form_input('NomChantier',$Chantier['NOM'],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

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
echo form_textarea('DetailsChantier',$Chantier['DETAIL']).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse');
echo form_input('AdresseChantier',$Chantier['ADRESSE'],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP');
echo form_input('CPChantier',$Chantier['CP'],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse');
echo form_input('VilleChantier',$Chantier['VILLE'],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_submit('boutonModification', 'Modifier le Chantier').'<BR>';
echo form_close();
?>