<?php
namespace Model\Calcul;

class OldCalculDette extends CalculSurDette {

    public function sommeDette($dette, $timestamp) {

        $this->setDette($dette);
        $this->setTimestamp($timestamp);
        $interet = 0;

        if ($this->timestamp() > self::DUREE_MOIS_EN_SECONDE) {
            $jours = $this->timestamp() % self::DUREE_MOIS_EN_SECONDE;
            $mois = $this->timestamp() - $jours;
            $mois /= self::DUREE_MOIS_EN_SECONDE;

            for($i = 1; $i <= (int) $mois; $i++) {
                
                if ($i > 3) {
                    $interet += (5 / 100) * $this->dette();
                } else {
                    $interet += (3 / 100) * $this->dette();
                }
            }

            if ($mois > 3 && $jours > (self::DUREE_MOIS_EN_SECONDE / 6)) {
                $interet += (5 / 100) * $this->dette();
                $jours -= self::DUREE_MOIS_EN_SECONDE;
            } elseif($mois <= 3 && $jours > (self::DUREE_MOIS_EN_SECONDE / 6)) {
                $interet += (3 / 100) * $this->dette();
                $jours -= self::DUREE_MOIS_EN_SECONDE;
            }
        } elseif( ($this->timestamp() == self::DUREE_MOIS_EN_SECONDE)) {

            $interet += (3 / 100) * $this->dette();
            $jours = 0;

        } elseif($this->timestamp() > (self::DUREE_MOIS_EN_SECONDE / 6)) {

            $interet += (3 / 100) * $this->dette();
            $jours = $this->timestamp() - self::DUREE_MOIS_EN_SECONDE;

        } elseif ($this->timestamp() <= (self::DUREE_MOIS_EN_SECONDE / 6)) {

            $jours = $this->timestamp();
        }

        $this->dette += $interet;

        $detteEtJoursRestant = ['dette' => $this->dette(), 'resteTemps' => $jours];

        return $detteEtJoursRestant;
    }
}