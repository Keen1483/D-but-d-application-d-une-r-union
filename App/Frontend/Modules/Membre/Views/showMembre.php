<h1><?= $title ?></h1>

<p style="text-align: right;"><small><em>Inscrit le <?= $membre['dateAjout']->format('d/m/Y à H\hi') ?></em></small></p>
 
<?php if ($membre['dateAjout'] != $membre['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $membre['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>