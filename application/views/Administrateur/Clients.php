<h2><?php echo $TitreDeLaPage ?></h2>
<table class="Liste">
    <tr>
        <th>Actions:</th><th>Nom</th><th>Prénom</th>
    </tr>
    <?php
    foreach ($Clients as $UnClient) {
        echo "<tr>";
        foreach ($UnClient as $key=>$value) 
        {
            if($key=="NOCLIENT")
            {
                echo "<td>".anchor('administrateur/DetailsClient/'.$value, 'Détails du client')."</td>";
            }
            elseif($key=="NOM"||$key=="PRENOM")
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