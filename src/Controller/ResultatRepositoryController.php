<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Resultat;
use App\Repository\ResultatRepository;

class ResultatRepositoryController extends AbstractController
{
    /**
     * @Route("/resultat/repository", name="resultat_repository")
     */
    public function index()
    {
        return $this->render('resultat_repository/index.html.twig', [
            'controller_name' => 'ResultatRepositoryController',
        ]);
    }

    /**
     * @Route("/resultat", name="resultat")
     * @param ResultatRepository $resultatRepository
     * @return |Symfony|Component|HttpFondation|Response
     */
    public function resultats (ResultatRepository $resultatRepository) {

        $resultats = $resultatRepository->findResultats(); // the function findResultats() has to be declared within ResultatRepository.php

        $message = [
            'text_message' => 'Résultats générales'
        ];

        return $this->render("resultat_repository/resultats.html.twig", [
            'resultats' => $resultats,
            'message' => $message
        ]);
    }

    /**
     * @Route("/resultat/general-hommes", name="resultat.general-hommes")
     * @param ResultatRepository $resultatRepository
     * @return |Symfony|Component|HttpFondation|Response
     */
    public function resultats_general_hommes (ResultatRepository $resultatGeneralHommesRepository) {

        $resultats = $resultatGeneralHommesRepository->findResultatsGeneralHommes(); // the function findResultats() has to be declared within ResultatRepository.php

        $message = [
            'text_message' => 'Résultats générales hommes'
        ];

        return $this->render("resultat_repository/resultats.html.twig", [
            'resultats' => $resultats,
            'message' => $message
        ]);
    }

    /**
     * @Route("/resultat/general-femmes", name="resultat.general-femmes")
     * @param ResultatRepository $resultatRepository
     * @return |Symfony|Component|HttpFondation|Response
     */
    public function resultats_general_femmes (ResultatRepository $resultatGeneralFemmesRepository) {

        $resultats = $resultatGeneralFemmesRepository->findResultatsGeneralFemmes(); // the function findResultats() has to be declared within ResultatRepository.php

        $message = [
            'text_message' => 'Résultats générales femmes'
        ];

        return $this->render("resultat_repository/resultats.html.twig", [
            'resultats' => $resultats,
            'message' => $message
        ]);
    }

    /**
     * @Route("/resultat/M1M", name="resultat.M1M")
     * @param ResultatRepository $resultatRepository
     * @return |Symfony|Component|HttpFondation|Response
     */
    public function resultats_M1M (ResultatRepository $resultatM1M) {

        $resultats = $resultatM1M->findResultatsM1M(); // the function findResultats() has to be declared within ResultatRepository.php

        $message = [
            'text_message' => 'Résultats de la categorie M1M'
        ];

        return $this->render("resultat_repository/resultats.html.twig", [
            'resultats' => $resultats,
            'message' => $message
        ]);
    }

    /**
     * @Route("/resultat/M1F", name="resultat.M1F")
     * @param ResultatRepository $resultatRepository
     * @return |Symfony|Component|HttpFondation|Response
     */
    public function resultats_M1F (ResultatRepository $resultatM1F) {

        $resultats = $resultatM1F->findResultatsM1F(); // the function findResultats() has to be declared within ResultatRepository.php

        $message = [
            'text_message' => 'Résultats de la categorie M1F'
        ];

        return $this->render("resultat_repository/resultats.html.twig", [
            'resultats' => $resultats,
            'message' => $message
        ]);
    }
}
