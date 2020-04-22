<?php
namespace Model;

use \Entity\Membre;

class MembreManagerPDO extends MembreManager
{
    protected function add(Membre $membre)
    {
        $requete = $this->dao->prepare('INSERT INTO membres SET nom = :nom, prenom = :prenom, telephone = :telephone,
                                        photo = :photo, dateAjout = NOW(), dateModif = NOW()');
    
        $requete->bindValue(':nom', $membre->nom());
        $requete->bindValue(':prenom', $membre->prenom());
        $requete->bindValue(':telephone', $membre->telephone());
        //$requete->bindValue(':photo', $membre->photo());
        $requete->bindValue(':photo', '');
    
        $requete->execute();
    }

    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM membres')->fetchColumn();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM membres WHERE id = '.(int) $id);
    }

    public function getList($debut = -1, $limite = -1)
    {
        $sql = 'SELECT id, nom, prenom, telephone, photo, dateAjout, dateModif FROM membres ORDER BY id DESC';

        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $requete = $this->dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Membre');

        $listeMembre = $requete->fetchAll();

        foreach ($listeMembre as $membre)
        {
            $membre->setDateAjout(new \DateTime($membre->dateAjout()));
            $membre->setDateModif(new \DateTime($membre->dateModif()));
        }

        $requete->closeCursor();

        return $listeMembre;
    }

     
    public function getUnique($id)
    {
        $requete = $this->dao->prepare('SELECT id, nom, prenom, telephone, photo, dateAjout, dateModif FROM membres WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Membre');

        if ($membre = $requete->fetch())
        {
            $membre->setDateAjout(new \DateTime($membre->dateAjout()));
            $membre->setDateModif(new \DateTime($membre->dateModif()));

            return $membre;
        }

        return null;
    }

     
    protected function modify(Membre $membre)
    {
        $requete = $this->dao->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, prenom = :prenom,
                                        photo = :photo, dateModif = NOW() WHERE id = :id');

        $requete->bindValue(':nom', $membre->nom());
        $requete->bindValue(':prenom', $membre->prenom());
        $requete->bindValue(':telephone', $membre->telephone());
        //$requete->bindValue(':photo', $membre->photo());
        $requete->bindValue(':photo', '');
        $requete->bindValue(':id', $membre->id(), \PDO::PARAM_INT);

        $requete->execute();
    }

    // Functions importées de l'ancien application

    public function membreExists(array $data)
    {
        return $this->isExist('membres', 'Membre', $data);
    }

    protected function isExist($table, $obj, array $infos)
    {
        $all = $this->getAll($table, $obj);
        $count = 0;
        foreach ($all as $objet) {
            
            foreach ($infos as $key => $value) {
                
                /*if(is_callable(array($objet, $objet->$key())))
                {*/
                    if(preg_match('#^'.$value.'$#i', $objet->$key()))
                        $count++;
                //}
            }

            if(($count == count($infos)))
            {
                return $this->getMembre($table, $obj, $objet->id());
                //break;
            }
        }

        return false;
    }

    protected function getAll($table, $obj, $offset = -1, $limit = -1)
    {
        $var = [];
        $sql = 'SELECT * FROM ' .$table. ' ORDER BY id DESC';

        if ($offset != -1 || $limit != -1) {
            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $req = $this->dao->prepare($sql);
        $req->execute();
        $membre = '\Entity\\'. $obj;
        while($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $var[] = new $membre($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getMembre($table, $obj, $id)
    {
        $req = $this->dao->prepare('SELECT * FROM '.$table.' WHERE id = '.$id);
        $req->execute();
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $membre = '\Entity\\'.$obj;
        return new $membre($data);
        $req->closeCursor();
    }
}