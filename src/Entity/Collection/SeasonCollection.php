<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Season;
use Entity\Tvshow;
use PDO;

class SeasonCollection
{

    public static function findBySeasonId(int $Season): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
    SELECT *
    FROM season
    WHERE tvShowId = :id
    ORDER BY name;
SQL
        );
        $stmt->bindParam(":id", $Season);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Season");
    }
}