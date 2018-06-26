<?php echo form_open('Administrateur/ResultatRechercher'); ?>
                  <li><input type="text" placeholder="Recherche.." name="recherche">
                  <button type="submit">Rechercher</button></li>
               <?php echo form_close();?>
<?php if(isset($Champ)&& $Champ=="Vide")
{
    echo "Veuillez remplir le champ.<br/>";
}
elseif($Search)
{
?>
<table class="Liste">

<tr><th><h2><?php echo $TitreDeLaPage ?></h2></th><th>Statut</th></tr>


<?php 
foreach ($Search as $key => $UnChantier) 
{
    echo "<tr><td>".anchor('administrateur/DetailsChantier/'.$UnChantier["NOCHANTIER"], '"'.$UnChantier["NOM"].'"')."</td>
    <td>".$UnChantier["STATUT"]."</td></tr>";
}
?>
</table>
<?php
}
else
{
    echo "La recherche n'a apporté aucun résultat.<br/>";
}
?>
<?php echo "<td>".anchor('administrateur/AjouterUnChantier/', 'Ajouter un chantier (Vous devrez choisir un client)')."</td>"; ?>