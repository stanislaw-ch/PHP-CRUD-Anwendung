<?php
require_once "src/views/Page.php";

class NotFoundPage extends Page
{
    public function getTitle(): string
    {
        return "Page not found";
    }

    public function getMiddle(): string
    {
        $sr['title'] = $this->getTitle();
        $sr['error'] = 'Page not found';

        return $this->getReplaceTemplate($sr, "notFound");
    }
}