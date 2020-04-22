<?php
namespace Model;

use \KeenFram\Manager;
use \Entity\Caisses;

abstract class CaissesManager extends Manager
{
    /**
   * Méthode permettant d'approvisionner une caisse.
   * @param $caisse Caisses l'apprivisionnement
   * @return void
   */
  abstract protected function add(Caisses $caisses);

    /**
   * Méthode permettant d'enregistrer un approvisionnement.
   * @param $caisses Caisses l'approvisionnement à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Caisses $caisses)
  {
    if ($caisses->isValid())
    {
      $caisses->isNew() ? $this->add($caisses) : $this->modify($caisses);
    }
    else
    {
      throw new \RuntimeException('La somme doit être validée pour être enregistrée');
    }
  }

  /**
   * Méthode permettant de modifier un approvisionnement.
   * @param $caisses Caisses l'approvisionnement à modifier
   * @return void
   */
  abstract protected function modify(Caisses $caisses);

  /**
   * Méthode sauvegardant les identifiants des totaux
   * @return void
   */
  abstract protected function addTotal();

  /**
   * Méthode permettant de modifier les indentifiants des totaux
   * @return void
   */
  abstract protected function modifyTotal();

  /**
   * Méthode renvoyant le nombre d'approvisionnement total.
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer un approvisionnement.
   * @param $id int L'identifiant de l'approvisionnement à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode retournant une liste des approvisionnements demandés.
   * @param $debut int Le premier approvisionnement à sélectionner
   * @param $limite int Le nombre d'approvisionnement à sélectionner
   * @return array La liste des approvisionnement. Chaque entrée est une instance de Caisses.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant un approvisionnement précis.
   * @param $id int L'identifiant de l'approvisionnement à récupérer
   * @return Caisses L'approvisionnement demandé
   */
  abstract public function getUnique($id);
}