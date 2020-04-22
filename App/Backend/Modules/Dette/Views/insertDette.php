<div id="borrow">
  <h2>Enregistrement d'une dette</h2>

  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
      Membres illigibles pour un prêt.
    </button>
    <div class="dropdown-menu">
      <?php foreach($listeMembre as $membre): ?>
          <a class="dropdown-item" href="?nom=<?= $membre['nom']; ?>&amp;prenom=<?= $membre['prenom']; ?>">
            <?= $membre['nom'].' '.$membre['prenom']; ?></a>
          <div class="dropdown-divider"></div>
      <?php endforeach; ?>
    </div>
  </div>

  <form id="form" action="" method="post" enctype="multipart/form-data">
      <p>
          <fieldset>
          <legend>Somme à empruntée</legend>

          <input type="text" name="nom" hidden>
          <input type="text" name="prenom" hidden>
          <?= $form ?>

          <br><br>
          <input type="reset" name="reset" id="reset" value="Réinitialier">
          <input type="submit" value="Valider">
          </fieldset>
      </p>
  </form>
</div>

<?php if(! empty($data))
{
    foreach($data as $key => $value): ?>
    <h2><?= ucfirst($key).': '.$value; ?></h2>
    <?php endforeach; ?>
    <p><strong>La dette été bien ajouter</strong></p>
<?php
}