<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointSurveillanceController extends AbstractController
{
    /**
     * @Route("/point/surveillance", name="point_surveillance")
     */
    public function index(): Response
    {
        return $this->render('point_surveillance/index.html.twig', [
            'controller_name' => 'PointSurveillanceController',
        ]);
    }
}
