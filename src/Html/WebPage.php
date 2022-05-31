<?php

namespace Html;

use DateTime;

class WebPage
{
    private string $head = "";
    private string $title = "";
    private string $body = "";

    public function __construct(string $title = "", string $head = "", string $body = "")
    {
        $this->setTitle($title);
    }

    public function getHead(): string
    {
        return $this->head;
    }

    public function setHead(string $head): void
    {
        $this->head = $head;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    public function appendCss(string $css): void
    {
        $css2 = '<style>' . $css . '</style>' . "\n";
        $this->appendToHead($css2);
    }

    public function appendCssUrl(string $url): void
    {
        $url2 = '<link href=' . $url . ' rel="stylesheet">';
        $this->appendToHead($url2);
    }

    public function appendJs(string $js): void
    {
        $js2 = '<script>' . $js . '</script>' . "\n";
        $this->appendToHead($js2);
    }

    public function appendJsUrl(string $url): void
    {
        $url2 = '<script src=' . $url . '></script>' . "\n";
        $this->appendToHead($url2);
    }

    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    public function toHTML(): string
    {
        $html = '<!doctype html>' . "\n";
        $html .= '<html lang="fr">' . "\n";
        $html .= '<head>';
        $html .= '<meta charset="utf-8">' . "\n";
        $html .= '<meta name="viewport" content="width=devmkdirice-width, initial-scale=1">' . "\n";
        $html .= '<title>' . $this->getTitle() . '</title>' . "\n";
        $html .= $this->getHead() . "\n" . '</head>' . "\n";
        $html .= '<body>' . "\n";
        $html .= $this->getBody();
        $html .= '<div style="display:flex; font-style: italic;flex-direction:row-reverse;">' . self::getLastModification() . '</div>' . '</body>' . "\n";
        $html .= '</html>';
        return $html;
    }

    public static function getLastModification(): string
    {
        $date = new DateTime();
        $date->setTimestamp(getlastmod());
        return "Dernière modification de cette page le " . date("d/m/Y", getlastmod()) . " à " . date("H:i:s", getlastmod());
    }

    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES, 'UTF-8');
    }
}
