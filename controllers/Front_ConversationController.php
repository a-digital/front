<?php
/**
 * Front plugin for Craft CMS
 *
 * Front_Conversation Controller
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

class Front_ConversationController extends BaseController
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
        $request = Craft::$app->getRequest();
        $method = $request->getParam('redirect');
        craft()->front_conversation->conversationReply($request);
        $method = $request->getParam('success');
        return $this->redirect($method);
    }

    /**
     * Handle a request going to our plugin's submitWidget action URL, e.g.: actions/front/submit-widget
     *
     * @return string
     */
    public function actionSubmitWidget(): string
    {
        $request = Craft::$app->getRequest();
        craft()->front_conversation->conversationReply($request);
        $response = '<p>Success:</p><p>Thank you for submitting a message with us. You can <a href="/'.craft()->config->get("cpTrigger").'/front" target="_blank">view your conversations here</a> and we shall get back to you shortly with a response.</p>';
        return $response;
    }

    /**
     * Handle a request going to our plugin's createNew action URL, e.g.: actions/front/create-new
     *
     * @return mixed
     */
    public function actionCreateNew()
    {
        $request = Craft::$app->getRequest();
        craft()->front_conversation->conversationReply($request);
        return $this->redirect("/".craft()->config->get("cpTrigger")."/front");
    }

    /**
     * Handle a request going to our plugin's addReply action URL, e.g.: actions/front/add-reply
     *
     * @return mixed
     */
    public function actionAddReply()
    {
        $request = Craft::$app->getRequest();
        $id = $request->getParam('conversation');
        craft()->front_conversation->conversationReply($request);
        return $this->redirect("/".craft()->config->get("cpTrigger")."/front/conversation/".$id);
    }
}