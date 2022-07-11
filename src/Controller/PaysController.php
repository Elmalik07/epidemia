<?php

namespace App\Controller;

use App\Entity\Pays;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="pays")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $listpays = $entityManager->getRepository(Pays::class)->findAll();
        $entityManager->flush();
        return $this->render('pays/index.html.twig', [
            'listpays' => $listpays,
        ]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/pays/add", name="addPays")
     */
    public function add(): Response
    {
        if(isset($_POST['envoyer'])) {
            $pays = new Pays();
            $entityManager = $this->getDoctrine()->getManager();
            $pays->setNom($_POST['nom']);
            $entityManager->persist($pays);
            $entityManager->flush();
        }
        return $this->render('pays/add.html.twig', [
            'controller_name' => 'PaysController',
        ]);
    }

    /**
     * @Route("/pays/list", name="listPays")
     */
    public function list(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $listpays = $entityManager->getRepository(Pays::class)->findAll();
        $entityManager->flush();
        return $this->render('pays/index.html.twig', [
            'listpays' => $listpays,
        ]);
    }

    /**
     * @Route("/pays/edit/{id}", name="editPays")
     */
    public function edit($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pays = $entityManager->getRepository(Pays::class)->find($id);
        $entityManager->flush();
        return $this->render('pays/edit.html.twig', [
            'pays' => $pays,
        ]);
    }

    /**
     * @Route("/pays/udpate", name="updatePays")
     */
    public function update(): Response
    {
        if(isset($_POST['modifier'])) {
            $entityManager = $this->getDoctrine()->getManager();
            $pays = $entityManager->getRepository(Pays::class)->find($_POST['id']);
            $pays->setNom($_POST['nom']);
            $entityManager->flush();
        }
        return $this->redirectToRoute('listPays');
    }

    /**
     * @Route("/pays/delete/{id}", name="deletePays")
     */
    public function delete($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pays = $entityManager->getRepository(Pays::class)->find($id);
        $entityManager->remove($pays);
        $entityManager->flush();

        return $this->redirectToRoute('listPays');
    }





    
}
