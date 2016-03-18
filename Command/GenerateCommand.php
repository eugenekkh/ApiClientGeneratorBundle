<?php

namespace StudioSite\ApiClientGeneratorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('studiosite:api-client-gen:generate')
            ->setDescription('')
            ->addArgument(
                'template',
                InputArgument::REQUIRED,
                'Template name'
            )
            ->addOption(
               'path',
               null,
               InputOption::VALUE_REQUIRED,
               'Output path the generated package'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $templateManager = $container->get('ss_api_client_gen.template_manager');

        $template = $templateManager->get($input->getArgument('template'));

        $template->setPath($input->getOption('path'));
        $template->setSkeletonDirs(__DIR__.'/../Resources/skeleton');

        $template->generate();
    }
}
