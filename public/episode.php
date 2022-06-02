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
$web->setTitle("Séries TV : " . $tvshow->getName() ." ". $season->getName());
$web->appendContent("<p class='encadretitle'><img src=poster.php?posterId={$season->getPosterId()}>{$web::escapeString($season->getName())}<a href='season.php?tvshowId={$tvshow->getId()}'>{$web::escapeString($tvshow->getName())}</a></p>");

foreach (EpisodeCollection::findBySeasonId($seasonId) as $episode) {
    $titre = \Html\WebPage::escapeString($episode->getName());
    $web->appendContent("<div class='encadreepisode'><p class='titreepisode'>$titre</p>");
    $web->appendContent("<p class='desc'>{$web::escapeString($episode->getOverview())}</p>");
}
echo $web->toHTML();
