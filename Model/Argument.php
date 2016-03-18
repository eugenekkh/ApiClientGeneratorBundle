<?php

namespace StudioSite\ApiClientGeneratorBundle\Model;

class Argument
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string
     *
     * @return Method
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string
     *
     * @return Method
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string
     *
     * @return Method
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
