<?php

namespace App\Controller;

use App\Entity\DvdType;
use App\Form\DvdTypeType;
use App\Repository\DvdTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DvdTypeController extends AbstractController
{
    /**
     * @Route("/dvds/type", name="dvd_type_list")
     *
     * @param DvdTypeRepository $repository
     *
     * @return Response
     */
    public function index(DvdTypeRepository $repository)
    {
        return $this->render('dvd_type/index.html.twig', [
            'types' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("dvds/type/new", name="dvd_type_create")
     *
     * @param Request                $request
     * @param EntityManagerInterface $manager
     *
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $dvdType = new DvdType();
        $form = $this->createForm(DvdTypeType::class, $dvdType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($dvdType);
            $manager->flush();

            $this->addFlash(
                'success',
                "La catégorie <strong>{$dvdType->getName()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('dvd_type_list');
        }

        return $this->render('dvd_type/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dvds/type/edit/{id}", name="dvd_type_edit")
     *
     * @param DvdType                $type
     * @param Request                $request
     * @param EntityManagerInterface $manager
     *
     * @return Response
     */
    public function edit(DvdType $type, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(DvdTypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($type);
            $manager->flush();

            $this->addFlash(
                'success',
                "La catégorie <strong>{$type->getName()}</strong> a bien été modifiée !"
            );

            return $this->redirectToRoute('dvd_type_list');
        }

        return $this->render('dvd_type/edit.html.twig', [
            'form' => $form->createView(),
            'type' => $type,
        ]);
    }

    /**
     * @Route("/dvd/type/delete/{id}", name="dvd_type_delete")
     *
     * @param DvdType                    $type
     * @param EntityManagerInterface $manager
     *
     * @return RedirectResponse
     */
    public function delete(DvdType $type, EntityManagerInterface $manager)
    {
        $manager->remove($type);
        $manager->flush();

        $this->addFlash(
            'success',
            "La catégorie <strong>{$type->getName()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('dvd_type_list');
    }
}
