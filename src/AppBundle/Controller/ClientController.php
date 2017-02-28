<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;

class ClientController extends Controller
{
    /**
     * @Route("/", name="blog")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Post')
            ->getAllPublished();
            
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            5    
            );
            
        return $this->render('client/index.html.twig', array(
            'posts' => $pagination,
            'menu' => 1
        ));
    }
    
    /**
     * @Route("/post/{id}", name="show_post")
     */
    public function showPostAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')
            ->findOneBy(array('id' => $id));
        $comments = $em->getRepository('AppBundle:Comment')
            ->findBy(array('post' => $post),array('createdAt' => 'DESC'));     
        return $this->render('client/post_show.html.twig', array(
            'post' => $post,
            'comments' => $comments,
            'menu' => 1
        ));
    }
}
