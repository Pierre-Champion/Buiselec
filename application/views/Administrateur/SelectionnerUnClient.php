<h2><?php echo $TitreDeLaPage ?></h2>

<?php
echo form_open('Administrateur/SelectionnerUnClient');
echo form_label("Client concerné : ", 'lbltClient');
?>
<select name="ClientSelectionner" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Clients as $unClient)
{
    echo '<option value ="'.$unClient['NOCLIENT'].'">'.$unClient['PRENOM']."&nbsp;".$unClient['NOM'].'</option>';
}
?>
</select><BR>
<?php
echo form_submit('boutonSelectionClient', 'Suivant').'<BR>';
echo form_close();
?>