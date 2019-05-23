<?php
/**
 * Front plugin for Craft CMS
 *
 * Front_Cp Controller
 *
 * --snip--
 * Generally speaking, controllers are the middlemen between the front end of the CP/website and your plugin’s
 * services. They contain action methods which handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering post data, saving it on a model,
 * passing the model off to a service, and then responding to the request appropriately depending on the service
 * method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what the method does (for example,
 * actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 * --snip--
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */

namespace Craft;
use Craft\UrlHelper;

class Front_CpController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/front
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $variables = [];
        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::getCpUrl('front')
            ]
        ];

        return $this->renderTemplate('front/index', $variables);
    }

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/front/conversation
     *
     * @param array $variables
     * @return mixed
     */
    public function actionConversation(array $variables = array())
    {
        if (empty($variables['conversationId'])) {
            $variables['conversationId'] = 'overview';
        }

        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::getCpUrl('front')
            ],
            [
                'label' => "Conversations",
                'url' => UrlHelper::getCpUrl('front')
            ]
        ];

        return $this->renderTemplate('front/conversation/detail', $variables);
    }

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/front/newConversation
     *
     * @return mixed
     */
    public function actionNewConversation()
    {
        $variables = [];
        $variables['crumbs'] = [
            [
                'label' => "Front",
                'url' => UrlHelper::getCpUrl('front')
            ],
            [
                'label' => "Conversations",
                'url' => UrlHelper::getCpUrl('front')
            ]
        ];

        return $this->renderTemplate('front/conversation/new', $variables);
    }
}