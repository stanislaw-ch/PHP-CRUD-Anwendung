<?php
require_once "classes/views/Modules.php";

class NotFoundPage extends Modules {
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