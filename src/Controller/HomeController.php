<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\Post;

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
        $person = [
            'name' => 'Joe',
            'lastname' => 'Malin',
            'age' => '44'
        ];

        /******* inserting data into the database ********/
        $post = new Post(); // this is the entity
        $post->setTitle('linux media');
        $post->setDescription('Media for linux devices undergoing change');

        // call Entity Manager to deal with the database
        $em = $this->getDoctrine()->getManager();

        // retrieving from the db
        $retrievedData = $em->getRepository(Post::class)->findOneBy([
            'id' => 1
        ]);

        // create sql query
        //$em->persist($post);

        // execute sql query
        //$em->flush();
        /******* END inserting data into the database ********/

        $form = $this->createFormBuilder()
            ->add('fullname', TextType::class)
            ->add('my_file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Select the file to upload'])
            ->getForm();

        return $this->render('home/greet.html.twig', [
            'name' => $name,
            'person' => $person,
            'post' => $retrievedData,
            'first_form' => $form->createView()
        ]);
    }
}
