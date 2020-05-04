<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Animal;
use App\Repository\AnimalRepository;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class AnimalController extends ReturnController
{
    
    public function test_search(int $id)
    {
        //Repos
        $repo = $this->getDoctrine()->getRepository(Animal::class);
        $res = $repo->gimmeGreens('green');
        echo '<pre>';var_dump($res); die();        
        
        //Load repository
        $repo = $this->getDoctrine()->getRepository(Animal::class);
        
        #ALL
        $result = $repo->findAll();
        
        #ONE BY (WHERE COND LIMIT 1)
        $result = $repo->findOneBy(['color' => 'green']);
        
        #BY (WHERE COND NO LIMIT ORDER BY ID DESC)
        $result = $repo->findBy(['color' => 'green'],['id' => 'ASC']);
        
        #QUERY BUILDER - CUSTOM QUERY
        $qb = $repo->createQueryBuilder('a')
                ->andWhere("a.color = :color")
                ->setPArameter('color','light brown')
                ->orderBy('a.color','ASC')
                ->getQuery();
        $elres = $qb->execute();
        
        #PURE SQL
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM animals WHERE color IS NOT NULL AND color = :color AND age <= :age;';
        $prepare = $conn->prepare($sql);
        $prepare->execute(['color' => 'black','age' => 2]);
        $r = $prepare->fetchAll();
        
        echo '<pre>';var_dump($r); die();
        
        return $this->render('animal/void.twig', []);        
    }
    
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
    
    public function get_by_id(Animal $animal)
    {
//        //Load repository
//        $repo = $this->getDoctrine()->getRepository(Animal::class);
//        //Search..
//        $result = $repo->find($id);
//        if(!$result){
//            return $this->returnError("Animal '$id' not found", 404);
//        }
        
        return $this->returnOne($animal, 200);
    }
    
    public function update(int $id)
    {
        //Load doctrine (ORM)
        $doctrine = $this->getDoctrine();
        
        //Load entity manager (insert / update in DB)
        $em = $doctrine->getManager();
        
        //Load animal repo
        $repo = $em->getRepository(Animal::class);
        
        //Get object to update
        $animal = $repo->find($id);
        
        //Check
        if(!$animal){
            $message = 'Animal not found';
        }else{
            $message = 'Updated animal ' . $id;
            //Assign values
            $animal->setType('chicken'. $id);
            $animal->setColor('yellow');
            
            //Persist info (not neccesary)
            $em->persist($animal);
            
            //Save in DB
            $em->flush();
        }
        //echo '<pre>';var_dump($id); die();
        return new Response($message);
    }
    
    public function delete(Animal $animal){
        //Load doctrine (ORM)
        $em = $this->getDoctrine()->getManager();
        
        if($animal && is_object($animal)){
            $message = 'Item  ' . $animal->getId() . ' deleted';
            
            //REMOVE JUST FROM DOCTRINE CACHE
            $em->remove($animal);

            //REMOVE PERMANENTLY
            $em->flush();
        }else{
            $message = 'Item  ' . $id . ' not found';
        }
        
        

        return new Response($message);
    }
}
