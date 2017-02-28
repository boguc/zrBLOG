<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\PostType;
use AppBundle\Entity\Post;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->redirect('login');
        }else{
            
            $em = $this->getDoctrine()->getManager();
            $query = $em->getRepository('AppBundle:Post')
                ->getQueryOrderedByCreatedAt();
            
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->get('page', 1),
                5    
                );
            
            return $this->render('admin/index.html.twig', array(
                'posts' => $pagination
            ));
        }
    }
    
    /**
     * @Route("/admin/post/add", name="add_post")
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->redirect('login');
        }else{
            $user = $this->getUser();
            $post = new Post();
            $post->setUser($user);
            
            $form = $this->createForm(new PostType(), $post);
            $form->handleRequest($request);
            
            if ($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
                
                return $this->redirectToRoute('admin');
            }
            
            return $this->render('admin/form_post.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }
    
    /**
     * @Route("/admin/post/edit/{id}", name="edit_post")
     */
    public function editAction($id ,Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->redirect('login');
        }else{

            $em = $this->getDoctrine()->getManager();
            $post = $em->getRepository('AppBundle:Post')
                    ->findOneBy(array('id' => $id));
            
            $form = $this->createForm(new PostType(), $post);
            $form->handleRequest($request);
            
            if ($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
                
                return $this->redirectToRoute('admin');
            }
            
            return $this->render('admin/form_post.html.twig', array(
                'form' => $form->createView()
            ));  
        }
    }
    
    /**
     * @Route("/admin/post/delete/{id}", name="delete_post")
     */
    public function deleteAction($id ,Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->redirect('login');
        }else{

            $em = $this->getDoctrine()->getManager();
            $post = $em->getRepository('AppBundle:Post')
                    ->findOneBy(array('id' => $id));
            
            $post->delete();
            
        }
    }
}
