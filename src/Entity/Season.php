<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Season
{
    private int $id;
    private int $tvShow;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTvShow(): int
    {
        return $this->tvShow;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Season
    {
        $season = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM season
            WHERE id = :id;
            SQL
        );
        $season->bindParam(':id', $id);
        $season->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Season::class);
        $season->execute();
        $season = $season->fetchAll();
        if ($season == true) {
            return $season[0];
        } else {
            throw new EntityNotFoundException("Entité introuvable");
        }
    }
}