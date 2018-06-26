<h2><?php echo $TitreDeLaPage ?></h2>

<table class="Liste">
<tr><td>Nom :</td><td><?php echo $Chantier["NOM"]; ?></td>
<td>Client :</td><td><?php echo anchor("administrateur/DetailsClient/".$Client["NOCLIENT"], $Client["PRENOM"]."&nbsp;".$Client["NOM"]); ?></td></tr>
<tr><td>Catégorie :</td><td><?php echo $Categorie; ?></td>
<td>Type :</td><td><?php if($Chantier["TYPE"]=="0"){ echo "Rénovation"; }elseif($Chantier["TYPE"]=="1"){ echo "Neuf"; } ?></td></tr>
<tr><td>Pièce :</td><td><?php echo $Chantier["PIECE"]; ?></td>
<td>Détails :</td><td><?php echo $Chantier["DETAIL"] ?></td></tr>
<tr><td>Statut :</td><td><?php 
if($Chantier["STATUT"]=="Attente")
{ 
    echo "Ce chantier est en attente d'envoi d'un devis.<br/>"; 
    echo anchor('administrateur/devisenvoye/'.$Chantier['NOCHANTIER'], 'Le devis a été envoyé.')."<br/>";
    echo anchor('administrateur/chantierannule/'.$Chantier['NOCHANTIER'], 'Annuler le chantier');
}
elseif($Chantier["STATUT"]=="Devis")
{ 
    echo "Le devis a été envoyé, en attente de la réponse du client.<br/>";
    echo anchor('administrateur/chantierconfirme/'.$Chantier['NOCHANTIER'], 'Le client a accepté le devis.')."<br/>";
    echo anchor('administrateur/chantierannule/'.$Chantier['NOCHANTIER'], 'Annuler le chantier');
}
elseif($Chantier["STATUT"]=="Confirmé")
{
    echo "Le chantier a été confirmé.";
}
elseif($Chantier["STATUT"]=="Annulé")
{
    echo "Le chantier a été annulé.";
}
elseif($Chantier["STATUT"]=="Commencé")
{
    echo "Le chantier a été commencé.";
}
elseif($Chantier["STATUT"]=="Terminé")
{
    echo "Le chantier a été terminé.";
}
?></td>
<td>Adresse :</td><td><?php echo $Chantier["ADRESSE"].",&nbsp;".$Chantier["CP"].",&nbsp;".$Chantier["VILLE"]; ?></td></tr>
<?php 
if($Chantier["STATUT"]=="Confirmé"||$Chantier["STATUT"]=="Commencé"||$Chantier["STATUT"]=="Terminé")
{
    if($Chantier["DATEDEBUT"]!=null)
    {
    ?>
        <tr><td>Date de début :</td><td><?php echo date('d/m/Y', strtotime($Chantier["DATEDEBUT"])); ?></td>
    <?php
        if($Chantier["DATEFIN"]!=null)
        {
        ?>
            <td>Date de fin :</td><td><?php echo date('d/m/Y', strtotime($Chantier["DATEDEBUT"])); ?></td>
        <?php 
        }
        elseif ($this->session->Profil==2)
        {
            echo '<td>Date de fin :</td><td>'.anchor("administrateur/finchantier/".$Chantier['NOCHANTIER'], "fin du chantier").'</td>';
        }
        echo "</tr>";
    }
    elseif ($this->session->Profil==2)
    {
        echo '<tr><td>Date de début :</td><td>'.anchor("administrateur/debutchantier/".$Chantier['NOCHANTIER'], "Début du chantier").'</td></tr>';
    }
}
if($Chantier["STATUT"]=="Confirmé"||$Chantier["STATUT"]=="Commencé"||$Chantier["STATUT"]=="Terminé")
{
    if($Chantier["IMAGEAVANT"]!=null)
    {
    ?>
        <tr><td>Image avant :</td><td><?php echo img($Chantier["IMAGEAVANT"]); ?></td>
    <?php 
    if($Chantier["IMAGEAPRES"]!=null)
    {
    ?>
        <td>Image après :</td><td><?php echo img($Chantier["IMAGEAPRES"]); ?></td>
    <?php
    }
    elseif ($this->session->Profil==2)
    {
        echo '<td>Image avant :</td><td>'.'<form method="POST" action="'.base_url().'index.php/administrateur/AjouterImageApres/'.$Chantier["NOCHANTIER"].'" enctype="multipart/form-data">
        <!-- On limite le fichier à 100Ko -->';
        //<input type="hidden" name="MAX_FILE_SIZE" value="10000000">';
        if(isset($this->session->Upload))
        {
        switch ($this->session->Upload) 
            {
                case 'Failed':
                echo "<div class='echec'>Echec de l'upload de l'image.</div>";
                    break;
                case 'FlawedType':
                    echo "<div class='echec'>Le type de l'image est incorrect.</div>";
                    break;
                case 'Error':
                    echo "<div class='echec'>Une erreur est survenue!</div>";
                    break;
                default:
                    break;
            }
        }
        echo 'Fichier : <input type="file" name="ImageApres" required>
        <input type="submit" name="boutonModification" value="Envoyer le fichier">
        </form>'.'</td>';
    }
    echo "<br/>";
    }
    elseif ($this->session->Profil==2)
    {
        echo '<tr><td>Image avant :</td><td>'.'<form method="POST" action="'.base_url().'index.php/administrateur/AjouterImageAvant/'.$Chantier["NOCHANTIER"].'" enctype="multipart/form-data">
        <!-- On limite le fichier à 100Ko -->';
        //<input type="hidden" name="MAX_FILE_SIZE" value="10000000">';
        if(isset($this->session->Upload))
        {
            switch ($this->session->Upload) {
                case 'Failed':
                    echo "<div class='echec'>Echec de l'upload de l'image.</div>";
                    break;
                case 'FlawedType':
                    echo "<div class='echec'>Le type de l'image est incorrect.</div>";
                    break;
                case 'Error':
                    echo "<div class='echec'>Une erreur est survenue!</div>";
                    break;
                default:
                    break;
        }
        }
        echo 'Fichier : <input type="file" name="ImageAvant" required>
        <input type="submit" name="boutonModification" value="Envoyer le fichier">
        </form>'.'</td></tr>';
    }
    $this->session->Upload="";
}
?>
<tr><td>Profil :</td><td><?php if($Chantier["ACCORD"]==0){ echo "Privé"; }elseif($Chantier["ACCORD"]==1){ echo "Public"; } ?></td></tr>
</table>
<?php
if ($this->session->Profil==2)
{
echo anchor('administrateur/ModifierUnChantier/'.$Chantier["NOCHANTIER"], 'Modifier le chantier'); 
}
?>