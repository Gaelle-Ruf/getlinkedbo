public function add(Request $request, SerializerInterface $serialiser, ValidatorInterface $validator,  UserPasswordHasherInterface $passwordEncoder, EventRepository $eventRepository, CategoryRepository $categoryRepository, StyleRepository $styleRepository, CommentRepository $commentRepository, ParticipationRepository $participationRepository)
    {
        // We get the json information
        $jsonData = $request->getContent();   
        $data = json_decode($jsonData);
        $user = new User;
        $event = $eventRepository->find($data->events);
        $category = $categoryRepository->find($data->category);
        $style = $styleRepository->find($data->style);
        $comment = $commentRepository->find($data->comment);
        $participation = $participationRepository->find($data->participation);
        
        $user->setType($data->type);
        $user->setName($data->name);
        $user->setFirstname($data->firstname);
        $user->setLastname($data->lastname);
        $user->setDescription($data->description);
        $user->setEmail($data->email);
        $user->setPassword($data->password);

        $user->addEvent($event);
        $user->addCategory($category);
        $user->addStyle($style);
        $user->addComment($comment);
        $user->addParticipation($participation);