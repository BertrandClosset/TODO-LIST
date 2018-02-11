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
       $item = $em->getRepository("TaskBundle:Item")->find($id);
       if ($item === null){
        throw new NotFoundHttpException("The task with id ".$id." doesn't exist.");
        }
       return $this->render('TaskBundle:Item:view.html.twig', array('task'=>$item));
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
      $em = $this->getDoctrine()->getManager();
      $item = $em->getRepository("TaskBundle:Item")->find($id);
      if ($item === null){
        throw new NotFoundHttpException("The task with id ".$id." doesn't exist.");
      }
      $form = $this->get('form.factory')->create(ItemType::class, $item);
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->flush();
        $request->getSession()->getFlashBag()->add('message', 'The task was succesfully edited.');
        return $this->redirectToRoute('task_view', array('id'=>$item->getId()));
      } 

      return $this->render('TaskBundle:Item:edit.html.twig',array(
        'id'=>$id,
        'form'=>$form->createView()
      ));
    }

    public function deleteAction($id, Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $item = $em->getRepository("TaskBundle:Item")->find($id);
      if ($item === null){
        throw new NotFoundHttpException("The task with id ".$id." doesn't exist.");
      }
      $form = $this->get('form.factory')->create();  
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->remove($item);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', "The task was succesfully deleted.");
        return $this->redirectToRoute('task_homepage');
      }
      return $this->render('TaskBundle:Item:delete.html.twig',array('task'=>$item, 'form'=>$form->createView()));
    }
  }