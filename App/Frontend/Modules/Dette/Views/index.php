<?php echo '<h1>'. $title .'</h1>'; ?>

<table>
    <caption>Tableau de toutes les dettes actuelles</caption>
    <thead>
        <tr>
            <th>Nom et prenom</th>
            <th>Date d'emprunt</th>
            <th>Somme</th>
            <th>Durée</th>
            <th>Somme à payée</th>
            <th>ID</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Nom et prenom</th>
            <th>Date d'emprunt</th>
            <th>Somme</th>
            <th>Durée</th>
            <th>Somme à payée</th>
            <th>ID</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach($listeDettes as $liste): ?>
        <tr>
            <td><a href="dette-<?= $liste['id'] ?>.html"><?= $liste['nom'].' '.$liste['prenom']; ?></a></td>
            <td>
                <?php $date = new DateTime($liste['date']); ?>
                <time><?= $date->format('d/m/Y à H:i:s'); ?></time>
            </td>
            <td><?= $liste['reste']; ?></td>
            <td><?= $liste['duree']; ?></td>
            <td><?= $liste['somme']; ?></td>
            <td><?= $liste['id']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
