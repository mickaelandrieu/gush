<?php

/**
 * This file is part of Gush.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gush\Template;

/**
 * @author Daniel Leech <daniel@dantleech.com>
 */
abstract class AbstractTemplate implements TemplateInterface
{
    /**
     * @var null
     */
    protected $parameters = null;

    /**
     * {@inheritDoc}
     */
    public function bind($parameters)
    {
        $this->parameters = $parameters;

        $requirements = $this->getRequirements();

        foreach ($requirements as $key => $requirementData) {
            list(, $default) = $requirementData;

            if (!isset($this->parameters[$key])) {
                $this->parameters[$key] = $default;
            }
        }
    }

    /**
     * @param string $string
     * @param array  $tokens
     *
     * @return string
     */
    protected function replaceTokens($string, array $tokens)
    {
        foreach ($tokens as $key => $value) {
            $string = str_replace('{{ '.$key.' }}', $value, $string);
        }

        return $string;
    }
}
