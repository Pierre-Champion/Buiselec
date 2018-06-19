<h2><?php echo $TitreDeLaPage ?></h2>

<table>
<tr><td>Nom :</td><td><?php echo $Personnel["NOM"]; ?></td></tr>
<tr><td>Prénom :</td><td><?php echo $Personnel["PRENOM"]; ?></td></tr>
<tr><td>Mail :</td><td><?php echo $Personnel["MAIL"]; ?></td></tr>
<tr><td>N° de téléphone :</td><td><?php echo $Personnel["TELEPHONE"]; ?></td></tr>
<tr><td>Statut :</td><td><?php if($Personnel["STATUT"]==1){ echo "Employé"; } elseif($Personnel["STATUT"]==2) { echo "Administrateur"; } ?></td></tr>
</table>
<br/>
<table class="Liste">
<tr><th>Chantiers du Personnel</th></tr>
<?php 
foreach ($Chantiers as $key => $UnChantier) 
{
    echo "<tr><td>".anchor('administrateur/DetailsChantier/'.$UnChantier["NOCHANTIER"], '"'.$UnChantier["NOM"].'"')."</td></tr>";
}
?>
</table>
<?php echo anchor('administrateur/ModifierUnPersonnel/'.$Personnel["NOPERSONNEL"], 'Modifier le Personnel'); ?>