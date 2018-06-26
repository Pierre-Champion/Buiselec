<h2><?php echo $TitreDeLaPage ?></h2>

<table class="Liste">
<tr><td>Nom :</td><td><?php echo $Client["NOM"]; ?></td><td>Prénom :</td><td><?php echo $Client["PRENOM"]; ?></td></tr>
<tr><td>Mail :</td><td><?php echo $Client["MAIL"]; ?></td><td>N° de téléphone :</td><td><?php echo $Client["TELEPHONE"]; ?></td></tr>
<tr><td>Adresse :</td><td><?php echo $Client["ADRESSE"].",&nbsp;".$Client["CP"].",&nbsp;".$Client["VILLE"]; ?></td><td>Statut :</td><td><?php if($Client["STATUT"]==0){ echo "Locataire"; } elseif($Client["STATUT"]==1) { echo "Propriétaire"; } ?></td></tr>
</table>

<?php
echo anchor('visiteur/ModifierProfil/'.$Client["NOCLIENT"], 'Modifier mon profil')."<br/>";
echo anchor('visiteur/ModifierMDP/'.$Client["NOCLIENT"], 'Modifier mon mot de passe');
if($this->session->Modif=="Reussie")
{
    echo "<h5 style='color: green'>Modification effectuée avec succès.</h5>";
}
$this->session->Modif=null;
?>
