<?php
declare(strict_types=1);


use Database\MyPdo;
use Html\WebPage;
use Entity\Collection\SeasonCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');
$webPage->appendCssUrl("/css/style.css");

$series = \Entity\Collection\TvshowCollection::findAll();

$webPage->appendContent(
    <<<HTML
    <div class="list">\n
    HTML
);

foreach ($series as $index => $tvshow) {
    $webPage->appendContent(
        <<<HTML
    <p class="encadre"> <img class="poster" src=poster.php?posterId={$tvshow->getPosterId()}"> <a href="season.php?tvshowId={$tvshow->getId()}">{$webPage::escapeString($tvshow->getName())}.{$webPage::escapeString($tvshow->getOverview())}</a></p>
    HTML
    );
}
$webPage->appendContent(
    <<<HTML
    </div>\n
    HTML
);

echo $webPage->toHTML();

