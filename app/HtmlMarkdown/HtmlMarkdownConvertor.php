<?php
namespace App\HtmlMarkdown;

use Michelf\MarkdownExtra;
use Purifier;
use League\HTMLToMarkdown\HtmlConverter;

class HtmlMarkdownConvertor
{
    protected $htmlConverter;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlConverter = new HtmlConverter();

        $this->markdownParser = new MarkdownExtra();
        $this->markdownParser->no_markup = true;
    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlConverter->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $html = $this->markdownParser->transform($markdown);
        return Purifier::clean($html, 'markdown');
    }
}
