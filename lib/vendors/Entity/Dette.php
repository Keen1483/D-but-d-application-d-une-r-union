<?php
namespace Entity;

use \KeenFram\Entity;

class Dette extends Entity {

    // ATTRIBUTS
    protected $id;
    protected $idMembre;
    protected $date;
    protected $duree;
    protected $somme;
    protected $avance;
    protected $reste;
    protected $tempsRestant;

    // SETTERS
    public function setIdMembre($idMembre) {
        $this->idMembre = $idMembre;
    }

    public function setDate($date) {

        $this->date = $date;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
    }

    public function setSomme($somme) {

        $somme = (double) $somme;
        if(is_double($somme))
            $this->somme = $somme;

    }

    public function setAvance($avance) {

        $avance = (double) $avance;
        if (is_double($avance)) {
            $this->avance = $avance;
        }
    }

    public function setReste($reste) {

        $reste = (double) $reste;
        if (is_double($reste)) {
            $this->reste = $reste;
        }
    }

    public function setTempsRestant($tempsRestant) {
        if (is_int($tempsRestant)) {
            $this->tempsRestant = $tempsRestant;
        }
    }

    // GETTERS
    public function idMembre() {
        return $this->idMembre;
    }

    public function date() {
        return $this->date;
    }

    public function duree() {
        return $this->duree;
    }

    public function somme() {
        return $this->somme;
    }

    public function avance() {
        return $this->avance;
    }

    public function reste() {
        return $this->reste;
    }

    public function tempsRestant() {
        return $this->tempsRestant;
    }
}