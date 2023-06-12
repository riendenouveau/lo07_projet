<?php

class View {

    protected $template;

    public function __construct($template) {
        $this->template = $template;
    }

    public function render($data) {
        extract($data);
        include $this->template;
    }

}
