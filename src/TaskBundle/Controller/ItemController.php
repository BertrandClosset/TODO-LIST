<?php

namespace TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TaskBundle\Entity\Item;
use UserBundle\Entity\User;
use \Datetime;

class ItemController extends Controller
{
    public function indexAction()
    {
        return $this->render('TaskBundle:Item:index.html.twig');
    }

    public function viewAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       $advertRepository = $em->getRepository('OCPlatformBundle:Advert');
       return $this->render('TaskBundle:Item:view.html.twig', array('id'=>$id));
    }

    public function addAction(Request $request)
    {
      $date = new DateTime('2018-03-18');
      $item1 = new Item();
      $item1->setTitle("Third Task");
      $item1->setDescription("This is the description of my third task");
      $item1->setEndDate($date);
      $item1->setAchieved(false);

      $user = new User();
      $user->setLogin("bebertdu54");
      $user->setEmail("bibite@gmail.fr");

      $item1->setUser($user);

      // On récupère l'EntityManager
      $em = $this->getDoctrine()->getManager();

      // Étape 1 : On « persiste » l'entité
      $em->persist($item1);

   /*   $item2 = $em->getRepository('TaskBundle:Item')->find(1);
      $item2->setEndDate(new Datetime());*/
      // Étape 2 : On « flush » tout ce qui a été persisté avant
      $em->flush();
      if ($request->isMethod('POST')){
        $id = mt_rand(0,20); 
        $request->getSession()->getFlashBag()->add('message', 'Tâche créée correctement');
        return $this->redirectToRoute('task_view', array('id'=>$id));

      }
       return $this->render('TaskBundle:Item:add.html.twig'); 
    }

    public function editAction($id, Request $request)
    {

      if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('message', 'Tâche modifiée correctement');
        return $this->redirectToRoute('task_view', array('id'=>$id));
      } 

      return $this->render('TaskBundle:Item:edit.html.twig',array('id'=>$id));
    }

    public function deleteAction($id, Request $request)
    {
        return $this->render('TaskBundle:Item:delete.html.twig',array('id'=>$id));
    }
}