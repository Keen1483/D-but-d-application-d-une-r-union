<p>Il y a actuellement <?= $nombreMembre ?> membres. En voici la liste :</p>
 
<table>
  <tr><th>Nom</th><th>Prenom</th><th>Téléphone</th><th>Date d'inscription</th><th>Dernière modification</th><th>Action</th></tr>
<?php
foreach ($listeMembre as $membre)
{
  echo '<tr><td>', $membre['nom'], '</td><td>', $membre['prenom'], '</td><td>', $membre['telephone'], '</td><td>le ', $membre['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($membre['dateAjout'] == $membre['dateModif'] ? '-' : 'le '.$membre['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="membre-update-', $membre['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="membre-delete-', $membre['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>