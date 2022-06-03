<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Tvshow;
use PDO;

class GenreCollection
{
    public static function findAll(int $idGenre): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow t
            WHERE t.id IN (SELECT g.tvShowId
                            FROM tvshow_genre g
                            WHERE g.genreId = :genreId)
            ORDER BY t.name;
            SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}