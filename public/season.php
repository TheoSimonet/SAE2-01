<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Season;
use Entity\Tvshow;
use Entity\Collection\SeasonCollection;

$tvshowId = intval($_GET['tvshowId']);

$web = new \Html\AppWebPage();
$tvshow = Tvshow::findById($tvshowId);
$web->setTitle("Séries TV : " . $tvshow->getName());

foreach (SeasonCollection::findByTvshowId($tvshowId) as $season) {
    $titre = \Html\WebPage::escapeString($season->getName());
    $web->appendContent("<p>$titre</p>\n");
}
echo $web->toHTML();
