<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Animal;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class AnimalController extends ReturnController
{
    
    public function index()
    {
        //Load repository
        $repo = $this->getDoctrine()->getRepository(Animal::class);
        //Search..
        $result = $repo->findAll();
        if(!$result){
            return $this->returnError("No data", 404);
        }
        
        //If API...
        //return $this->returnCollection($result, 200);  
        
        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'data' => $result
        ]);
    }
    
    public function save(): object
    {
        $entityManager = $this->getDoctrine()->getManager();

        $animal = new Animal();
        $animal->setType('DOGO');
        $animal->setColor('BLACK');
        $animal->setBreed('DOBERMAN');
        $animal->setAge(rand(1,12)); 

        //Persist object in doctrine (save it in memory, not in DB yet)
        $entityManager->persist($animal);
        
        //Save in DB
        $entityManager->flush();
        return $this->returnOne($animal, 200);
        //return new Response('Added, ID: ' . $animal->getId(),201);
    }
    
    public function get_by_id(int $id)
    {
        //Load repository
        $repo = $this->getDoctrine()->getRepository(Animal::class);
        //Search..
        $result = $repo->find($id);
        if(!$result){
            return $this->returnError("Animal '$id' not found", 404);
        }
        
        return $this->returnOne($result, 200);
    }
}
