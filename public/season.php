<?php

declare(strict_types=1);

use Html\AppWebPage;
use Entity\Season;

$seasonId = intval($_GET['seasonId']);

$web = new \Html\AppWebPage();
$season =