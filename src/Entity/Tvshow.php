<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Tvshow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;

    /**
     * @param int $id
     * @param string $name
     * @param string $originalName
     * @param string $homepage
     * @param string $overview
     * @param int $posterId
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Tvshow
    {
        $tvshow = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow
            WHERE id = :id;
            SQL
        );
        $tvshow->bindParam('id', $id);
        $tvshow->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        $tvshow->execute();
        $tvshow = $tvshow->fetchAll();
        if ($tvshow == true) {
            return $tvshow[0];
        } else {
            throw EntityNotFoundException("Entité introuvable");
        }
    }

}
