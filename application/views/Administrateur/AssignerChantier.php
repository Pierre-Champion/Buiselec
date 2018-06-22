<table class="Liste">
    <tr>
        <th>Nom</th><th>Statut</th>
    </tr>
    <?php
    foreach ($Chantiers as $UnChantier) {
        echo "<tr>";
        echo '<td>'.anchor('administrateur/assignerchantier/'.$NoPersonnel.'/'.$UnChantier["NOCHANTIER"], '"'.$UnChantier["NOM"].'"').'</td>';
        echo '<td>'.$UnChantier['STATUT'].'</td>';
        echo "</tr>";
    }
    ?>
</table>