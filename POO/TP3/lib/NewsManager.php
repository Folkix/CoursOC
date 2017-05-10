<?php

abstract class NewsManager
{
    abstract protected function add(News $news);

    abstract  protected function update(News $news);

    abstract public function count();

    abstract public function delete($id);

    abstract public function getList();

    abstract  public  function getUnique($id);

    public function save(News $news)
    {
        if ($news->isValid())
        {
            $news->isNew() ? $this->add($news) : $this->update($news);
        }
        else
        {
            throw new RuntimeException('La news doit être valide pour être enregistrée');
        }
    }




}