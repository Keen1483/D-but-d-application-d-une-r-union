<?php
namespace Entity;

use \KeenFram\Entity;

class Caisses extends Entity
{
    protected $entree,
              $sortie,
              $raison,
              $total,
              $dateModif;

    const ENTREE_INVALIDE = 1;
    const SORTIE_INVALIDE = 2;
    const RAISON_INVALIDE = 3;
    const OPERATION_INTERDITE = 4;

    public function isValid()
    {
        return !((empty($this->entree) && empty($this->sortie)) || empty($this->raison));
    }

    // SETTERS //

    public function setEntree($entree)
    {
        $entree = (double) $entree;

        if($entree < 0)
        {
            $this->erreurs[] = self::ENTREE_INVALIDE;
        }

        $this->entree = $entree;
    }

    public function setSortie($sortie)
    {
        $sortie = (double) $sortie;

        if($sortie < 0)
        {
            $this->erreurs[] = self::SORTIE_INVALIDE;
        }

        $this->sortie = $sortie;
    }

    public function setRaison($raison)
    {
        if(!is_string($raison) || empty($raison))
        {
            $this->erreurs[] = self::RAISON_INVALIDE;
        }

        $this->raison = $raison;
    }

    public function setTotal($total)
    {
        $total = (double) $total;
        
        $this->total = $total;
    }

    public function setDateModif(\DateTime $dateModif)
    {
        $this->dateModif = $dateModif;
    }

    // GETTERS //

    public function entree()
    {
        return $this->entree;
    }

    public function sortie()
    {
        return $this->sortie;
    }

    public function raison()
    {
        return $this->raison;
    }

    public function total()
    {
        return $this->total;
    }

    public function dateModif()
    {
        return $this->dateModif;
    }
}