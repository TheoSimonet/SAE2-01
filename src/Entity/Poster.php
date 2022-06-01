<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Poster
{
    private int $id;
    private string $jpeg;

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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $posterId): Poster
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM poster
            WHERE id = :posterId;
            SQL
        );
        $stmt->bindParam(":posterId", $posterId);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Poster::class);
        $stmt->execute();
        $res = $stmt->fetchAll();
        if (count($res) != 1) {
            throw new \Exception\EntityNotFoundException();
        }
        return $res[0];
    }
}