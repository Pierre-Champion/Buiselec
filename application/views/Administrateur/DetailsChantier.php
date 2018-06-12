<h2><?php echo $TitreDeLaPage ?></h2>

<table>
<tr><td>Nom :</td><td><?php echo $Chantier["NOM"]; ?></td></tr>
<tr><td>Client :</td><td><?php echo $Client["PRENOM"]."&nbsp;".$Client["NOM"]; ?></td></tr>
<tr><td>Catégorie :</td><td><?php echo $Categorie; ?></td></tr>
<tr><td>Type :</td><td><?php if($Chantier["TYPE"]=="0"){ echo "Rénovation"; }elseif($Chantier["TYPE"]=="1"){ echo "Neuf"; } ?></td></tr>
<tr><td>Pièce :</td><td><?php echo $Chantier["PIECE"]; ?></td></tr>
<tr><td>Détails :</td><td><?php echo $Chantier["DETAIL"] ?></td></tr>
<tr><td>Statut :</td><td><?php if($Chantier["STATUT"]=="Attente"){ echo "Ce dossier est en attente d'envoi d'un devis."; }elseif($Chantier["STATUT"]=="Devis"){ echo "Le devis a été envoyé, en attente de la réponse du client."; }elseif($Chantier["STATUT"]=="Confirmé"){ echo "Le chantier a été confirmé."; } ?></td></tr>
<tr><td>Adresse :</td><td><?php echo $Chantier["ADRESSE"]."&nbsp;".$Chantier["CP"]."&nbsp;".$Chantier["VILLE"]; ?></td></tr>
<tr><td>Pièce :</td><td><?php echo $Chantier["PIECE"]; ?></td></tr>
<tr><td>Date de début :</td><td><?php echo $Chantier["DATEDEBUT"]; ?></td></tr>
<tr><td>Date de fin :</td><td><?php echo $Chantier["DATEFIN"]; ?></td></tr>
<tr><td>Image avant :</td><td><?php echo img($Chantier["IMAGEAVANT"]); ?></td></tr>
<tr><td>Image après :</td><td><?php echo img($Chantier["IMAGEAPRES"]); ?></td></tr>
</table>