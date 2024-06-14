<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\PersonRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TeamController extends AbstractController
{
    /**
     * @Route("/api/teams", name="getAllTeam", methods="GET")
     */
    public function getAll(TeamRepository $teamRepository, SerializerInterface $serializer): JsonResponse
    {
        $teams = $teamRepository->findAll();

        // not found //
        if (is_null($teams)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // send data //
        $jsonTeams = $serializer->serialize($teams, 'json', ['groups' => 'team']);
        return new JsonResponse($jsonTeams, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/teams/{id}", name="getOneTeam", methods="GET")
     */
    public function getOne(TeamRepository $teamRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $team = $teamRepository->find($id);

        // not found //
        if (is_null($team)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // send data //
        $jsonTeam = $serializer->serialize($team, 'json', ['groups' => 'team']);
        return new JsonResponse($jsonTeam, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/teams", name="addOneTeam", methods="POST")
     */
    public function addOne(TeamRepository $teamRepository, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $team = $serializer->deserialize($request->getContent(), Team::class, 'json');

        // name can't be null or empty //
        if (is_null($team->getName()) || $team->getName() == "") {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
        }

        $teamRepository->add($team, true);

        // send data //
        $jsonTeam = $serializer->serialize($team, 'json', ['groups' => 'team']);
        return new JsonResponse($jsonTeam, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/teams/{id}", name="deleteOneTeam", methods="DELETE")
     */
    public function deleteOne(TeamRepository $teamRepository, PersonRepository $personRepository, int $id): JsonResponse
    {
        $team = $teamRepository->find($id);

        // not found //
        if (is_null($team)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // cascade nullify Person->team before deleting team //
        foreach ($team->getPersons() as $personId) {
            $person = $personRepository->find($personId);
            $personRepository->update($person, ["team" => null], true);
        }

        $teamRepository->remove($team, true);

        // send response ok //
        return new JsonResponse(null, Response::HTTP_NO_CONTENT, [], false);
    }

    /**
     * @Route("/api/teams/{id}", name="updateOneTeam", methods="PATCH")
     */
    public function updateOne(TeamRepository $teamRepository, SerializerInterface $serializer, Request $request, int $id): JsonResponse
    {
        $content = $request->toArray();
        $team = $teamRepository->find($id);

        // not found //
        if (is_null($team)) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND, [], false);
        }

        // name is required and can't be empty //
        if (
            !array_key_exists('name', $content)  ||
            $content['name'] == ""
        ) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST, [], false);
        }

        // custom method, update only new data //
        $teamRepository->update($team, $content, true);

        // send data //
        $jsonTeam = $serializer->serialize($team, 'json', ['groups' => 'team']);
        return new JsonResponse($jsonTeam, Response::HTTP_OK, [], true);
    }
}
