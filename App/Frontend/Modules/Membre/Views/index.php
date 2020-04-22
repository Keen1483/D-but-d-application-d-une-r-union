<?php echo '<h1>'. $title .'</h1>';
foreach($listeMembre as $membre): ?>
    <h2><a href="membre-<?= $membre['id'] ?>.html"><?= $membre['nom'].' '.$membre['prenom']; ?></a></h2>
    <time><em><?= 'Inscrit le '. $membre['dateAjout']->format('d/m/Y à H:i:s'); ?></em></time> <br>
<?php endforeach; ?>