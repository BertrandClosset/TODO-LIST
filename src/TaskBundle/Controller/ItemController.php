<?php

namespace TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TaskBundle\Entity\Item;
use UserBundle\Entity\User;
use \Datetime;
use TaskBundle\Form\ItemType;

class ItemController extends Controller
{
    public function indexAction()
    {
        return $this->render('TaskBundle:Item:index.html.twig');
    }

    public function viewAction($id)
    {
       $em = $this->getDoctrine()->getManager();
       return $this->render('TaskBundle:Item:view.html.twig', array('id'=>$id));
    }

    public function addAction(Request $request)
    {
      $item = new Item();
      $form = $this->get('form.factory')->create(ItemType::class, $item);
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
        $em = $this->getDoctrine()->getManager();
        $item->setAchieved(false);
        $em->persist($item);
        $em->flush(); 
        $request->getSession()->getFlashBag()->add('message', 'Tâche créée correctement');
        return $this->redirectToRoute('task_view', array('id'=>$item->getId()));

      }
       return $this->render('TaskBundle:Item:add.html.twig', array('form'=>$form->createView())); 
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