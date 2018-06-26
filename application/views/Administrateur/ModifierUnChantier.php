<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/ModifierUnChantier/'.$Chantier['NOCHANTIER']);

echo form_hidden('NoChantier', $Chantier['NOCHANTIER']);

echo form_label("Categorie : ", 'lbltNoCategorie').'<BR>';
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
echo form_label("Nom du chantier : ", 'lbltNom').'<BR>';
echo form_input('NomChantier',$Chantier['NOM'],array('pattern' =>'^[A-Z][a-zA-Z, \-]{2,24}$','required'=>'required')).'<BR>';

echo form_label("Type de chantier : ", 'lbltType').'<BR>';
if($Chantier['TYPE']=="0")
{
    $renov="checked";
    $neuf="";
}
elseif ($Chantier['TYPE']=="1") {
    $renov="";
    $neuf="checked";
}
echo form_radio('TypeChantier',"0", $renov).'Renovation<BR>';
echo form_radio('TypeChantier',"1", $neuf).'Neuf<BR>';

echo form_label("Pièce : ", 'lbltPiece').'<BR>';
?>
<select name="PieceChantier" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Pieces as $unePiece)
{
    if($unePiece==$Chantier["PIECE"])
    {
        $selection=" selected";
    }
    echo '<option value ="'.$unePiece.'"' .$selection. '>'.$unePiece.'</option>';
}
?>
</select><BR>

<?php
echo form_label("Détails du chantier : ", 'lbltChantier').'<BR>';
echo form_textarea('DetailsChantier',$Chantier['DETAIL']).'<BR>';

echo form_label("Adresse : ", 'lbltAdresse').'<BR>';
echo form_input('AdresseChantier',$Chantier['ADRESSE'],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP').'<BR>';
echo form_input('CPChantier',$Chantier['CP'],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse').'<BR>';
echo form_input('VilleChantier',$Chantier['VILLE'],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

if($Chantier['ACCORD']=="0")
{
    $oui="";
    $non="checked";
}
else
{
    $oui="checked";
    $non="";
}
echo form_label("Profil : ", 'lbltAccord').'<BR>';
echo form_radio('AccordImage',"0", $non).'Privé<BR>';
echo form_radio('AccordImage',"1", $oui).'Public<BR>';

echo form_submit('boutonModification', 'Modifier le Chantier').'<BR>';
echo form_close();
?>