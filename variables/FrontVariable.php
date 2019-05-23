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
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.front.mailboxes }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.front.mailboxes(twigValue) }}
     *
     * @return mixed
     */
    public function mailboxes()
    {
        return craft()->front_conversation->getMailboxes();
    }

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.front.conversations }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.front.conversations(twigValue) }}
     *
     * @return mixed
     */
    public function conversations()
    {
        return craft()->front_conversation->getConversations();
    }

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.front.getConversation }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.front.getConversation("cnv_12i1d6q") }}
     *
     * @param null $id
     * @return mixed
     */
    public function getConversation($id = null)
    {
        return craft()->front_conversation->getConversationById($id);
    }

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.front.getConversationMessages }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.front.getConversationMessages("cnv_12i1d6q") }}
     *
     * @param null $id
     * @return mixed
     */
    public function getConversationMessages($id = null)
    {
        return craft()->front_conversation->getConversationMessagesById($id);
    }

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.front.tags }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.front.tags(twigValue) }}
     *
     * @return mixed
     */
    public function tags()
    {
        return craft()->front_conversation->getTags();
    }
}