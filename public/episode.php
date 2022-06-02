<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Season;
use Entity\Episode;
use Entity\Collection\EpisodeCollection;

$seasonId = intval($_GET['seasonId']);
$web = new AppWebPage();

$season = Season::findById($seasonId);
$tvshow = \Entity\Tvshow::findById($season->getTvShowId());
$web->setTitle("Séries TV : " . $tvshow->getName() . $season->getName());

foreach (EpisodeCollection::findBySeasonId($seasonId) as $episode) {
    $titre = \Html\WebPage::escapeString($episode->getName());
    $web->appendContent("<p>$titre</p>");
}
echo $web->toHTML();
