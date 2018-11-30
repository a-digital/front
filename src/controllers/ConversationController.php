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

/**
 * Conversation Controller
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
class ConversationController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/front/conversation
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Craft::$app->getRequest();
        $method = $request->getParam('redirect');
        Front::$plugin->conversation->conversationReply($request);
		$method = $request->getParam('success');
        return $this->redirect($method);
    }

    /**
     * Handle a request going to our plugin's actionCreateNew URL,
     * e.g.: actions/front/conversation/submit-widget
     *
     * @return mixed
     */
    public function actionSubmitWidget()
    {
        $request = Craft::$app->getRequest();
        Front::$plugin->conversation->conversationReply($request);
        $response = '<p>Success:</p><p>Thank you for submitting a message with us. You can <a href="/'.Craft::$app->getConfig()->cpTrigger.'/front" target="_blank">view your conversations here</a> and we shall get back to you shortly with a response.</p>';
        return $response;
    }

    /**
     * Handle a request going to our plugin's actionCreateNew URL,
     * e.g.: actions/front/conversation/create-new
     *
     * @return mixed
     */
    public function actionCreateNew()
    {
        $request = Craft::$app->getRequest();
        Front::$plugin->conversation->conversationReply($request);
        return $this->redirect("/".Craft::$app->getConfig()->general->cpTrigger."/front");
    }

    /**
     * Handle a request going to our plugin's actionAddReply URL,
     * e.g.: actions/front/conversation/add-reply
     *
     * @return mixed
     */
    public function actionAddReply()
    {
        $request = Craft::$app->getRequest();
        $id = $request->getParam('conversation');
        Front::$plugin->conversation->conversationReply($request);
        return $this->redirect("/".Craft::$app->getConfig()->general->cpTrigger."/front/conversation/".$id);
    }
}
