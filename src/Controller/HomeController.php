<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HomeController extends ToolsController
{
    protected $now;
    public function __construct() {
        parent::__construct();
    }
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $data = [
            'controller_name' => 'HomeController',
            'now' => date('Y-m-d H:i:s')
        ];
        return $this->render('home/index.html.twig', $data);
    }
    
    public function about($days,$months,$day_name)
    {
        echo $day_name;
        $data = [
            'controller_name' => 'HomeController',
            'now' => $this->now,
            'before' => $this->add_days($days,$months)
        ];
        return $this->render('home/about.html.twig', $data);        
    }
    
    public function redir()
    {
        //return $this->redirectToRoute('about',['days' => 15,'months' => 70, 'day_name' => 'lunes'],301);
        //return $this->redirectToRoute('home',[],302);
        return $this->redirect('https://www.udemy.com/course/master-en-php-sql-poo-mvc-laravel-symfony-4-wordpress/learn/lecture/11990082#overview',302);
    }
    
}
