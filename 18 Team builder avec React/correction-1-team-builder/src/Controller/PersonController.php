<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/api/persons", name="getAllPersons", methods="GET")
     */
    public function getAll(PersonRepository $personRepository, SerializerInterface $serializer): JsonResponse
    {
        $allPersons = $personRepository->findAll();

        // not found //
        if (is_null($allPersons)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // send data //
        $jsonAllPersons = $serializer->serialize($allPersons, 'json', ['groups' => 'person']);
        return new JsonResponse($jsonAllPersons, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/persons/{id}", name="getOnePerson", methods="GET")
     */
    public function getOne(PersonRepository $personRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $person = $personRepository->find($id);

        // not found //
        if (is_null($person)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // send data //
        $jsonPerson = $serializer->serialize($person, 'json', ['groups' => 'person']);
        return new JsonResponse($jsonPerson, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/persons", name="addOnePerson", methods="POST")
     */
    public function addOne(PersonRepository $personRepository, TeamRepository $teamRepository, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $content = $request->toArray();
        $person = $serializer->deserialize($request->getContent(), Person::class, 'json');

        // firstName & lastName can't be null or empty //
        if (
            !array_key_exists('firstName', $content) ||
            !array_key_exists('lastName', $content) ||
            $content['firstName'] == "" ||
            $content['lastName'] == ""
        ) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
        }

        // if team, team must exists in DB //
        if (array_key_exists('team', $content)) {
            $teamId = $content['team'];
            $team = $teamRepository->find($teamId);

            if (is_null($team)) {
                return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
            }

            $person->setTeam($team);
        }

        $personRepository->add($person, true);

        // send data //
        $jsonPerson = $serializer->serialize($person, 'json', ['groups' => 'person']);
        return new JsonResponse($jsonPerson, Response::HTTP_CREATED, [], true);
    }

    /**
     * @Route("/api/persons/{id}", name="deleteOnePerson", methods="DELETE")
     */
    public function deleteOne(PersonRepository $personRepository, int $id): JsonResponse
    {
        $person = $personRepository->find($id);

        // not found //
        if (is_null($person)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        $personRepository->remove($person, true);

        // send reponse ok //
        return new JsonResponse(null, Response::HTTP_NO_CONTENT, [], false);
    }

    /**
     * @Route("/api/persons/{id}", name="updateOnePerson", methods="PATCH")
     */
    public function updateOne(PersonRepository $personRepository, TeamRepository $teamRepository, SerializerInterface $serializer, Request $request, int $id): JsonResponse
    {
        $content = $request->toArray();
        // $newPerson = $serializer->deserialize($request->getContent(), Person::class, 'json');
        $person = $personRepository->find($id);

        // not found //
        if (is_null($person)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // firstName & lastName & age if exists can't be empty //
        if (
            (array_key_exists('firstName', $content) &&  $content['firstName'] == "") ||
            (array_key_exists('lastName', $content) && $content['lastName'] == "") ||
            (array_key_exists('age', $content) && $content['age'] == "")
        ) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
        }

        // if team, team must exists in DB //
        if (array_key_exists('team', $content) && !is_null($content['team'])) {
            $teamId = $content['team'];
            $team = $teamRepository->find($teamId);

            if (is_null($team)) {
                return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
            }

            $content['team'] = $team;
        }

        // custom method, update only new data //
        $personRepository->update($person, $content, true);

        // send data //
        $jsonPerson = $serializer->serialize($person, 'json', ['groups' => 'person']);
        return new JsonResponse($jsonPerson, Response::HTTP_OK, [], true);
    }
}
