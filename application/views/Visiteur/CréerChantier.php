<h2><?php echo $TitreDeLaPage ?></h2>



<?php
echo form_open('visiteur/CreerChantier');
echo form_hidden('Noclient', $this->session->Client['NOCLIENT']);

echo form_label("Catégorie : ", 'lbltCategorie');
?>
<select name="CategorieChantier" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text" required>
<option value="" selected>Selectionner</option>
<?php
foreach ($Categories as $uneCategorie)
{
    echo '<option value ="'.$uneCategorie['NOCATEGORIE'].'">'.$uneCategorie['NOM'].'</option>';
}
?>
</select>
<input type="hidden" name="selected_text" id="selected_text" value="" /><BR>

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
echo form_input('AdresseClient',$this->session->Client["ADRESSE"],array('required'=>'required')).'<BR>';

echo form_label("Code Postale : ", 'lbltCP');
echo form_input('CPClient',$this->session->Client["CP"],array('pattern' =>'^[0-9]{5,5}$','required'=>'required')).'<BR>';

echo form_label("Ville : ", 'lbltAdresse');
echo form_input('VilleClient',$this->session->Client["VILLE"],array('pattern' =>'^[A-Z][a-zA-Z \-]{3,24}$','required'=>'required')).'<BR>';

echo form_label("Êtes vous d'accord pour afficher les images de votre chantier sur la page principale et la galerie?", 'lbltAccord').'<BR>';
echo form_radio('AccordImage',"0", 'checked').'Non<BR>';
echo form_radio('AccordImage',"1", '').'Oui<BR>';


echo form_submit('boutonAjouterChantier', 'Ajouter Un chantier').'<BR>';
echo form_close();
?>