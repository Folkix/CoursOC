<?php

class NewsManagerPDO extends NewsManager
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    protected function add(News $news)
    {
        $requete = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) VALUES(:auteur, :titre, :contenu, NOW(), NOW())');

        $requete->bindValue(':titre', $news->getTitre());
        $requete->bindValue(':auteur', $news->getAuteur());
        $requete->bindValue(':contenu', $news->getContenu());

        $requete ->execute();
    }

    public function delete($id)
    {
        $this->db->exec('DELETE FROM news WHERE id = ' .(int) $id);
    }

    protected function update(News $news)
    {
        $requete = $this->db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id');
        $requete->bindValue(':titre', $news->getTitre());
        $requete->bindValue(':auteur', $news->getAuteur());
        $requete->bindValue(':contenu', $news->getContenu());
        $requete->bindValue(':id', $news->getId(), PDO::PARAM_INT);

        $requete->execute();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    public function getList()
    {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news ORDER BY id DESC LIMIT 5 ';


        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $listeNews = $requete->fetchAll();

        foreach ($listeNews as $news)
        {
            $news->setDateAjout(new DateTime($news->getDateAjout()));
            $news->setDateModif(new DateTime($news->getDateModif()));
        }

        $requete->closeCursor();

        return $listeNews;
    }

    public function getUnique($id)
    {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM news WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();

        $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'news');

        $news = $requete->fetch();

        $news->setDateAjout(new DateTime($news->getDateAjout()));
        $news->setDateModif(new DateTime($news->getDateModif()));

        return $news;
    }
}