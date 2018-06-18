<form method="POST" action="<?=base_url();?>index.php/administrateur/AjouterImageAvant" enctype="multipart/form-data">
     <!-- On limite le fichier à 100Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
     <?php if(isset($Upload) && $Upload=="Failed")
     {
        echo "Echec de l'upload de l'image. Veuillez vérifier le type du fichier.";
     }
     ?>
     Fichier : <input type="file" name="ImageAvant">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>