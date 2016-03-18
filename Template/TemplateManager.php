<?php

namespace StudioSite\ApiClientGeneratorBundle\Template;

class TemplateManager
{
    private $templates = array();
    private $descriptions = array();

    /**
     * @param string $alias
     * @param TemplateInterface $template
     * @param string $description
     */
    public function add($alias, TemplateInterface $template, $description)
    {
        $this->descriptions[$alias] = $description;
        $this->templates[$alias] = $template;
    }

    public function get($alias)
    {
        return $this->templates[$alias];
    }

    public function getDescriptions()
    {
        return $this->descriptions;
    }
}
