<?php

namespace App\Controller\Api\V1;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("/api/v1/events", name="api_v1_event")
 */
class EventController extends AbstractController
{
    /**
     * URL : /api/v1/events
     * Route : api_v1_event_index
     * 
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        
        $events = $eventRepository->findAll();
        // dd($events);
        return $this->json($events, 200, [], ['groups' => 'events_list']
        
    );
    }

    /**
     * 
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, EventRepository $eventRepository)
    {
        $event = $eventRepository->find($id);
        
        if(!$event) {
            return $this->json([
                'error' => 'L\'evenement ' . $id . ' n\'existe pas'
            ], 404);
        }

        return $this->json($event, 200, [], ['groups' => 'event_detail']
    );
    }

     /**
     * 
     * URL : /api/v1/events/
     *
     * 
     * @Route("/", name="add", methods={"POST"})
     * 
     * 
     */
    public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator)
    {
        // We get the json information
        $jsonData = $request->getContent();

        

        //We turn json data in object
        $event = $serialiser->deserialize($jsonData, Event::class, 'json');       

        // dd($event);

        //To save we call the manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        // dd($jsonData, $event);

        //We return an answer telling the ressource has been created with the 201 code.
        return $this->json($event, 201, [], ['groups' => 'event_detail']);

    }

    /**
     * Event update according to the id
     * 
     * @Route("/{id}", name="update", methods={"PUT", "PATCH"})
     *
     * @return void
     */
    public function update(int $id, EventRepository $eventRepository, Request $request, SerializerInterface $serialiser)
    {
        // We get datas reveived in JSON format
        $jsonData = $request->getContent();

        // We get the event for which the ID is $id
        $event = $eventRepository->find($id);

        if (!$event) {
            // if the event doesn't exist
            // We retrune the 404 page not found
            return $this->json(
                [
                    'errors' => [
                        'message' => 'L\'evenement ' . $id . ' n\'existe pas'
                    ]
                ],
                404
            );
        }


        $serialiser->deserialize($jsonData, Event::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $event]);

        // We call the manager to update de database
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'L\'evenement ' . $event->getName() . ' a bien été mise à jour'
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(int $id, EventRepository $eventRepository)
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            // The user doesn't exist
            return $this->json(
                [
                    'errors' => ['message' => 'L\'evenement ' . $id . ' n\'existe pas']
                ],
                404
            );
        }

        // We call the manager to delete the selected user
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();

        return $this->json([
            'message' => 'L\'evenement ' . $event->getName() . ' a bien été supprimé'
        ]);
    }

    
}
