<h2><?php echo  $this->session->TitreDeLaPage ?></h2>
<form method="POST" action="<?=base_url();?>index.php/visiteur/upload" enctype="multipart/form-data">
     <!-- On limite le fichier à 100Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
     Fichier : <input type="file" name="avatar">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>