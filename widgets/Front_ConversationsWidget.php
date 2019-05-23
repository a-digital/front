<?php
/**
 * Front plugin for Craft CMS
 *
 * Front_Conversations Widget
 *
 * --snip--
 * Dashboard widgets allow you to display information in the Admin CP Dashboard.  Adding new types of widgets to
 * the dashboard couldn’t be easier in Craft
 *
 * https://craftcms.com/docs/plugins/widgets
 * --snip--
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */
namespace Craft;
class Front_ConversationsWidget extends BaseWidget
{
    /**
     * Returns the name of the widget name.
     *
     * @return mixed
     */
    public function getName()
    {
        return 'Front Conversations';
    }
    /**
     * getBodyHtml() does just what it says: it returns your widget’s body HTML. We recommend that you store the
     * actual HTML in a template, and load it via craft()->templates->render().
     *
     * @return mixed
     */
    public function getBodyHtml()
    {
        // Include our Javascript & CSS
        craft()->templates->includeCssResource('front/css/widgets/Front_ConversationsWidget.css');
        craft()->templates->includeJsResource('front/js/widgets/Front_ConversationsWidget.js');
        return craft()->templates->render('front/widgets/Front_ConversationsWidget_Body');
    }
    /**
     * Returns how many columns the widget will span in the Admin CP
     *
     * @return int
     */
    public function getColspan(): int
    {
        return 1;
    }
}