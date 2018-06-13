<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if(isset($Chantiers) && $Chantiers!=null)
{
?>
<table class="Liste">
    <tr>
        <th>Actions:</th><th>Nom</th><th>Statut</th>
    </tr>
    <?php
    foreach ($Chantiers as $UnChantier) {
        echo "<tr>";
        foreach ($UnChantier as $key=>$value) 
        {
            if($key=="NOCHANTIER") 
            {
                echo "<td>".anchor("visiteur/DetailsChantier/".$value, "Détails du chantier")."</td>";
            }
            elseif($key=="NOM"||$key=="STATUT")
            {
                echo "<td>".$value."</td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
<?php
}
else
{
    echo "Vous n'avez aucun chantier pour l'instant.<br/>";
}
?>
<?php echo "<td>".anchor('visiteur/CreerChantier', 'Ajouter un chantier')."</td>"; ?>