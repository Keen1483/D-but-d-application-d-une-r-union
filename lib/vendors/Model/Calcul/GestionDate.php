<?php
namespace Model\Calcul;

class GestionDate {

    protected $oldDate;
    protected $newDate;
    protected $timeZone; // new DateTimeZone('Africa/Douala')

    // CONSTRUCTOR
    public function __construct($oldDate, $newDate = null, $timeZone = 'Africa/Douala')
    {
        $data = ['oldDate' => $oldDate, 'newDate' => $newDate, 'timeZone' => $timeZone];
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
    public function CalculTimestamp() {

        $date1 = new \DateTime($this->oldDate, new \DateTimeZone($this->timeZone()));
        $date2 = new \DateTime($this->newDate, new \DateTimeZone($this->timeZone()));

        $timestamp = $date2->getTimestamp() - $date1->getTimestamp();

        return $timestamp;
    }

    // SETTERS
    Public function setOldDate($oldDate) {
        $this->oldDate = $oldDate;
    }

    public function setNewDate($newDate) {
        $this->newDate = $newDate;
    }

    public function setTimeZone($zone) {
        $this->zone = $zone;
    }

    // GETTERS
    public function oldDate() {
        return $this->oldDate;
    }

    public function newDate() {
        return $this->newDate;
    }

    public function timeZone() {
        return $this->zone;
    }
}