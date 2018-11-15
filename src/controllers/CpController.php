<?php
/**
 * Front plugin for Craft CMS 3.x
 *
 * Integration with Front
 *
 * @link      https://adigital.agency
 * @copyright Copyright (c) 2018 A Digital
 */

namespace adigital\front\controllers;

use adigital\front\Front;

use Craft;
use craft\web\Controller;
use craft\helpers\UrlHelper;

/**
 * Cp Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    A Digital
 * @package   Front
 * @since     1.0.0
 */
class CpController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/front/cp
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $variables = [];
        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::cpUrl('front')
            ]
        ];

        return $this->renderTemplate('front/index', $variables);
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/front/cp/do-something
     *
     * @return mixed
     */
    public function actionConversation(string $subSection = 'overview')
    {
        $variables = [];
        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::cpUrl('front')
            ],
            [
                'label' => "Conversations",
                'url' => UrlHelper::cpUrl('front')
            ]
        ];

        $variables["conversationId"] = $subSection;

        return $this->renderTemplate('front/conversation/detail', $variables);
    }

    /**
     * Handle a request going to our plugin's actionNewConversation URL,
     * e.g.: actions/front/cp/new-conversation
     *
     * @return mixed
     */
    public function actionNewConversation()
    {
        $variables = [];
        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::cpUrl('front')
            ],
            [
                'label' => "Conversations",
                'url' => UrlHelper::cpUrl('front')
            ]
        ];

        return $this->renderTemplate('front/conversation/new', $variables);
    }
}
