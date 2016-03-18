<?php

namespace StudioSite\ApiClientGeneratorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('studiosite:api-client-gen:templates')
            ->setDescription('Show available api templates')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $templateManager = $this->getContainer()->get("ss_api_client_gen.template_manager");

        $output->writeln('<comment>Available templates:</comment>');
        $list = $templateManager->getDescriptions();
        foreach ($list as $alias => $description) {
            $output->writeln(sprintf("  <fg=green>%s</> %s", $alias, $description));
        }
    }
}
