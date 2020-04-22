<?php
namespace Model;

use \Entity\Dette;
use \Entity\Membre;
use \Model\Calcul\CalculSurDette;
use \Model\Calcul\GestionDate;
use \Model\Calcul\NewCalculDette;
use \Model\Calcul\OldCalculDette;

class DetteManagerPDO extends DetteManager
{
    // METHODES DE CLASSE
    protected function addDette(Membre $membre, $somme) {

        $data = [
            'idMembre' => $membre->id(),
            'somme' => $somme,
            'reste' => $somme
        ];

        $this->add('dette', $data);
    }

    protected function add($table, array $data)
    {
        $sql1 = 'INSERT INTO '.$table.' (date';
        $sql2 = 'VALUES (NOW()';

        foreach($data as $key => $value)
        {
            $sql1 .= ', ' . $key;
            $sql2 .= ', :' . $key;
        }
        $sql = $sql1 . ') ' . $sql2 . ')';

        $req = $this->dao->prepare($sql);

        foreach ($data as $key => $value) {
            $req->bindValue(':'.$key, $value);
        }
        
        $req->execute();
    }

    protected function addAvance(Membre $membre, $avance) {

        $avance = (double) $avance;

        // RECUPERATION DE L'ID
        $req = $this->dao->query('SELECT MAX(id) FROM dette WHERE idMembre = ' . $membre->id());
        $id = $req->fetchColumn();
        $req->closeCursor();

        // RECUPERATION DES DERNIERES MODIFICATIONS
        $req = $this->dao->query(
            'SELECT date, reste, tempsRestant
            FROM dette WHERE id = ' . $id
        );
        $data = $req->fetch(\PDO::FETCH_ASSOC);
        $req->closeCursor();

        // CALCUL DE LA DUREE ET DU RESTE
        $date = new GestionDate($data['date']);
        
        $timestamp = $date->CalculTimestamp();

        $dette = new NewCalculDette();
        $duree = $dette->dureeDette($timestamp);

        $timestamp += (int) $data['tempsRestant'];
        $sommeDette = [];
        if ($timestamp > 0) {
            $sommeDette = $dette->sommeDette($data['reste'], $timestamp);
        } else {
            $sommeDette = ['dette' => $data['reste'], 'resteTemps' => $timestamp];
        }
        
        $reste = (($sommeDette['dette'] - $avance) <= 0) ? 0 : ($sommeDette['dette'] - $avance) ;

        // INSERTION NOUVELLE DETTE
        $req = $this->dao->prepare(
            'INSERT INTO dette (idMembre, date, duree, somme, avance, reste, tempsRestant)
            VALUES(:idMembre, NOW(), :duree, :somme, :avance, :reste, :tempsRestant)'
        );
        $req->bindValue(':idMembre', $membre->id(), \PDO::PARAM_INT);
        $req->bindValue(':duree', $duree);
        $req->bindValue(':somme', $sommeDette['dette']);
        $req->bindValue(':avance', $avance);
        $req->bindValue(':reste', $reste);
        $req->bindValue(':tempsRestant', $sommeDette['resteTemps']);

        $req->execute();
    }

    protected function update(Membre $membre, $avance = 0, $reste = 0) {

        $avance = (double) $avance;
        $reste = (double) $reste;

        $req = $this->db->prepare(
            'UPDATE dette SET dateModification = NOW(), avance = :avance, reste = :reste
            WHERE idMembre = :idMembre'
        );
        $req->bindValue(':avance', $avance);
        $req->bindValue(':reste', $reste);
        $req->bindValue(':idMembre', $membre->id(), \PDO::PARAM_INT);
    
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM dette WHERE id = '.(int) $id);
    }

    public function count()
    {
      return $this->dao->query('SELECT COUNT(*) FROM dette')->fetchColumn();
    }

    public function getDette($id) {
        
        $list = [];
        $req = $this->dao->query(
            'SELECT *
            FROM dette
            WHERE idMembre = '. (int) $id
        );

        $objCalculDuree = new NewCalculDette();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $dureeTempsRestant = $objCalculDuree->dureeDette(abs($data['tempsRestant']));
            if($data['tempsRestant'] > 0)
                $data['tempsRestant'] = 'Plus '.$dureeTempsRestant;
            elseif($data['tempsRestant'] < 0)
                $data['tempsRestant'] = 'Moin '.$dureeTempsRestant;
            else
                $data['tempsRestant'] = '';
            
            $list[] = $data;
        }
        $req->closeCursor();
        return $list;

    }

    public function consulterUniqueDette($id)
    {
        $objCalculDuree = new NewCalculDette();
        $dettesConsulter = [];
        

        $listDette = $this->getDette($id);
        foreach ($listDette as $dette) {
            $objGestionDate = new GestionDate($dette['date']);
            $timestamp = $objGestionDate->CalculTimestamp();

            $dette['duree'] = $objCalculDuree->dureeDette($timestamp);

            $redevance = $objCalculDuree->sommeDette($dette['reste'], $timestamp);
            $dette['somme'] = $redevance['dette'];

            $dettesConsulter[] = $dette;
        }

        return $dettesConsulter;
    }

    public function getListDette($offset = -1, $limit = -1) {

        $list = [];
        $req = $this->dao->query(
            'SELECT m.nom nom, m.prenom prenom, m.id id, d.date date, d.somme somme, d.duree duree,
            d.avance avance, d.reste reste, d.tempsRestant tempsRestant
            FROM dette d
            INNER JOIN membres m
            ON d.idMembre = m.id'
        );

        $objCalculDuree = new NewCalculDette();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $dureeTempsRestant = $objCalculDuree->dureeDette(abs($data['tempsRestant']));
            if($data['tempsRestant'] > 0)
                $data['tempsRestant'] = 'Plus '.$dureeTempsRestant;
            elseif($data['tempsRestant'] < 0)
                $data['tempsRestant'] = 'Moin '.$dureeTempsRestant;
            else
                $data['tempsRestant'] = '';
            
            $list[] = $data;
        }
        $req->closeCursor();
        return $list;
    }

    public function consulterDette()
    {
        $objCalculDuree = new NewCalculDette();
        $dettesConsulter = [];
        

        $listDette = $this->getListDette();
        foreach ($listDette as $dette) {
            $objGestionDate = new GestionDate($dette['date']);
            $timestamp = $objGestionDate->CalculTimestamp();

            $dette['duree'] = $objCalculDuree->dureeDette($timestamp);

            $redevance = $objCalculDuree->sommeDette($dette['reste'], $timestamp);
            $dette['somme'] = $redevance['dette'];

            $dettesConsulter[] = $dette;
        }

        return $dettesConsulter;
    }

    // ANCIEN SYSTEM

    public function getListAncienneDette($offset = -1, $limit = -1) {

        $list = [];
        $req = $this->dao->query(
            'SELECT m.nom nom, m.prenom prenom, d.date date, d.somme somme, d.duree duree,
            d.avance avance, d.reste reste, d.tempsRestant tempsRestant
            FROM dette d
            INNER JOIN membres m
            ON d.idMembre = m.id'
        );

        $objCalculDuree = new OldCalculDette();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $dureeTempsRestant = $objCalculDuree->dureeDette(abs($data['tempsRestant']));
            if($data['tempsRestant'] > 0)
                $data['tempsRestant'] = 'Plus '.$dureeTempsRestant;
            elseif($data['tempsRestant'] < 0)
                $data['tempsRestant'] = 'Moin '.$dureeTempsRestant;
            else
                $data['tempsRestant'] = '';
            
            $list[] = $data;
        }
        return $list;
    }

    public function consulterAncienneDette()
    {
        $objCalculDuree = new OldCalculDette();
        $dettesConsulter = [];
        

        $listDette = $this->getListDette();
        foreach ($listDette as $dette) {
            $objGestionDate = new GestionDate($dette['date']);
            $timestamp = $objGestionDate->CalculTimestamp();

            $dette['duree'] = $objCalculDuree->dureeDette($timestamp);

            $redevance = $objCalculDuree->sommeDette($dette['reste'], $timestamp);
            $dette['somme'] = $redevance['dette'];

            $dettesConsulter[] = $dette;
        }

        return $dettesConsulter;
    }

}