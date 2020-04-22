<?php
namespace Model;

use \KeenFram\Manager;
use \Entity\Membre;

abstract class MembreManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un membre.
   * @param $membre Membre Le membre à ajouter
   * @return void
   */
  abstract protected function add(Membre $membre);

  /**
   * Méthode permettant d'enregistrer un membre.
   * @param $membre Membre le membre à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Membre $membre)
  {
    if ($membre->isValid())
    {
      $membre->isNew() ? $this->add($membre) : $this->modify($membre);
    }
    else
    {
      throw new \RuntimeException('Le membre doit être validé pour être enregistrée');
    }
  }

  /**
   * Méthode renvoyant le nombre de membre total.
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer un membre.
   * @param $id int L'identifiant de le membre à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode retournant une liste de membre demandée.
   * @param $debut int Le premier membre à sélectionner
   * @param $limite int Le nombre de membre à sélectionner
   * @return array La liste des membre. Chaque entrée est une instance de Membre.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant un membre précis.
   * @param $id int L'identifiant du membre à récupérer
   * @return Membre Le membre demandé
   */
  abstract public function getUnique($id);

  /**
   * Méthode permettant de modifier un membre.
   * @param $membre Membre le membre à modifier
   * @return void
   */
  abstract protected function modify(Membre $membre);
}