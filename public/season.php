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
if ($tvshow->getPosterId() == null) {
    $src = "public/image/default.png";
} else {
    $src = "poster.php?posterId={$tvshow->getPosterId()}";
}
$a = "<div class =button> 
        <form action = 'http:localhost:8000'>
            <button type='submit'>retour</button>
        </form>
      </div>";
$web->setTitle("Séries TV : " . $tvshow->getName() . "$a");
$web->appendContent("<p class='encadretitle'><img class='postersaisonepisode' src= '{$src}'>{$web::escapeString($tvshow->getName())}  <br> {$web::escapeString($tvshow->getOverview())}</p>");

foreach (SeasonCollection::findByTvshowId($tvshowId) as $season) {
    $titre = \Html\WebPage::escapeString($season->getName());
    $web->appendContent("<a href='episode.php?seasonId={$season->getId()}'> <div class='encadreSeason'><p class='titreseason'>$titre\n </p>");
    $web->appendContent("<img class='posterSeason' src=poster.php?posterId={$season->getPosterId()}></div></a>");
}
echo $web->toHTML();
