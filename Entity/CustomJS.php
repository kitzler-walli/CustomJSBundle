<?php

/*
 * This file is part of the Kimai CustomJSBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\CustomJSBundle\Entity;

class CustomJS
{
    private $CustomJS = '';

    /**
     * @return string
     */
    public function getCustomJS(): string
    {
        return $this->CustomJS;
    }

    /**
     * @param string|null $CustomJS
     * @return CustomJS
     */
    public function setCustomJS(string $CustomJS = null)
    {
        if (null === $CustomJS) {
            $CustomJS = '';
        }

        $this->CustomJS = $CustomJS;
        return $this;
    }

}
