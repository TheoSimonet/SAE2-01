<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Tvshow;
use PDO;

class GenreCollection
{
    public static function findAll(int $genreId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow t
            WHERE t.id IN (SELECT tg.tvShowId
                            FROM tvshow_genre tg
                            WHERE tg.genreId =:genreId)
            ORDER BY t.name;
            SQL
        );
        $stmt->bindParam(':genreId', $genreId);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Tvshow::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}