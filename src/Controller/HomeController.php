<?php

namespace App\Controller;
use App\Entity\Media;
use App\Entity\Person;
use App\Repository\MediaRepository;
use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_index')]
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'media' => $mediaRepository->findBy([],["id"=>"DESC"],5),
        ]);
    }

    #[Route('/all_media', name: 'app_home_all')]
    public function allmedia(MediaRepository $mediaRepository): Response
    {
        return $this->render('home/all_media.html.twig', [
            'controller_name' => 'HomeController',
            'media' => $mediaRepository->findAll(),
        ]);
    } 
    #[Route('/person/{type}', name: 'app_home_person',methods: ['GET'])]
    public function allperson(MediaRepository $mediaRepository, PersonRepository $personRepository, string $type): Response
    {
        return $this->render('home/person.html.twig', [
            'controller_name' => 'HomeController',
            'persons' => $personRepository->findBy(["type"=>$type],[]),
        ]);
    } 
    
}
 