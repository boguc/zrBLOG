<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;


class CommentController extends Controller
{
    /**
     * @Route("/post/comment/add", name="add_comment")
     */
    public function commentAddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $author = $request->query->get('author');
        $email = $request->query->get('email'); 
        $content = $request->query->get('content');
        $postID = $request->query->get('post_id');
        
        $post = $em->getRepository('AppBundle:Post')
            ->findOneBy(array('id' => $postID));
        
        $comment = new Comment();
        $comment->setPost($post);
        $comment->setAuthor($author);
        $comment->setContent($content);
        $comment->setEmail($email);
        $comment->setCreatedAt(new \DateTime('now'));
        
        $em->persist($comment);
        $em->flush();
        
        $view = $this->renderView(
            'client/comment_item.html.twig',
            array('comment' => $comment)
        );
        
        $response = new JsonResponse();
        return $response->setData(array(
            'comment_html' => $view
        ));
        
    }
}
