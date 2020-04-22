<?php
namespace Entity;

use \KeenFram\Entity;

class Membre extends Entity
{
  protected $nom,
            $prenom,
            $telephone,
            $photo,
            $dateAjout,
            $dateModif;

const NOM_INVALID = 1;
const PRENOM_INVALIDE = 2;
const TELEPHONE_INVALIDE = 3;
const PHOTO_INVALIDE = 4;

  public function isValid()
  {
    return !(empty(ltrim($this->nom)) || empty(ltrim($this->prenom)));
  }

  // SETTERS //

  public function setNom($nom)
  {
    if (!is_string($nom) || empty($nom)) {
      $this->erreurs[] = self::NOM_INVALID;
    }

    $this->nom = $nom;
  }

  public function setPrenom($prenom)
  {
    if (!is_string($prenom) || empty($nom)) {
      $this->erreurs[] = self::PRENOM_INVALIDE;
    }

    $this->prenom = $prenom;
  }

  public function setTelephone($telephone)
  {
    if(!empty($telephone))
    {
      if (!preg_match('#^((\+)?(00)?(237)?)6[0-9]{8}?$#', $telephone)) {
        $this->erreurs[] = self::TELEPHONE_INVALIDE;
      }

      $this->telephone = $telephone;
    }
  }

  public function setPhoto($photo)
  {
    $this->photo = $photo;
  }

  public function setDateAjout($dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }

  public function setDateModif($dateModif)
  {
    $this->dateModif = $dateModif;
  }

  // GETTERS //

  public function nom()
  {
    return $this->nom;
  }

  public function prenom()
  {
    return $this->prenom;
  }

  public function telephone()
  {
    return $this->telephone;
  }

  public function photo()
  {
    return $this->photo;
  }

  public function dateAjout()
  {
    return $this->dateAjout;
  }

  public function dateModif()
  {
    return $this->dateModif;
  }
}