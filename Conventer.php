<?php

namespace StudioSite\ApiClientGeneratorBundle;

use Doctrine\Common\Util\Inflector;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Nelmio\ApiDocBundle\Extractor\ApiDocExtractor;
use StudioSite\ApiClientGeneratorBundle\Model\Argument;
use StudioSite\ApiClientGeneratorBundle\Model\Method;

class Conventer
{
    private $extractor;
    private $routePrefix;

    public function __construct(ApiDocExtractor $extractor)
    {
        $this->extractor = $extractor;
    }

    public function getMethods()
    {
        $methods = array();

        foreach ($this->extractor->all() as $item) {
            $annotation = $item['annotation'];

            $method = new Method();
            $method
                ->setDeprecated($annotation->getDeprecated())
                ->setDescription($annotation->getDescription())
                ->setMethod($annotation->getMethod())
                ->setName($this->getName($annotation))
                ->setUri($this->getUri($annotation))
            ;

            foreach ($annotation->getRequirements() as $key => &$value) {
                $argument = new Argument();
                $argument
                    ->setDescription($value['description'])
                    ->setName($key)
                    ->setType($value['dataType'])
                ;
                $method->addArgument($argument);
            }

            foreach ($annotation->getParameters() as $key => &$value) {
                $method->addParameter($key);
            }

            foreach ($annotation->getFilters() as $key => &$value) {
                $method->addFilter($key);
            }

            $methods[] = $method;
        }

        usort($methods, function ($a, $b) {
            $a = $a->getUri() . $a->getMethod();
            $b = $b->getUri() . $b->getMethod();
            return strnatcmp($a, $b);
        });

        return $methods;
    }

    /**
     * @param string $routePrefix
     */
    public function setRoutePrefix($routePrefix)
    {
        $this->routePrefix = $routePrefix;
    }

    protected function getName(ApiDoc $annotation)
    {
        $name = array();

        if ($annotation->getMethod()) {
            $name[] = strtolower($annotation->getMethod());
        }

        $name[] = $this->buildName($annotation);

        $name = implode(" ", $name);
        return Inflector::camelize(Inflector::classify($name));
    }

    protected function getUri(ApiDoc $annotation)
    {
        return $annotation->getRoute()->getPath();
    }

    protected function buildName(ApiDoc $annotation)
    {
        $routeCompiled = $annotation->getRoute()->compile();
        $staticPrefix = $routeCompiled->getStaticPrefix();
        $staticPrefix = $this->removePrefix($staticPrefix);
        return str_replace("/", " ", $staticPrefix);
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    protected function removePrefix($uri)
    {
        if ($this->routePrefix)
            $uri = str_replace($this->routePrefix, "", $uri);

        return $uri;
    }
}
