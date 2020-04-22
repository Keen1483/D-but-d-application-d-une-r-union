<?php
namespace Model\Calcul;

abstract class CalculSurDette {

    // ATTRIBUTS
    protected $timestamp;
    protected $dette;

    // CONSTANTES
    const DUREE_MINUTE_EN_SECONDE = 60;
    const DUREE_HEURE_EN_SECONDE = 3600;
    const DUREE_JOUR_EN_SECONDE = 86400;
    const DUREE_MOIS_EN_SECONDE = 2592000;
    const DUREE_MOIS_EN_JOURS = 30;

    // CONSTRUCTOR
    public function __construct(array $data = [])
    {
        $this->hydratation($data);
    }

    // HYDRATATION
    public function hydratation(array $data) {

        foreach ($data as $attribut => $value) {
            $method = 'set' . ucfirst($attribut);

            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    // METHODES DE CLASSE
    public function dureeDette($timestamp) {

        $this->setTimestamp($timestamp);

        if ($this->timestamp() > self::DUREE_MOIS_EN_SECONDE) {
            $jours = $this->timestamp() % self::DUREE_MOIS_EN_SECONDE;
            $mois = $this->timestamp() - $jours;
            $mois /= self::DUREE_MOIS_EN_SECONDE;

            $heure = $jours % self::DUREE_JOUR_EN_SECONDE;
            $jours -= $heure;
            $jours /= self::DUREE_JOUR_EN_SECONDE;

            $min = $heure % self::DUREE_HEURE_EN_SECONDE;
            $heure -= $min;
            $heure /= self::DUREE_HEURE_EN_SECONDE;

            $seconde = $min % self::DUREE_MINUTE_EN_SECONDE;
            $min -= $seconde;
            $min /= self::DUREE_MINUTE_EN_SECONDE;

            return $mois . ' mois ' . $jours . ' jours ' . $heure 
            . ' heures ' . $min . ' minute ' . $seconde . ' seconde';
        } elseif ($this->timestamp() == self::DUREE_MOIS_EN_SECONDE) {
            return $mois . ' mois ';
        } elseif($this->timestamp() >= self::DUREE_JOUR_EN_SECONDE) {
            $heure = $this->timestamp() % self::DUREE_JOUR_EN_SECONDE;
            $jours = $this->timestamp() - $heure;
            $jours /= self::DUREE_JOUR_EN_SECONDE;

            $min = $heure % self::DUREE_HEURE_EN_SECONDE;
            $heure -= $min;
            $heure /= self::DUREE_HEURE_EN_SECONDE;

            $seconde = $min % self::DUREE_MINUTE_EN_SECONDE;
            $min -= $seconde;
            $min /= self::DUREE_MINUTE_EN_SECONDE;

            return $jours . ' jours ' . $heure 
            . ' heures ' . $min . ' minute ' . $seconde . ' seconde';
        } elseif($this->timestamp() >= self::DUREE_HEURE_EN_SECONDE) {
            $min = $this->timestamp() % self::DUREE_HEURE_EN_SECONDE;
            $heure = $this->timestamp() - $min;
            $heure /= self::DUREE_HEURE_EN_SECONDE;

            $seconde = $min % self::DUREE_MINUTE_EN_SECONDE;
            $min -= $seconde;
            $min /= self::DUREE_MINUTE_EN_SECONDE;

            return $heure . ' heures ' . $min . ' minute ' . $seconde . ' seconde';
        } elseif($this->timestamp() >= self::DUREE_MINUTE_EN_SECONDE) {
            $seconde = $this->timestamp() % self::DUREE_MINUTE_EN_SECONDE;
            $min = $this->timestamp - $seconde;
            $min /= self::DUREE_MINUTE_EN_SECONDE;

            return $min . ' minute ' . $seconde . ' seconde';
        } else {
            return $this->timestamp() . ' seconde';
        }
    }

    public abstract function sommeDette($dette, $timestamp);

    // SETTERS
    public function setTimestamp($timestamp) {
        $timestamp = (int) $timestamp;
        if ($timestamp <= 0) {
            # code...
        } else {
            $this->timestamp = $timestamp;
        }
    }

    public function setDette($dette) {
        $dette = (double) $dette;
        if ($dette <= 0) {
            # code...
        } else {
            $this->dette = $dette;
        }
    }

    // GETTERS
    public function timestamp() {
        return $this->timestamp;
    }

    public function dette() {
        return $this->dette;
    }
}