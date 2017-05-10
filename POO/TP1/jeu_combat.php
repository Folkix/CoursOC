<?php

class Personnage {

    private $_id,
            $_pv,
            $_nom;

    const CEST_MOI = 1;
    const PERSO_FRAPPE = 2;
    const PERSO_TUE = 3;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate (array $donnees){
        foreach ($donnees as $key => $values){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($values);
            }
        }
    }

    public function frapper(Personnage $perso){
        if ($perso->id() == $this->_id){
            return self::CEST_MOI;

        }
        else {
            return $perso->recevoirDegats();
        }
    }

    public function recevoirDegats(){

        $this->_pv -= 5;

        if ($this->_pv <= 0){
            return self::PERSO_TUE;
        }
        else{
            return self::PERSO_FRAPPE;
        }
    }
    public function nomValide()
    {
        return !empty($this->_nom);
    }

    //Getter pour retourné les valeurs
    public function id(){
        return $this->_id;
    }
    public function pv(){
        return $this->_pv;
    }
    public function nom(){
        return $this->_nom;
    }

    //Setter pour modifier les valeurs
    public function setId($id)
    {
        $id = (int) $id;

        if ($id>0){
            $this->_id = $id;
        }
    }
    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }
    public function setPv($pv)
    {
        $pv = (int) $pv;

        if ($pv>0 AND $pv<=100) {
            $this->_pv = $pv;
        }
    }

}
class PersonnageManager {
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(Personnage $perso){
        $q = $this->_db->prepare('INSERT INTO personnages(nom) VALUES(:nom)');
        $q->bindValue(':nom', $perso->nom());
        $q->execute();

        $perso->hydrate([
            'id' => $this->_db->lastInsertId(),
            'pv' => 100,
        ]);
    }
    public function update(Personnage $perso){
        $q = $this->_db->prepare('UPDATE personnages SET pv = :pv WHERE id = :id');
        $q->bindValue(':pv', $perso->pv(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
        $q->execute();
    }

    public function delete(Personnage $perso){
        $this->_db->exec('DELETE FROM personnages WHERE id = ' .$perso->id());
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM personnages')->fetchColumn();
    }
    public function exist($info){
        if (is_int($info)){
            return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
        }
        else {
            $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
            $q->execute([':nom' => $info]);
            return (bool) $q->fetchColumn();
        }
    }
    public function get($info){
        if (is_int($info)){
            $q = $this->_db->query('SELECT id, nom, pv FROM personnages WHERE id ='.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Personnage($donnees);
        }
        else{
            $q = $this->_db->prepare('SELECT id, nom, pv FROM personnages WHERE nom = :nom');
            $q->execute([':nom' => $info]);

            return new Personnage($q->fetch(PDO::FETCH_ASSOC));
        }
    }
    public function getList($nom){

        $persos = [];
        $q = $this->_db->prepare('SELECT id, nom, pv FROM personnages WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        while($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $persos[] = new Personnage($donnees);
        }
        return $persos;
    }

}

session_start();

if (isset($_GET['deconnexion'])){
    session_destroy();
    header('Location: jeu_combat.php');
    exit();
}

if (isset($_SESSION['perso'])){
    $perso = $_SESSION['perso'];
}

$db = new PDO('mysql:host=localhost;dbname=coursoc;charset=utf8;', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new PersonnageManager($db);

if (isset($_POST['creer']) AND isset($_POST['nom'])) {
    $perso = new Personnage(['nom' => $_POST['nom']]);

    if (!$perso->nomValide()) {
        $message = 'Le nom est invalide.';
        unset($perso);
    }
    elseif ($manager->exist($perso->nom())) {
        $message = 'Le nom est déjà pris.';
        unset($perso);
    }
    else {
        $manager->add($perso);
    }
}
elseif (isset($_POST['utiliser']) AND isset($_POST['nom'])){
    $perso = new Personnage(['nom' => $_POST['nom']]);
    if ($manager->exist($perso->nom())){
        $perso = $manager->get($_POST['nom']);
    }
    else{
        $message = 'Ce personnage n\'existe pas';
    }
}
elseif (isset($_GET['frapper'])){
    if (!isset($perso)){
        $message = 'Veuillez creer un perso ou en utiliser un.';
    }
    else{
        if (!$manager->exist((int) $_GET['frapper'])){
            $message = 'Le personnage visée n\'existe pas.';
        }
        else{
            $persoAFrapper = $manager->get((int) $_GET['frapper']);
            $retour = $perso->frapper($persoAFrapper);

            switch ($retour){
                case Personnage::CEST_MOI :
                    $message = 'Mais t\'essaies de te frapper là...';
                    break;

                case Personnage::PERSO_FRAPPE :
                    $message = $persoAFrapper->nom() . ' à bien été frapper !';

                    $manager->update($perso);
                    $manager->update($persoAFrapper);
                    break;

                case Personnage::PERSO_TUE :
                    $message = $persoAFrapper->nom() . '  à succombé.';

                    $manager->update($perso);
                    $manager->delete($persoAFrapper);
                    break;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html>
  <head>
    <title>TP : Mini jeu de combat</title>

    <meta charset="utf-8" />
  </head>
  <body>
  <a>Nombre de personnages créer : <?php echo $manager->count(); ?></a>
  <?php if (isset($message)){
  echo '<p>' . $message . '</p>';
  }
  if (isset($perso)) {
  ?>
      <p><a href="?deconnexion=1">Déconnexion</a></p>
      <fieldset>
          <legend>Mes informations</legend>
          <p>
              Nom : <?php echo htmlspecialchars($perso->nom()); ?><br/>
              Pv : <?php echo $perso->pv(); ?>
          </p>
      </fieldset>

  <fieldset>
      <legend>Qui frapper ?</legend>
      <p>
          <?php
          $persos = $manager->getList($perso->nom());

          if (empty($persos)) {
              echo 'Personne à frapper';
          } else {
              foreach ($persos as $unPerso){
                  echo '<a href="?frapper=' . $unPerso->id() . '">' . htmlspecialchars($unPerso->nom()) . '</a> (PV restants : ' . $unPerso->pv() . ')<br/>';
              }
      }
              ?>
          </p>
      </fieldset>
      <?php
  }
  else {
      ?>
      <form action="" method="post">
          <p>
              Nom : <input type="text" name="nom" maxlength="50"/>
              <input type="submit" value="Créer ce personnage" name="creer"/>
              <input type="submit" value="Utiliser ce personnage" name="utiliser"/>
          </p>
      </form>
      <?php
       }
         ?>
  </body>
</html>
<?php
if (isset($perso)) {
    $_SESSION['perso'] = $perso;
}

























