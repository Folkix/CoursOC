<?php


class Personnagetuto {
    private $_nom;
    private $_force;        // La force du personnage
    private $_experience;   // Son expérience
    private $_degats;       // Ses dégâts

    public function __construct($nom, $force, $experience) // Constructeur demandant 2 paramètres
    {
        $this->setNom($nom); //Initialisation du nom.
        $this->setForce($force); // Initialisation de la force.
        $this->setExperience($experience); // Initialisation de l'experience.
        $this->_degats = 0; // Initialisation de l'expérience à 0.
    }

    public function frapper(Personnagetuto $persoAFrapper)
    {
        $persoAFrapper->_degats += $this->_force;
    }

    public function gagnerExperience()
    {
        $this->_experience++;
    }

    // Mutateur chargé de modifier l'attribut $_nom.
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    // Mutateur chargé de modifier l'attribut $_force.
    public function setForce($force)
    {
        if (!is_int($force)) // S'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if ($force > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
        {
            trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_force = $force;
    }

    // Mutateur chargé de modifier l'attribut $_experience.
    public function setExperience($experience)
    {
        if (!is_int($experience)) // S'il ne s'agit pas d'un nombre entier.
        {
            trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        if ($experience > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
        {
            trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_experience = $experience;
    }

    // Ceci est la méthode degats() : elle se charge de renvoyer le contenu de l'attribut $_degats.
    public function afficherDegats()
    {
        if ($this->_degats > 100) {
            echo $this->_nom . ' à ' . $this->_degats . ' points de dégats.<br>';
        }
        else {
            echo $this->_nom . ' est mort...<br>';
        }
    }

    // Ceci est la méthode force() : elle se charge de renvoyer le contenu de l'attribut $_force.
    public function force()
    {
        return $this->_force;
    }

    // Ceci est la méthode experience() : elle se charge de renvoyer le contenu de l'attribut $_experience.
    public function experience()
    {
        return $this->_experience;
    }
}