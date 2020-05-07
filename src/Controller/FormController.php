<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        $post = new Post();
        /** this is to populate the form manually */
        //$post->setTitle('Welcome');
        //$post->setDescription('Description is 255 long');
        
        /** this is to populate the form directly from the database */
        //$em = $this->getDoctrine()->getManager();
        // $retrievedData = $em->getRepository(Post::class)->findOneBy([
        //     'id' => 1
        // ]); now it follows either persist or remove and flush

        /** we pass the data, either $post or $retrievedData, to the form */
        //$form = $this->createForm(PostType::class, $retrievedData);
        //$form = $this->createForm(PostType::class, $post);
        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('form'),
            //'method' => 'GET'
        ]);

        //var_dump($post); -- values are null

        $form->handleRequest($request);

        //var_dump($post); -- values have been take from the form

        if($form->isSubmitted() && $form->isValid())
        {
            //var_dump($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'post_form' => $form->createView()
        ]);
    }
}
