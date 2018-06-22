<h2><?php echo $TitreDeLaPage ?></h2>

<table class="Liste">
<tr><td>Nom :</td><td><?php echo $Client["NOM"]; ?></td></tr>
<tr><td>Prénom :</td><td><?php echo $Client["PRENOM"]; ?></td></tr>
<tr><td>Mail :</td><td><?php echo $Client["MAIL"]; ?></td></tr>
<tr><td>N° de téléphone :</td><td><?php echo $Client["TELEPHONE"]; ?></td></tr>
<tr><td>Adresse :</td><td><?php echo $Client["ADRESSE"].",&nbsp;".$Client["CP"].",&nbsp;".$Client["VILLE"]; ?></td></tr>
<tr><td>Statut :</td><td><?php if($Client["STATUT"]==0){ echo "Locataire"; } elseif($Client["STATUT"]==1) { echo "Propriétaire"; } ?></td></tr>
</table>
<br/>
<table class="Liste">
<tr><th>Chantiers du client</th></tr>
<?php 
foreach ($Chantiers as $key => $UnChantier) 
{
    echo "<tr><td>".anchor('administrateur/DetailsChantier/'.$UnChantier["NOCHANTIER"], '"'.$UnChantier["NOM"].'"')."</td></tr>";
}
?>
</table>
<?php echo anchor('administrateur/AjouterUnChantier/'.$Client["NOCLIENT"], 'Ajouter un chantier'); ?><BR/>
<?php echo anchor('administrateur/ModifierUnClient/'.$Client["NOCLIENT"], 'Modifier le client'); ?>
