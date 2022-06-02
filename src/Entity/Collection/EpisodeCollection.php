<?php

namespace Entity\Collection;

use Entity\Episode;
use Entity\Season;
use Database\MyPdo;
use PDO;

class EpisodeCollection
{
    public static function findBySeasonId(int $seasonId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM episode
            WHERE seasonId =:id
            SQL
        );
        $stmt->bindParam(":id", $seasonId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Episode");
    }
}
