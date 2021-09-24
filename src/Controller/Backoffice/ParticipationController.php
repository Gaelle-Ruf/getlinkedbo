<?php

namespace App\Controller\Backoffice;

use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/participation", name="backoffice_participation_", requirements={"id": "\d+"})
 */
class ParticipationController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(ParticipationRepository $participationRepository): Response
    {
        return $this->render('backoffice/participation/index.html.twig', [
            'participations' => $participationRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show")
     * @return Response
     */
    public function show(int $id, ParticipationRepository $participationRepository)
    {
        $participation = $participationRepository->find($id);
        if (!$participation) {
            throw $this->createNotFoundException('La participation ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/participation/show.html.twig', [
            'participation' => $participation
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @return Response
     */
    public function add(Request $request)
    {
        $participation = new Participation();
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->flush();
            $this->addFlash('success', 'La participation ' . $participation->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_participation_index');
        }
        return $this->render('backoffice/participation/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @return Response
     */
    public function edit(Participation $participation, Request $request)
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $participation->setUpdatedAt(new DateTimeImmutable());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La participation ' . $participation->getName() . ' a bien été modifiée');
            return $this->redirectToRoute('backoffice_participation_show', ['id' => $participation->getId()]);
        }
        return $this->render('backoffice/participation/edit.html.twig', ['formView' => $form->createView()]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @return Response
     */
    public function delete(Participation $participation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($participation);
        $em->flush();
        $this->addFlash('info', 'La participation ' . $participation->getName() . ' a bien été supprimée');
        return $this->redirectToRoute('backoffice_participation_index');
    }
}