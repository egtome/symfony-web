<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToolsController extends AbstractController
{
    protected $now;
    public function __construct() {
        $this->now = date('Y-m-d H:i:s');
    }
    
    protected function add_days($days,$months){
        return date('Y-m-d H:i:s', strtotime($this->now. " - $days days"));       
    }
}
