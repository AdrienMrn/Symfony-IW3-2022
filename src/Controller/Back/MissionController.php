<?php

namespace App\Controller\Back;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mission')]
class MissionController extends AbstractController
{
    /**
     * @param MissionRepository $missionRepository
     * @return Response
     */
    #[Route('/', name: 'mission_index', methods: ['GET'])]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('back/mission/index.html.twig', [
            'missions' => $missionRepository->findAll()
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/create', name: 'mission_create', methods: ['GET', 'POST'])]
    public function create(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('admin_mission_show', ['id' => $mission->getId()]);
        }

        return $this->render('back/mission/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/{id}/update', name: 'mission_update', requirements: ['id' => '\d'], methods: ['GET', 'POST'])]
    public function update(Mission $mission, Request $request, MissionRepository $missionRepository): Response
    {
        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('admin_mission_show', ['id' => $mission->getId()]);
        }

        return $this->render('back/mission/update.html.twig', [
            'form' => $form->createView(),
            'mission' => $mission
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/{id}', name: 'mission_show', requirements: ['id' => '\d'], methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('back/mission/show.html.twig', [
            'mission' => $mission
        ]);
    }

    /**
     * @param Mission $mission
     * @return Response
     */
    #[Route('/{id}/delete/{token}', name: 'mission_delete', requirements: ['id' => '\d'], methods: ['GET'])]
    public function delete(Mission $mission, $token, MissionRepository $missionRepository): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $mission->getId(), $token)) {
            throw $this->createAccessDeniedException('Error token!');
        }

        $missionRepository->remove($mission, true);

        return $this->redirectToRoute('admin_mission_index');
    }
}
