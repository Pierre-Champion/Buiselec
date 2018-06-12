<h2><?php echo $TitreDeLaPage ?></h2>
<table>
    <tr>
        <th>Actions:</th><th>Client</th><th>Catégorie</th><th>Nom</th><th>Type</th><th>Pièce</th><th>Détails</th><th>Adresse</th><th>Code postal</th><th>Ville</th><th>Date de début</th><th>Dade de fin</th><th>Image avant</th><th>Image après</th><th>Statut</th><th>Profil</th>
    </tr>
    <?php
    foreach ($Chantiers as $UnChantier) {
        echo "<tr>";
        foreach ($UnChantier as $key=>$value) 
        {
            if($key=="ACCORD")
            {
                if($value=="1")
                {
                    echo "<td>Public</td>";
                }
                elseif($value=="0")
                {
                    echo "<td>Privé</td>";
                }
            }
            elseif($key=="NOCLIENT")
            {
                echo "<td>".anchor("administrateur/DetailsClient/".$value["NOCLIENT"],$value["NOM"]."&nbsp;".$value["PRENOM"])."</td>";
            }
            elseif($key!="MDP")
            {
                echo "<td>".$value."</td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
<?php echo "<td>".anchor('administrateur/AjouterUnChantier/', 'Ajouter un chantier (Vous devrez choisir un client)')."</td>"; ?>