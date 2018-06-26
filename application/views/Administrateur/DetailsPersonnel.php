<h2><?php echo $TitreDeLaPage ?></h2>

<table class="Liste">
<tr><td>Nom :</td><td><?php echo $Personnel["NOM"]; ?></td>
<td>Prénom :</td><td><?php echo $Personnel["PRENOM"]; ?></td></tr>
<tr><td>Mail :</td><td><?php echo $Personnel["MAIL"]; ?></td>
<td>N° de téléphone :</td><td><?php echo $Personnel["TELEPHONE"]; ?></td></tr>
<tr><td>Statut :</td><td><?php if($Personnel["STATUT"]==1){ echo "Employé"; } elseif($Personnel["STATUT"]==2) { echo "Administrateur"; } ?></td></tr>
</table>
<br/>
<table class="Liste">
<tr><th colspan="3">Chantiers du Personnel</th></tr>
<?php 
$i=0;
foreach ($Chantiers as $UnChantier) 
{
    echo "<tr><td>".anchor('administrateur/DetailsChantier/'.$UnChantier["NOCHANTIER"], '"'.$UnChantier["NOM"].'"')."</td><td>".intval($UnChantier["HORAIRE"])."h<br/><br/>";
    if ($this->session->Profil==2) echo '<div id="Ajouter'.$i.'" onclick="document.getElementById(\'Temps'.$i.'\').style.display=\'block\'; document.getElementById(\'Ajouter'.$i.'\').style.display=\'none\'">Ajouter</div>';
    echo "<div id='Temps".$i."' class='AjouterTemps'>".
    form_open('administrateur/ajoutertemps/'.$Personnel["NOPERSONNEL"].'/'.$UnChantier["NOCHANTIER"]).
    form_label('Nombre d\'heures', 'lblHeures')."<br/>".
    '<input type="number" name="Heures" min="0">'.
    form_submit('Submit', 'Ajouter').
    form_close().
    '<div onclick="document.getElementById(\'Temps'.$i.'\').style.display=\'none\'; document.getElementById(\'Ajouter'.$i.'\').style.display=\'block\'">Annuler</div></div>'."</td><td>".$UnChantier["STATUT"]."</td></tr>";
    $i+=1;
}
?>
</table>
<?php
if ($this->session->Profil==2)
{
    echo anchor('administrateur/ModifierUnPersonnel/'.$Personnel["NOPERSONNEL"], 'Modifier le Personnel')."<br/>";
}
elseif ($this->session->Profil==1)
{
    echo anchor('administrateur/ModifierUnPersonnel/'.$Personnel["NOPERSONNEL"], 'Modifier mon profil')."<br/>";
}
if ($this->session->Profil==2)
{
    echo anchor('administrateur/AssignerChantier/'.$Personnel["NOPERSONNEL"], 'Assigner un chantier');
}
?>