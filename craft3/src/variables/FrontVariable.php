<?php
/**
 * Front plugin for Craft CMS 3.x
 *
 * Integration with Front
 *
 * @link      https://adigital.agency
 * @copyright Copyright (c) 2018 A Digital
 */

namespace adigital\front\variables;

use adigital\front\Front;

use Craft;
use craft\redactor\Field;

/**
 * Front Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.front }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    A Digital
 * @package   Front
 * @since     1.0.0
 */
class FrontVariable
{
    // Public Methods
    // =========================================================================

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
     * @param null $optional
     * @return string
     */
    public function mailboxes()
    {
        return Front::$plugin->conversation->getMailboxes();
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
     * @param null $optional
     * @return string
     */
    public function conversations()
    {
        return Front::$plugin->conversation->getConversations();
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
     * @return string
     */
    public function getConversation($id = null)
    {
        return Front::$plugin->conversation->getConversationById($id);
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
     * @return string
     */
    public function getConversationMessages($id = null)
    {
        return Front::$plugin->conversation->getConversationMessagesById($id);
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
     * @param null $optional
     * @return string
     */
    public function tags()
    {
        return Front::$plugin->conversation->getTags();
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
     * @param null $optional
     * @return string
     */
    public function redactorField($options = null)
    {
        $field = new Field;
        $field->handle = $options['name'];
        $field->redactorConfig = 'Front.json';
        $redactorField = $field->getInputHtml($options['value']);

        return '<div class="field">
            <div class="heading">
                <label>'.$options['label'].'</label>
                <div class="instructions">
                    <p>'.$options['instructions'].'</p>
                </div>
            </div>
            <div class="input ltr">
                '.$redactorField.'
            </div>
        </div>';
    }
}
