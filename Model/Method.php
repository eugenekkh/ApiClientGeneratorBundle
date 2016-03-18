<?php

namespace StudioSite\ApiClientGeneratorBundle\Model;

class Method
{
    /**
     * @var Argument[]
     */
    protected $arguments = array();

    /**
     * @var string[]
     */
    protected $filters = array();

    /**
     * @var string[]
     */
    protected $parameters = array();

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var boolean
     */
    protected $deprecated = false;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $uri;

    public function addArgument(Argument $argument)
    {
        $this->arguments[] = $argument;

        return $this;
    }

    public function addFilter($filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    public function addParameter($parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * @return Argument[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return boolean
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }

    /**
     * @return string[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
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
     * @param boolean
     *
     * @return Method
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    /**
     * @param string
     *
     * @return Method
     */
    public function setMethod($method)
    {
        $this->method = $method;

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
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }
}
