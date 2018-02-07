<?php

namespace HeartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('HeartBundle:Home:index.html.twig');
    }
}
