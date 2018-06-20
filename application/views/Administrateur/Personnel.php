<h2><?php echo $TitreDeLaPage ?></h2>
<table class="Liste">
    <tr>
        <th>Actions:</th><th>Nom</th><th>Prénom</th><th>Statut</th>
    </tr>
    <?php
    foreach ($Personnel as $UnPersonnel) {
        echo "<tr>";
        foreach ($UnPersonnel as $key=>$value) 
        {
            if($key=="STATUT")
            {
                if($value=="1")
                {
                    echo "<td>Employé</td>";
                }
                elseif($value=="2")
                {
                    echo "<td>Administrateur</td>";
                }
            }
            elseif($key=="NOPERSONNEL")
            {
                echo "<td>".anchor('administrateur/DetailsPersonnel/'.$value, 'Détails du Personnel')."</td>";
            }
            elseif($key=="NOM" || $key=="PRENOM")
            {
                echo "<td>".$value."</td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
<br/>

<a class="Buiselec-Button" href="<?php echo site_url('Administrateur/AjouterPersonnel') ?>">Ajouter un personnel</a>