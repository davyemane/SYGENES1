<?php

namespace App\Controller;

use App\Entity\EC;
use App\Entity\UE;
use App\Form\EcType;
use App\Form\UeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/ue')]
class UeController extends AbstractController
{
    #[Route('/add/ue', name: 'add_ue')]
    public function addUe(): Response
    {
        $ue = new UE();
        $form =$this->createForm(UeType::class, $ue);
        return $this->render('ue/createUe.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/add/ec', name: 'add_ec')]
    public function addEc(): Response
    {
        $ec = new EC();
        $form =$this->createForm(EcType::class, $ec);
        return $this->render('ue/createEC.html.twig', ['form' => $form->createView()]);
    }

}
