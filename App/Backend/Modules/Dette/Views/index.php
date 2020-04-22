<p>Il y a actuellement <?= $nombreDettes ?> Dettes. En voici la liste :</p>

<table>
    <caption><?= $title; ?></caption>
    <thead>
        <tr>
            <th>Nom et prenom</th>
            <th>Date d'emprunt</th>
            <th>Somme</th>
            <th>Durée</th>
            <th>Somme à payée</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listeDettes as $liste): ?>
        <tr>
            <td>
                <?= $liste['nom'].' '.$liste['prenom']; ?>
            </td>
            <td>
                <?php $date = new DateTime($liste['date']); ?>
                <time><?= $date->format('d/m/Y à H:i:s'); ?></time>
            </td>
            <td><?= $liste['reste']; ?></td>
            <td><?= $liste['duree']; ?></td>
            <td><?= $liste['somme']; ?></td>
            <td>
                <a href="dette-update-<?= $liste['id']; ?>.html"><img src="/images/update.png" alt="Modifier" /></a>
                <a href="dette-delete-<?= $liste['id']; ?>.html"><img src="/images/delete.png" alt="Supprimer" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>