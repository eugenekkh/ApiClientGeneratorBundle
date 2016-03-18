<?php

namespace StudioSite\ApiClientGeneratorBundle\Template;

use StudioSite\ApiClientGeneratorBundle\Conventer;
use Symfony\Component\Filesystem\Filesystem;

abstract class Template
{
    /**
     * @var string
     */
    protected $auth;

    /**
     * @var Conventer
     */
    protected $conventer;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string[]
     */
    protected $skeletonDirs;

    abstract public function generate();

    /**
     * Get auth type
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Get instance symfony filesystem component
     *
     * @return Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Get root path for package
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set auth type
     *
     * @return string
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Filesystem $filesystem
     */
    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param Conventer $conventer
     */
    public function setConventer(Conventer $conventer)
    {
        $this->conventer = $conventer;
    }

    /**
     * Set root path for package
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->getFilesystem()->mkdir($path);
        $this->path = realpath($path);
    }

    /**
     * Sets an array of directories to look for templates.
     *
     * The directories must be sorted from the most specific to the most
     * directory.
     *
     * @param array $skeletonDirs An array of skeleton dirs
     */
    public function setSkeletonDirs($skeletonDirs)
    {
        $this->skeletonDirs = is_array($skeletonDirs) ? $skeletonDirs : array($skeletonDirs);
    }

    /**
     * Build absolute path to the target file
     * $target cannot be absolute
     *
     * @param string $target The path relative to the root
     *
     * @return string
     */
    protected function buildPath($target)
    {
        if ($this->getFilesystem()->isAbsolutePath($target))
            throw new \InvalidArgumentException("Target cannot be absolute");

        return $this->getPath() . DIRECTORY_SEPARATOR . $target;
    }


    protected function getMethods()
    {
        return $this->conventer->getMethods();
    }

    /**
     * Get the twig environment that will render skeletons.
     *
     * @return \Twig_Environment
     */
    protected function getTwigEnvironment()
    {
        return new \Twig_Environment(new \Twig_Loader_Filesystem($this->skeletonDirs), array(
            'debug' => true,
            'cache' => false,
            'strict_variables' => true,
            'autoescape' => false,
        ));
    }

    protected function render($template, $parameters)
    {
        $twig = $this->getTwigEnvironment();

        return $twig->render($template, $parameters);
    }

    protected function renderFile($template, $target, $parameters)
    {
        $filename = $this->buildPath($target);
        $content = $this->render($template, $parameters);
        $this->getFilesystem()->dumpFile($filename, $content);
    }
}
