<?php

namespace App\Controller;


use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Property;

class ShopController extends AbstractController
{

    public function __construct(PropertyRepository $repository, ObjectManager $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/shop", name="shop")
     *
     */
    public function index()
    {
       $property = $this->repository->findAll();
        return $this->render('shop/index.html.twig', [
            'current_menu' => 'Shop',
            'properties' => $property
        ]);
    }

    /**
     *@Route("/shop/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show($slug, $id): response {
        $property = $this->repository->find($id);
        return $this->render('shop/show.html.twig', [
            'property' => $property,
            'current_menu' => 'Shop'
        ]);
    }
}
