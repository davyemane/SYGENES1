<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/inscription', name: 'app_student')]
    public function academicInscription(): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        return $this->render('student/accademicInscription.html.twig', ['form' => $form->createView()]);
    }
}
