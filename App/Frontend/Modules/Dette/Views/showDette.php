<?php echo '<h1>'. $title .'</h1>'; ?>

<h2><?= $membre['nom'].' '.$membre['prenom']; ?></h2>
<table>
    <caption>Tableau des dettes du membre</caption>
    <thead>
        <tr>
            <th>Date d'emprunt</th>
            <th>Somme</th>
            <th>Durée</th>
            <th>Somme à payée</th>
            <th>Temps restant</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($dettes as $liste): ?>
        <tr>
            <td>
                <?php $date = new DateTime($liste['date']); ?>
                <time><?= $date->format('d/m/Y à H:i:s'); ?></time>
            </td>
            <td><?= $liste['reste']; ?></td>
            <td><?= $liste['duree']; ?></td>
            <td><?= $liste['somme']; ?></td>
            <td><?= $liste['tempsRestant']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>