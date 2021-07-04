<?php

/*
 * This file is part of the Kimai CustomJSBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\CustomJSBundle\Repository;

use KimaiPlugin\CustomJSBundle\Entity\CustomJS;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class CustomJSRepository
{
    /**
     * @var string
     */
    protected $jsFile;
    /**
     * @var string
     */
    protected $ruleSetDir;

    /**
     * @param string $pluginDirectory
     */
    public function __construct(string $pluginDirectory, string $dataDirectory)
    {
        $this->ruleSetDir = $pluginDirectory . '/CustomJSBundle/Resources/ruleset';
        $this->jsFile = $dataDirectory . '/custom-js-bundle.js';
    }

    /**
     * @param CustomJS $entity
     * @return bool
     * @throws \Exception
     */
    public function saveCustomJS(CustomJS $entity)
    {
        if (file_exists($this->jsFile) && !is_writable($this->jsFile)) {
            throw new \Exception('JS file is not writable: ' . $this->jsFile);
        }

        if (false === file_put_contents($this->jsFile, $entity->getCustomJS())) {
            throw new \Exception('Failed saving custom js to file: ' . $this->jsFile);
        }

        return true;
    }

    /**
     * @return CustomJS
     */
    public function getCustomJS()
    {
        $entity = new CustomJS();

        if (file_exists($this->jsFile) && is_readable($this->jsFile)) {
            $entity->setCustomJS(file_get_contents($this->jsFile));
        }

        return $entity;
    }
}
