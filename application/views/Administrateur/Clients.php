<h2><?php echo $TitreDeLaPage ?></h2>
<table>
    <tr>
        <th>Actions:</th><th>Nom</th><th>Prénom</th><th>Adresse mail</th><th>N° de téléphone</th><th>Adresse</th><th>Code postal</th><th>Ville</th><th>Statut</th>
    </tr>
    <?php
    foreach ($Clients as $UnClient) {
        echo "<tr>";
        foreach ($UnClient as $key=>$value) 
        {
            if($key=="STATUT")
            {
                if($value=="1")
                {
                    echo "<td>Propriétaire</td>";
                }
                else
                {
                    echo "<td>Locataire</td>";
                }
            }
            elseif($key=="NOCLIENT")
            {
                echo "<td>".anchor('administrateur/AjouterUnChantier/'.$value, 'Ajouter un chantier')."</td>";
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
<br/>

<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/AjouterUnClient') ?>">Ajouter un client</a>