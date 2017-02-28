<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Post;

class PublishPostCommand extends ContainerAwareCommand 
{
    protected function configure()
    {
        $this
            ->setName('blog:post:publish-postponed')
            ->setDescription('Publikuj posty')
            ->setHelp('Publikuj posty z opozniona data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $totalUpdated = $em->getRepository('AppBundle:Post')->getAllNotPublished();
    }
}