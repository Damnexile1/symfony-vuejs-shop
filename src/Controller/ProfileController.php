<?php

namespace App\Controller;


use App\Form\EditProfileFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(): Response
    {
      return $this->render('main/profile/index.html.twig');
    }

   /**
   * @Route("/profile/edit", name="app_profile_edit")
   */
    public function editAction(Request $request): Response
    {
      $user = $this->getUser();
      $form = $this->createForm(EditProfileFormType::class, $user);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
//        dd($user);

        return $this->redirectToRoute('app_profile');
      }

      return $this->render('main/profile/edit.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
