<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use App\Form\ResultatType;
use App\Entity\Resultat;
use Symfony\Component\HttpFoundation\Request;
use League\Csv\Reader;

class AdminInsererResultatsController extends AbstractController
{
    /**
     * @Route("/admin/inserer-resultats", name="admin_inserer_resultats")
     */
    public function index(Request $request)
    {
        $resultat = new Resultat();

        

        return $this->render('admin_inserer_resultats/index.html.twig', [
            'controller_name' => 'AdminInsererResultatsController',
        ]);
    }
}
