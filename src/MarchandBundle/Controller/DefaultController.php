<?php

namespace MarchandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MarchandBundle:Default:index.html.twig');
    }
}
