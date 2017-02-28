<?php

namespace AppBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * @var post
     * 
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    private $post;

    /**
     * Add post
     *
     * @param \AppBundle\Entity\Post $post
     * @return User
     */
    public function addPost(\AppBundle\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \AppBundle\Entity\Post $post
     */
    public function removePost(\AppBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }
}
