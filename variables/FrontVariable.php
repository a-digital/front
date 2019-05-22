<?php
/**
 * Front plugin for Craft CMS
 *
 * Front Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */

namespace Craft;

class FrontVariable
{
    /**
     * Whatever you want to output to a Twig template can go into a Variable method. You can have as many variable
     * functions as you want.  From any Twig template, call it like this:
     *
     *     {{ craft.front.exampleVariable }}
     *
     * Or, if your variable requires input from Twig:
     *
     *     {{ craft.front.exampleVariable(twigValue) }}
     */
    public function exampleVariable($optional = null)
    {
        return "And away we go to the Twig template...";
    }
}