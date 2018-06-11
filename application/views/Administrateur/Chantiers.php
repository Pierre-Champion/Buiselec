<h2><?php echo $TitreDeLaPage ?></h2>
<table>
    <tr>
        <th>Actions:</th><th>Client</th><th>Catégorie</th><th>Nom</th><th>Type</th><th>Pièce</th><th>Détails</th><th>Adresse</th><th>Code postal</th><th>Ville</th><th>Date de début</th><th>Dade de fin</th><th>Image avant</th><th>Image après</th><th>Statut</th><th>Profil</th>
    </tr>
    <?php
    foreach ($Personnel as $UnPersonnel) {
        echo "<tr>";
        foreach ($UnPersonnel as $key=>$value) 
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
            /*elseif($key=="NOCLIENT")
            {
                
            }*/
            elseif($key!="MDP")
            {
                echo "<td>".$value."</td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
<br/>