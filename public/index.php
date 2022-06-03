<?php
declare(strict_types=1);


use Database\MyPdo;
use Html\WebPage;
use Entity\Collection\SeasonCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();
$webPage->setTitle('Séries TV');
$webPage->appendCssUrl("/css/style.css");

if (isset($_GET["Filtre"]) && ctype_digit($_GET["Filtre"]) && $_GET["Filtre"] != '0') {
    $series = \Entity\Collection\GenreCollection::findAll((int)$_GET["Filtre"]);
} else {
    $series = \Entity\Collection\TvshowCollection::findAll();
}

$header = <<<HTML
    <form action="index.php" method="get">
        FILTRE :
        <select name="Filtre" size="1">
            <option value="0">Tous les genres</option>
            <option value="1">Action & Aventure</option>
            <option value="2">Crime</option>
            <option value="3">Drame</option>
            <option value="4">Comédie</option>
            <option value="5">Science-Fiction & Fantastique</option>
            <option value="6">Mystère</option>
            <option value="7">Western</option>
            <option value="8">War & Politics</option>
            <option value="9">Familial</option>
            <option value="10">Animation</option>
            <option value="11">Romance</option>
        </select>
        <button type="submit"> Appliquer </button>
    </form>
HTML;

$webPage->appendContent($header);

$webPage->appendContent(
    <<<HTML
    <div class="list">\n
    HTML
);

foreach ($series as $index => $tvshow) {
    if ($tvshow->getPosterId() == null) {
        $src = "public/image/default.png";
    } else {
        $src = "poster.php?posterId={$tvshow->getPosterId()}";
    }

    $webPage->appendContent(
        <<<HTML
    <p class="encadre"> <img class="poster" src='{$src}'"> <a href="season.php?tvshowId={$tvshow->getId()}">{$webPage::escapeString($tvshow->getName())}.{$webPage::escapeString($tvshow->getOverview())}</a></p>
    HTML
    );
}
$webPage->appendContent(
    <<<HTML
    </div>\n
    HTML
);

echo $webPage->toHTML();

