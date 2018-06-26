
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

<?php echo "<td>".anchor('administrateur/AjouterUnChantier/', 'Ajouter un chantier (Vous devrez choisir un client)')."</td>"; ?>