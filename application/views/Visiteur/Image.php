<h2><?php echo  $TitreDeLaPage ?></h2>
<table class="AvantApres">
    <tr>
        <th>Avant</th><th>Après</th>
    </tr>
    <?php
        foreach ($Chantiers as $unChantier) 
        {
            if($unChantier['IMAGEAVANT'] && $unChantier['IMAGEAPRES'])
            {
                echo '<tr>
                    <td>'.img($unChantier['IMAGEAVANT']).'</td><td>'.img($unChantier['IMAGEAPRES']).'</td>
                    </tr>';
            }
        }
    ?>