<?php


class PersonnageV2
{
    private $_ID;
    private $_Nom;
    private $_forcePerso;
    private $_PointsVie;
    private $_Niveau;
    private $_PointsXP;

    public function __construct($valeurs = array())
    {
        if(!empty($valeurs))
            $this->hydrate($valeurs);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }

    }
    public function ID() { return $this->_ID; }
    public function Nom() { return $this->_Nom; }
    public function forcePerso() { return $this->_forcePerso; }
    public function PointsVie() { return $this->_PointsVie; }
    public function Niveau() { return $this->_Niveau; }
    public function PointsXP() { return $this->_PointsXP; }


    public function setID($ID)
    {
        // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
        $this->_ID = (int) $ID;
    }

    public function setNom($Nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        // Dont la longueur est inférieure à 30 caractères.
        if (is_string($Nom) && strlen($Nom) <= 30)
        {
            $this->_Nom = $Nom;
        }
    }

    public function setForcePerso($forcePerso)
    {
        $forcePerso = (int) $forcePerso;

        // On vérifie que la force passée est comprise entre 0 et 100.
        if ($forcePerso >= 0 && $forcePerso <= 100)
        {
            $this->_forcePerso = $forcePerso;
        }
    }

    public function setPointsVie($PointsVie)
    {
        $PointsVie = (int) $PointsVie;

        // On vérifie que les dégâts passés sont compris entre 0 et 100.
        if ($PointsVie >= 0 && $PointsVie <= 100)
        {
            $this->_PointsVie = $PointsVie;
        }
    }

    public function setNiveau($Niveau)
    {
        $Niveau = (int) $Niveau;

        // On vérifie que le Niveau n'est pas négatif.
        if ($Niveau >= 0)
        {
            $this->_Niveau = $Niveau;
        }
    }

    public function setPointsXP($exp)
    {
        $exp = (int) $exp;

        // On vérifie que l'expérience est comprise entre 0 et 100.
        if ($exp >= 0 && $exp <= 100)
        {
            $this->_PointsXP = $exp;
        }
    }
}

class PersonnagesManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(PersonnageV2 $perso)
    {
       $q = $this->_db->prepare('INSERT INTO personnagev2(Nom, forcePerso, PointsVie, Niveau, PointsXP) VALUES(:Nom, :forcePerso, :PointsVie, :Niveau, :PointsXP)');

        $q->bindValue(':Nom', $perso->Nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':PointsVie', $perso->PointsVie(), PDO::PARAM_INT);
        $q->bindValue(':Niveau', $perso->Niveau(), PDO::PARAM_INT);
        $q->bindValue(':PointsXP', $perso->PointsXP(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(PersonnageV2 $perso)
    {
        $this->_db->exec('DELETE FROM personnagev2 WHERE ID = '.$perso->ID());
    }

    public function get($ID)
    {
        $ID = (int) $ID;

        $q = $this->_db->query('SELECT ID, Nom, forcePerso, PointsVie, Niveau, PointsXP FROM personnagev2 WHERE ID = '.$ID);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new PersonnageV2($donnees);
    }

    public function getList()
    {
        $persos = [];

        $q = $this->_db->query('SELECT ID, Nom, forcePerso, PointsVie, Niveau, PointsXP FROM personnagev2 ORDER BY Nom');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new PersonnageV2($donnees);
        }

        return $persos;
    }

    public function update(PersonnageV2 $perso)
    {
        $q = $this->_db->prepare('UPDATE personnagev2 SET forcePerso = :forcePerso, PointsVie = :PointsVie, Niveau = :Niveau, PointsXP = :PointsXP WHERE ID = :ID');

        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':PointsVie', $perso->PointsVie(), PDO::PARAM_INT);
        $q->bindValue(':Niveau', $perso->Niveau(), PDO::PARAM_INT);
        $q->bindValue(':PointsXP', $perso->PointsXP(), PDO::PARAM_INT);
        $q->bindValue(':ID', $perso->ID(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

$perso = new PersonnageV2([
    'Nom' => 'Victor',
    'forcePerso' => 5,
    'PointsVie' => 100,
    'Niveau' => 1,
    'PointsXP' => 0,
]);

$db = new PDO('mysql:host=localhost;dbname=coursoc', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$manager = new PersonnagesManager($db);

echo ('Le nom :' . $perso->Nom());
$manager->add($perso);

