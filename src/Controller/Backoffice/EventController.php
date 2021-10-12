<?php

namespace App\Controller\Backoffice;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/event", name="backoffice_event_", requirements={"id": "\d+"})
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('backoffice/event/index.html.twig', [
            'events' => $eventRepository->findAll(),]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, EventRepository $eventRepository)
    {
        $event = $eventRepository->find($id);
        if (!$event) {
            throw $this->createNotFoundException('L\'événement ' . $id . ' n\'existe pas');
        }
        return $this->render('backoffice/event/show.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $this->addFlash('success', 'L\'événement ' . $event->getName() . ' a bien été créée');
            return $this->redirectToRoute('backoffice_event_index');
        }
        return $this->render('backoffice/event/add.html.twig', [
            'formView' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Event $event, Request $request)
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->getName();/* setUpdatedAt(new DateTimeImmutable()) */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\événement ' . $event->getName() . ' a bien été modifié');

            return $this->redirectToRoute('backoffice_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/event/edit.html.twig', [
            'event' => $event,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     */
    public function delete(Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        $this->addFlash('info', 'L\événement ' . $event->getName() . ' a bien été supprimé');
        return $this->redirectToRoute('backoffice_event_index');
    }
}