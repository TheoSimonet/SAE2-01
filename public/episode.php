<?php
declare(strict_types=1);

use Html\AppWebPage;
use Entity\Season;
use Entity\Episode;
use Entity\Collection\EpisodeCollection;

$seasonId = intval($_GET['seasonId']);

$web = new AppWebPage();
$season = Season::findById($seasonId);