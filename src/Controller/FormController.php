<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;
use App\Entity\Resultat;
use Symfony\Component\HttpFoundation\Request;
use League\Csv\Reader;
use League\Csv\Statement;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

        $image = 'championnat_ski.jpg';

        //var_dump($post); -- values have been take from the form

        if($form->isSubmitted() && $form->isValid())
        {  
            //$file = $request->files->get('post')['my_file'];
            $excelFile = $form->get('my_file')->getData();

            //$fileExtension = substr($excelFile->getClientOriginalName(), -3); for csv files

            //var_dump(pathinfo($excelFile, PATHINFO_EXTENSION));

            $originalFilename = pathinfo($excelFile->getClientOriginalName(), PATHINFO_FILENAME);

            $newFilename = $originalFilename . '.' . $excelFile->guessExtension();
            //$newFilename = $originalFilename . '.' . $fileExtension; // for csv

            $uploads_directory = $this->getParameter('uploads_directory');

            $excelFile->move(
                $uploads_directory,
                $newFilename
            );

            // echo "<pre>";
            // var_dump($newFilename); die;
            $em = $this->getDoctrine()->getManager();
            //$em->persist($post);
            //$em->flush();
        }
        
        /** Below is a League CSV solution */
        //  $reader = Reader::createFromPath('../public/uploads/parcours_resultats.csv', 'r');
        //  $reader->setHeaderOffset(0);
        //$records = $reader->getRecords(['participants_id', 'categories_id', 'competitions_id', 'resultat1', 'resultat2', 'resultat_final', 'nom', 'ville']);
        //  var_dump($reader);
        //  $resultat = new Resultat();
        // foreach ($reader as $row) {
        //     $result = $resultat
        //         ->setParticipants($row['participants_id'])
        //         ->setCategories($row['categories_id'])
        //         ->setCompetitions($row['competitions_id'])
        //         ->setResultat1($row['resultat1'])
        //         ->setResultat2($row['resultat2'])
        //         ->setResultatFinal($row['resultat_final'])
        //         ->setNom($row['nom'])
        //         ->setVille($row['ville'])
        //     ;
        //     $this->em->persist($result);
        // }
        // $this->em-flush();
        /** End of the League CSV solution */

        /** Below is a PHPSpreadsheet solution */
        //require '../vendor/phpoffice/phpspreadsheet/samples/Header.php';
        $inputFileType = 'Xlsx';
        //$inputFileName = '../vendor/phpoffice/phpspreadsheet/samples/Reader/sampleData/example1.xls';
        //$inputFileName = '../public/uploads/parcours_resultats.xlsx';
        $inputFileName = '../public/uploads/participants.xlsx';

        //$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory with a defined reader type of ' . $inputFileType);
        $reader = IOFactory::createReader($inputFileType);
        //$helper->log('Turning Formatting off for Load');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        //var_dump($sheetData);

        $conn = new \mysqli("localhost", "root", "", "winter-contest");
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = '';
        //var_dump(count($sheetData));
        for($row = 1; $row <= count($sheetData); $row++) {
            $xx = "'" . implode("', '", $sheetData[$row]) . "'";
        //var_dump($xx);
        //$sql = "INSERT INTO resultat (participants_id, categories_id, competitions_id, resultat1, resultat2, resultat_final, nom, ville) VALUES ($xx); ";
        $sql = "INSERT INTO participant (nom_participant, prenom_participant, sexe, image, email, ville) VALUES ($xx);";
         }

        if($conn->query($sql) === 'TRUE') {
            echo "Row $row inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        /** End of PHPSpreadsheet solution */

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'post_form' => $form->createView()
        ]);
    }
}
