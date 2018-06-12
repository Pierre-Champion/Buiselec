<h2><?php echo $TitreDeLaPage ?></h2>
<table>
    <tr>
        <th>Actions:</th><th>Client</th><th>Nom</th><th>Statut</th>
    </tr>
    <?php
    foreach ($Chantiers as $UnChantier) {
        echo "<tr>";
        foreach ($UnChantier as $key=>$value) 
        {
            if($key=="NOCLIENT")
            {
                echo "<td>".anchor("administrateur/DetailsClient/".$value["NOCLIENT"],$value["NOM"]."&nbsp;".$value["PRENOM"])."</td>";
            }
            elseif($key=="NOCHANTIER") 
            {
                echo "<td>".anchor("administrateur/DetailsChantier/".$value, "Détails du chantier")."</td>";
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
<?php echo "<td>".anchor('administrateur/AjouterUnChantier/', 'Ajouter un chantier (Vous devrez choisir un client)')."</td>"; ?>