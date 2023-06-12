<?php
require_once 'View.php';

class ViewAll extends View {
    
    public function __construct() {
        parent::__construct(dirname(dirname(__DIR__)) .'/view/templates/ViewAll.php');
    }
    
}