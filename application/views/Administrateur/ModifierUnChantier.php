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
    echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['LIBELLE'].'</option>';
}
?>
</select><BR>


<?php
echo form_submit('boutonModification', 'Modifier un Chantier').'<BR>';
echo form_close();
?>