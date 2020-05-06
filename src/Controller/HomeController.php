<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/home", name="home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
          'controller_name' => 'HomeController',
        ]);
    }

    //first example of passing a parameter within the URL
    /**
     * @Route("/helloFirstUser/{name?}", name="hello_first_user")
     */
    public function helloFirstUser(Request $request)
    {
        //request
        $name = $request->get('name');
        return $this->render('home/greet.html.twig', [
            'name' => $name
        ]);
    }

    //second example of passing a parameter within the URL
    /**
     * @Route("/helloSecondUser/{name}", name="hello_second_user")
     */
    public function helloSecondUser(Request $request, $name)
    {
        //request
        return $this->render('home/greet.html.twig', [
            'name' => $name
        ]);
    }
}
