<?php
namespace Model;

use \Entity\Caisses;

class CaissesManagerPDO extends CaissesManager
{
    /**
    * $table Nom de la table sql
    */
    protected $table;

    protected function add(Caisses $caisses)
    {
        // RECUPERATION DU DERNIER TOTAL
        $sql = $this->dao->query('SELECT total FROM '. $this->table .' ORDER BY id DESC LIMIT 0, 1 ');
        $total = $sql->fetchColumn();
        $sql->closeCursor(); var_dump($total);

        $requete = $this->dao->prepare(
            'INSERT INTO '. $this->table .' SET entree = :entree, sortie = :sortie, raison = :raison, total = :total, dateModif = NOW()'
        );

        $requete->bindValue(':entree', $caisses->entree());
        $requete->bindValue(':sortie', $caisses->sortie());
        $requete->bindValue(':raison', $caisses->raison());

        $total = ($caisses->sortie() > 0) ? ($total - $caisses->sortie()) : ($total + $caisses->entree()) ;
        $requete->bindValue(':total', $total);

        $requete->execute();
    }

    protected function modify(Caisses $caisses)
    {
        // RECUPERATION DE L'AVANT DERNIER TOTAL
        $sql = $this->dao->query('SELECT total FROM '. $this->table .' ORDER BY id DESC LIMIT 1, 1');
        $total = $sql->fetchColumn();
        $sql->closeCursor();

        $requete = $this->dao->prepare(
            'UPDATE '. $this->table .' SET entree = :entree, sortie = :sortie, raison = :raison, total = :total, dateModif = NOW() WHERE id = :id'
        );

        $requete->bindValue(':entree', $caisses->entree());
        $requete->bindValue(':sortie', $caisses->sortie());
        $requete->bindValue(':raison', $caisses->raison());

        $total = (empty($caisses->entree())) ? ($total - $caisses->sortie()) : ($total + $caisses->entree()) ;
        $requete->bindValue(':total', $total);

        $requete->bindValue('id', $caisses->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    protected function addTotal()
    {
        $req = $this->dao->query(
            'INSERT INTO caisse_total (totalDivers, totalDiversTontines, totalFanfare, totalSanctions, totalFondsSecours, totalInterets, dateModif)
            VALUES (
                SELECT total FROM caisse_divers WHERE id = MAX(id),
                SELECT total FROM caisse_divers_tontines WHERE id = MAX(id),
                SELECT total FROM caisse_fanfare WHERE id = MAX(id),
                SELECT total FROM caisse_sanctions WHERE id = MAX(id),
                SELECT total FROM caisse_fonds_secours WHERE id = MAX(id),
                SELECT total FROM caisse_interets WHERE id = MAX(id),
                NOW()
            )'
        );

        $req->execute();
    }

    protected function modifyTotal()
    {
        $req = $this->dao->query(
            'UPDATE caisse_total SET
            totalDivers = (SELECT total FROM caisse_divers WHERE id = MAX(id)),
            totalDiversTontines = (SELECT total FROM caisse_divers_tontines WHERE id = MAX(id)),
            totalFanfare = (SELECT total FROM caisse_fanfare WHERE id = MAX(id)),
            totalSanctions = (SELECT total FROM caisse_sanctions WHERE id = MAX(id)),
            totalFondsSecours = (SELECT total FROM caisse_fonds_secours WHERE id = MAX(id)),
            totalInterets = (SELECT total FROM caisse_interets WHERE id = MAX(id)),
            dateModif = NOW()'
        );

        $req->execute();
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM '. $this->table)->fetchColumn();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM '. $this->table .' WHERE id = '. (int) $id);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, entree, sortie, raison, total, dateModif FROM '. $this->table .' ORDER BY id DESC';
 
        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
    
        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Caisses');
    
        $listeCaisses = $requete->fetchAll();
    
        foreach ($listeCaisses as $caisses)
        {
            $caisses->setDateModif(new \DateTime($caisses->dateModif()));
        }
    
        $requete->closeCursor();
    
        return $listeCaisses;
    }

    public function getUnique($id)
    {
        $requete = $this->dao->prepare('SELECT id, entree, sortie, raison, total, dateModif FROM '. $this->table .' WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
     
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Caisses');
     
        if ($caisses = $requete->fetch())
        {
          $caisses->setDateModif(new \DateTime($caisses->dateModif()));
     
          return $caisses;
        }
    }

    /**
   * Méthode permettant de définir le nom de la table
   * @param $table Le nom de la table
   * @return void
   */
  public function setTable($table)
  {
      if(is_string($table))
          $this->table = $table;
  }
}