<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;

/**
 * Description of LoadPostData
 *
 * @author Boguc
 */
class LoadPostData implements FixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        for ($i=1; $i<=17; $i++){
            
            $post = new Post();
            $post->setTitle($faker->sentence(3));
            $post->setContent($faker->text(300));
            $post->setCreatedAt($faker->dateTimeThisMonth);
            $post->setStatus(1);
            
            $manager->persist($post);
        }
        
        $manager->flush();
    }
}
