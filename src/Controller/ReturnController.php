<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ReturnController extends AbstractController
{

    protected function returnOne(object $object, int $code = 200) :object
    {

        //Serialize
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        //JSon
        $jsonContent = $serializer->serialize($object, 'json');
        return new Response($jsonContent,$code = 200);
    }
    
    protected function returnCollection(array $array, int $code = 200) :object
    {

        //Serialize
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        //JSon
        $jsonContent = $serializer->serialize($array, 'json');
        return new Response($jsonContent,$code = 200);
    }
    
    protected function returnError(string $description, int $code = 404) :object
    {
        return new Response($description,$code);
    }
}
