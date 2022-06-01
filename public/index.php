<?php
declare(strict_types=1);


use Database\MyPdo;
use Html\WebPage;
use Entity\Collection\SeasonCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');

$series = \Entity\Collection\TvshowCollection::findAll();

$webPage->appendContent(
    <<<HTML
    <div class="list">\n
    HTML
);

foreach ($series as $index => $serie) {
    $webPage->appendContent(
        <<<HTML
    <p> <img src="poster.php?posterId={$serie->getPosterId()}"> <a href="season.php?tvshowId={$serie->getId()}">{$webPage::escapeString($serie->getName())}.{$webPage::escapeString($serie->getOverview())}</a></p>
    HTML
    );
}
$webPage->appendContent(
    <<<HTML
    </div>\n
    HTML
);

echo $webPage->toHTML();

