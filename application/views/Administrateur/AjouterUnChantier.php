<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/AjouterUnChantier');

echo form_label("Nom du chantier : ", 'lbltNom');
echo form_input('NomChantier','',array('pattern' =>'^[a-zA-Z]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Client concerné : ", 'lbltCategorie');
?>
<select name="ClientConcerne" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Clients as $unClient)
{
    echo '<option value ="'.$uneClient['NOCLIENT'].'">'.$unClient['PRENOM']."&nbsp;".$unClient['NOM'].'</option>';
}
?>
</select><BR>
<?php

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
<?php
echo form_label("Type de chantier : ", 'lbltType');
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
echo form_label("Détails du chantier : ", 'lbltChantier');
echo form_input('DetailsChantier','').'<BR>';

echo form_submit('boutonAjouterChantier', 'Inscription').'<BR>';
echo form_close();
?>