<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    private string $head;
    private string $title;
    private string $body;

    public function __contruct(string $title = "")
    {
        parent::__construct($title);
    }

    public function toHTML(): string
    {
        $html = "<!doctype html> \n";
        $html .= "<HTML LANG='fr'>\n"."<head> \n"."<meta charset='utf-8'> \n";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1'> \n";
        $html .= "<title>".$this->getTitle() . "</title> \n";
        $html .= $this->getHead() . "</head> \n"."<body> \n";
        $html .= "<header class='header'> <h1>".$this->getTitle()."</h1></header> \n";
        $html .= "<div class='content'> <main class='list'>" .$this->getBody()."\n </main></div>";
        $html .= "<footer class='footer'>". self::getLastModification() . "</footer>\n";
        $html .= "</body>\n"."</html>\n";
        return $html;
    }
}
