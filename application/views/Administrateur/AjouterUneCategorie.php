<h2><?php echo $TitreDeLaPage ?></h2>

<?php echo validation_errors();
echo form_open('Administrateur/AjouterUneCategorie') ?>

<label for="NomCategorie">Catégorie: </label>
<input type="input" name="NomCategorie" value="<?php echo set_value('NomCategorie'); ?>"/><br/>

<input type="submit" name="submit" value="Ajouter une Catégorie" />
</form>