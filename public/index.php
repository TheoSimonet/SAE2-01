<?php
declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage();

$webPage->appendContent();
MyPDO::setConfiguration('mysql:host=mysql;dbname=herm0021;charset=utf8', 'herm0021', 'herm0021');

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT name
    FROM tvshow
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    echo "<p>{$ligne['name']}\n";
}