<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    /**
     * @param MissionRepository $missionRepository
     * @return Response
     */
    #[Route('/mission', name: 'mission_index')]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAll()
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/mission/create', name: 'mission_create')]
    public function create(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('mission_show', ['id' => $mission->getId()]);
        }

        return $this->render('mission/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/mission/{id}', name: 'mission_show', requirements: ['id' => '\d'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission
        ]);
    }


}
