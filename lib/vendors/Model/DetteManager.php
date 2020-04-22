<?php
namespace Model;

use KeenFram\Manager;
use \Entity\Dette;
use \Entity\Membre;

abstract class DetteManager extends Manager
{
    private $_membre;

    public function setMembre(Membre $membre) {
        $this->_membre = $membre;
    }

    public function membre() {
        return $this->_membre;
    }

    /**
     * Méthode permettant d'enregistrer une dette.
     * @param $membre Membre Le membre emprunteur.
     * @param $somme La somme empruntée.
     * @return void
     */
    abstract protected function addDette(Membre $membre, $somme);

    /**
     * Méthode permettant d'enregistrer une avance sur une dette.
     * @param $membre Membre Le membre emprunteur.
     * @param $avane La somme avancée.
     * @return void
     */    
    abstract protected function addAvance(Membre $membre, $avance);

    /**
     * Méthode permettant de modifier un enregistrement sur une dette.
     * @param $membre Membre Le membre emprunteur.
     * @param $avane La somme avancée.
     * @param $reste Le reste à rembourser.
     * @return void
     */    
    abstract protected function update(Membre $membre, $avance = 0, $reste = 0);

    /**
     * Méthode permettant de sauvegarder une dette.
     * @param $dette Dette la dette à sauvegarder
     * @see self::addDette()
     * @return void
     */
    public function save(Dette $dette)
    {
        var_dump($dette->somme()); var_dump($this->membre());
        $this->addDette($this->membre(), $dette->somme());
    }

    /**
     * Méthode permettant de supprimer une dette.
     * @param $id int L'identifiant de la dette à supprimer
     * @return void
     */
    abstract public function delete($id);

    /**
     * Méthode retournant le nombre de dettes.
     * @return int
     */
    abstract public function count();

    /**
     * Méthode retournant la dette d'un membre.
     * @param $id L'identifiant du membre.
     * @return Dette
     */     
    abstract public function getDette($id);

    /**
     * Méthode retournant les dettes de tous les membres.
     * @param $offset.
     * @param $limit.
     * @return array
     */
    abstract public function getListDette($offset = -1, $limit = -1);

    /**
     * Méthode permettant de consulter les dettes des membres.
     * @return array
     */
    abstract public function consulterDette();

    /**
     * Méthode permettant de consulter la dette d'un membre.
     * @return array
     */
    abstract public function consulterUniqueDette($id);

    // ANCIEN SYSTEM

    /**
     * Méthode retournant les dettes de tous les membres.
     * @param $offset.
     * @param $limit.
     * @return array
     */
    abstract public function getListAncienneDette($offset = -1, $limit = -1);

    /**
     * Méthode permettant de consulter les dettes des membres.
     * @return array
     */
    abstract public function consulterAncienneDette();

    
}