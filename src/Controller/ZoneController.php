<?php

namespace App\Controller;

use App\Entity\Zone;
use App\Form\ZoneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZoneController extends AbstractController
{
    /**
     * @Route("/zone", name="zone")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $listzone = $entityManager->getRepository(Zone::class)->findAll();
        $entityManager->flush();

        return $this->render('zone/index.html.twig', [
            'listzone' => $listzone,
        ]);
    }

    /**
     * @Route("/zone/add", name="addZone")
     */
    public function add(Request $request): Response
    {
        $zone = new Zone();

        $form = $this->createForm(ZoneType::class, $zone);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zone);
            $entityManager->flush();

            $zone = new Zone();

            $form = $this->createForm(ZoneType::class, $zone);

        }

    
        return $this->render('zone/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/zone/list", name="listZone")
     */
    public function list(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $listzone = $entityManager->getRepository(Zone::class)->findAll();
        $entityManager->flush();

        return $this->render('zone/index.html.twig', [
            'listzone' => $listzone,
        ]);
    }

    /**
     * @Route("/zone/edit/{id}", name="editZone")
     */
    public function edit($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $zone = $entityManager->getRepository(Zone::class)->find($id);
        $entityManager->flush();
        return $this->render('zone/edit.html.twig', [
            'zone' => $zone,
        ]);
    }

    /**
     * @Route("/zone/udpate", name="updateZone")
     */
    public function update(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $zone = $entityManager->getRepository(Zone::class)->find($_POST['id']);
        $zone->setNom($_POST['nom']);
        $pays = $zone->getPays($_POST['pays']);
        $zone->setPays($pays);
        $entityManager->flush();

        return $this->redirectToRoute('listZone');
    }
    /**
     * @Route("/zone/delete/{id}", name="deleteZone")
     */
    public function delete($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $zone = $entityManager->getRepository(Zone::class)->find($id);
        $entityManager->remove($zone);
        $entityManager->flush();
        return $this->redirectToRoute('listZone');
    }

}
