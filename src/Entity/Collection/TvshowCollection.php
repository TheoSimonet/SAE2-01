<?php
declare(strict_types=1);

namespace Entity\Collection;

use Entity\Tvshow;
use Database\MyPdo;
use PDO;

class TvshowCollection
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM tvshow;
            SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Tvshow");
    }
}