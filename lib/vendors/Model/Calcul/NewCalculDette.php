<?php
namespace Model\Calcul;

class NewCalculDette extends CalculSurDette {

    public function sommeDette($dette, $timestamp) {

        $this->setDette($dette);
        $this->setTimestamp($timestamp);
        
        if ($this->timestamp() > self::DUREE_MOIS_EN_SECONDE) {

            $jours = $this->timestamp() % self::DUREE_MOIS_EN_SECONDE;
            $mois = $this->timestamp() - $jours;
            $mois /= self::DUREE_MOIS_EN_SECONDE;

            for($i = 1; $i <= (int) $mois; $i++) {
                $this->dette += (3 / 100) * $this->dette();
            }

            if ($jours > (self::DUREE_MOIS_EN_SECONDE / 6)) {
                $this->dette += (3 / 100) * $this->dette();
                $jours -= self::DUREE_MOIS_EN_SECONDE;
            }

        } elseif( ($this->timestamp() == self::DUREE_MOIS_EN_SECONDE)) {

            $this->dette += (3 / 100) * $this->dette();
            $jours = 0;

        } elseif($this->timestamp() > (self::DUREE_MOIS_EN_SECONDE / 6)) {

            $this->dette += (3 / 100) * $this->dette();
            $jours = $this->timestamp() - self::DUREE_MOIS_EN_SECONDE;

        } elseif ($this->timestamp() <= (self::DUREE_MOIS_EN_SECONDE / 6)) {

            $jours = $this->timestamp();
        }

        $detteEtJoursRestant = ['dette' => $this->dette(), 'resteTemps' => $jours];

        return $detteEtJoursRestant;
    }
}