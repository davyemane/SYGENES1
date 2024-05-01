<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType; 
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/student')]
class StudentController extends AbstractController
{
    //list of all student
    #[Route('/list/{page?1}/{nbre?12}', name: 'list_student')]
    public function home(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository = $doctrine->getRepository(Student::class);
        $nbStudent = $repository->count([]);
        $nbPage = ceil($nbStudent/$nbre);
        $student=$repository->findBy([],[],$nbre, ($page -1)*$nbre);



        return $this->render('student/list.html.twig', [
            'students'=>$student, 
            'isPaginated'=>true,
            'nbPage'=>$nbPage,
            'page'=>$page,
            'nbre'=>$nbre
        
        ]);

    }

    //detail of one student
    #[Route('/listDetail/{id<\d+>}', name: 'detail_student')]
    public function details(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Student::class);
        if ($id) {
            $student=$repository->find($id);
            return $this->render('student/detail.html.twig', ['student'=>$student]);

        }
        $this->addFlash('error', "the user does not existe ");
        return $this->redirectToRoute('list_student');



    }


//update or add student
    #[Route('/add/{id?0}', name: 'add_student')]
    public function academicInscription($id, ManagerRegistry $doctrine, Request $request , SluggerInterface $slugger): Response
    {
        $studentDirectory = 'student_directory';
        $entityManager = $doctrine->getManager();
        
        // Vérifier si un ID d'étudiant a été fourni
        if ($id) {
            $student = $entityManager->getRepository(Student::class)->find($id);
        } else {
            $student = new Student();
        }
    
        $form = $this->createForm(StudentType::class, $student);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {

            //ici on recupere la photo du diplome
            $photoBac = $form->get('photoBac')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photoBac) {
                $originalFilename = pathinfo($photoBac->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoBac->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoBac->move($studentDirectory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $student->setAdmissionCertificate($newFilename);
            }

            //photo de l'acte de naissance 

            $Certificate = $form->get('Certificate')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($Certificate) {
                $originalFilename = pathinfo($Certificate->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$Certificate->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $Certificate->move($studentDirectory, $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $student->setBirthCertificate($newFilename);
            }



            $entityManager->persist($student);
            $entityManager->flush();
    
            $message = $id ? 'mis à jour' : 'ajouté';
            $this->addFlash('success', $student->getName() . " a été $message avec succès !");
    
            return $this->redirectToRoute("home_student");
        }
    
        return $this->render('student/accademicInscription.html.twig', ['form' => $form->createView()]);
    }


}
