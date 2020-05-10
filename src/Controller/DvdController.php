<?php

namespace App\Controller;

use App\Entity\Dvd;
use App\Form\DvdType;
use App\Repository\DvdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DvdController extends AbstractController
{
    /**
     * @Route("/dvds", name="dvd_list")
     *
     * @param DvdRepository $repository
     *
     * @return Response
     */
    public function index(DvdRepository $repository): Response
    {
        return $this->render('dvd/index.html.twig', [
            'dvds' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/dvds/new", name="dvd_create")
     *
     * @param Request                $request
     * @param EntityManagerInterface $manager
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $dvd = new Dvd();
        $form = $this->createForm(DvdType::class, $dvd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($dvd);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le DVD <strong>{$dvd->getTitle()}</strong> a bien été enregistré !"
            );

            return $this->redirectToRoute('dvd_list');
        }

        return $this->render('dvd/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dvds/edit/{id}", name="dvd_edit")
     *
     * @param Dvd                    $dvd
     * @param Request                $request
     * @param EntityManagerInterface $manager
     *
     * @return Response
     */
    public function edit(Dvd $dvd, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(DvdType::class, $dvd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($dvd);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le DVD <strong>{$dvd->getTitle()}</strong> a bien été modifié !"
            );

            return $this->redirectToRoute('dvd_list');
        }

        return $this->render('dvd/edit.html.twig', [
            'form' => $form->createView(),
            'dvd' => $dvd,
        ]);
    }

    /**
     * @Route("/dvd/delete/{id}", name="dvd_delete")
     *
     * @param Dvd                    $dvd
     * @param EntityManagerInterface $manager
     *
     * @return RedirectResponse
     */
    public function delete(Dvd $dvd, EntityManagerInterface $manager)
    {
        $manager->remove($dvd);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le DVD <strong>{$dvd->getTitle()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute('dvd_list');
    }
}
