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
            SELECT e.id, e.seasonId, e.name, e.overview, e.episodeNumber
            FROM episode e, season s
            WHERE e.seasonId = s.id
            AND s.tvshowId =:id
            AND e.seasonId =:id2
            ORDER BY e.id
            SQL
        );
        $stmt->bindParam(":id2", $seasonId);
        $stmt->bindParam(":id", $tvshowId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Episode");
    }
}
