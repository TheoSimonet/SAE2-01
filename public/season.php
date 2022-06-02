<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Season;
use Entity\Tvshow;
use Entity\Collection\SeasonCollection;

$tvshowId = intval($_GET['tvshowId']);

$web = new \Html\AppWebPage();
$web->appendCssUrl("/css/style.css");
$tvshow = Tvshow::findById($tvshowId);
$web->setTitle("Séries TV : " . $tvshow->getName());
$web->appendContent("<p class='encadretitle'><img src=poster.php?posterId={$tvshow->getPosterId()}>{$web::escapeString($tvshow->getName())}  <br> {$web::escapeString($tvshow->getOverview())}</p>");

foreach (SeasonCollection::findByTvshowId($tvshowId) as $season) {
    $titre = \Html\WebPage::escapeString($season->getName());
    $web->appendContent("<a href='episode.php?seasonId={$season->getId()}'> <div class='encadreSeason'><p class='titreseason'>$titre\n </p>");
    $web->appendContent("<img class='posterSeason' src=poster.php?posterId={$season->getPosterId()}></div></a>");
}
echo $web->toHTML();
