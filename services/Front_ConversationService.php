<?php
/**
 * Front plugin for Craft CMS
 *
 * Front_Conversation Service
 *
 * --snip--
 * All of your plugin’s business logic should go in services, including saving data, retrieving data, etc. They
 * provide APIs that your controllers, template variables, and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 * --snip--
 *
 * @author    A Digital
 * @copyright Copyright (c) 2019 A Digital
 * @link      https://adigital.agency
 * @package   Front
 * @since     0.0.1
 */

namespace Craft;

class Front_ConversationService extends BaseApplicationComponent
{
    /**
     * This function can literally be anything you want, and you can have as many service functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     craft()->front_conversation->getMailboxes()
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        $method = 'inboxes';
        $data = $this->curlWrap($method);
        $returned = [
            'mailboxes' => '',
            'error' => ''
        ];
        if (isset($data->_error)) {
            $returned['error'] = $data->_error;
        } else {
            $returned['mailboxes'] = $data->_results;
        }
        return $returned;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->getMailboxById()
     *
     * @param $id
     * @return mixed
     */
    public function getMailboxById($id)
    {
        $method = 'inboxes/'.$id.'/channels';
        $data = $this->curlWrap($method);
        if (isset($data->_error)) {
            return false;
        }
        if (is_array($data->_results)) {
            return $data->_results[0]->send_as;
        }
        return $data->_results->send_as;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->getConversations()
     *
     * @return mixed
     */
    public function getConversations()
    {
        $email = Craft::$app->user->identity->email;
        $method = 'contacts/alt:email:'.$email.'/conversations';
        $data = $this->curlWrap($method);
        $returned = [
            'conversations' => '',
            'error' => ''
        ];
        if (isset($data->_error)) {
            $returned['error'] = $data->_error;
        } else {
            $returned['conversations'] = $data->_results;
        }
        return $returned;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->getConversationById()
     *
     * @param $id
     * @return mixed
     */
    public function getConversationById($id)
    {
        $method = 'conversations/'.$id;
        return $this->curlWrap($method);
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->getConversationMessagesById()
     *
     * @param $id
     * @return mixed
     */
    public function getConversationMessagesById($id)
    {
        $method = 'conversations/'.$id.'/messages';
        $data = $this->curlWrap($method);
        $returned = [
            'messages' => '',
            'error' => ''
        ];
        if (isset($data->_error)) {
            $returned['error'] = $data->_error;
        } else {
            $returned['messages'] = $data->_results;
        }
        return $returned;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->getTags()
     *
     * @return mixed
     */
    public function getTags()
    {
        // get from config file
        // return to template

        $config = Craft::$app->getConfig()->getConfigFromFile("front");
        if (!$config) {
            return false;
        }

        $options = [
            [
                'label' => "Please select...",
                'value' => ''
            ]
        ];

        foreach($config['tags'] as $tag) {
            $options[] = [
                'label' => $tag,
                'value' => $tag
            ];
        }

        return $options;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->conversationReply()
     *
     * @param $request
     * @return mixed
     */
    public function conversationReply($request)
    {
        $settings = Front::$plugin->getSettings();
        $method = 'inboxes/'.$settings->inbox.'/imported_messages';
        $mailbox = self::getMailboxById($settings->inbox);
        $userId = '';
        $userEmail = '';
        $userFirstName = '';
        $userLastName = '';
        if (Craft::$app->user->identity) {
            $userId = Craft::$app->user->identity->id;
            $userEmail = Craft::$app->user->identity->email;
            $userName = Craft::$app->user->identity->firstName.' '.Craft::$app->user->identity->lastName;
        } else {
            $userId = 'guest';
            $userEmail = $request->getParam('email');
            $userName = $request->getParam('name');
        }
        if ($mailbox === false) {
            return false;
        }
        $body = $request->getParam('body');
        if (is_array($body)) {
            $formattedBody = "";
            foreach($body as $field => $value) {
                if (isset($value) && $value <> '') {
                    if (is_numeric($field)) {
                        $formattedBody .= '<p>'.$value.'</p>';
                    } else {
                        $field = ucwords(preg_replace('~(\p{Ll})(\p{Lu})~u','${1} ${2}', $field));
                        $formattedBody .= '<p>'.$field.": ".$value.'</p>';
                    }
                }
            }
            $body = $formattedBody;
        }
        $posted = [
            'sender' => [
                'handle' => $userEmail,
                'name' => $userName
            ],
            'to' => [
                $mailbox
            ],
            'subject' => $request->getParam('subject'),
            'body' => $body,
            'body_format' => 'html',
            'external_id' => date('Y-m-d H:i:s').' '.$userId,
            'created_at' => time(),
            'metadata' => [
                'is_inbound' => true,
                'is_archived' => false,
                'thread_ref' => $userEmail.' - '.$request->getParam('subject')
            ]
        ];
        $tag = $request->getParam('tag');
        if (isset($tag) && $tag <> '') {
            $posted['tags'] = [$tag];
        }
        if (count($_FILES)) {
            $data = $this->curlImage($method, $_FILES, $posted);
        } else {
            $data = $this->curlWrap($method, json_encode($posted));
        }
        return $data;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->curlWrap()
     *
     * @param $method
     * @param null $request
     * @return mixed
     */
    public function curlWrap($method, $request = null)
    {
        $settings = Front::$plugin->getSettings();
        $webToken = $settings->jsonWebToken;

        $host = 'api2.frontapp.com';

        $headers = [
            'Host: '.$host,
            'Authorization: Bearer '.$webToken,
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.$host.'/'.$method);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($request !== null) {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        }
        $output = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($output);
        return $decoded;
    }

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Front::$plugin->conversation->curlImage()
     *
     * @param $method
     * @param $attachments
     * @param null $request
     * @return mixed
     */
    public function curlImage($method, $attachments, $request = null)
    {
        $settings = Front::$plugin->getSettings();
        $webToken = $settings->jsonWebToken;

        $host = 'api2.frontapp.com';

        $delimiter = 'RandomBoundaryString';
        $eol = "\r\n";

        $headers = [
            'Host: '.$host,
            'Authorization: Bearer '.$webToken,
            'Content-Type: multipart/form-data; boundary='.$delimiter
        ];

        $files = [];
        foreach ($attachments["attachments"]["name"] as $key => $filename) {
            $file = $attachments["attachments"]["tmp_name"][$key];
            if (isset($file) && $file <> '') {
                $files[$filename] = $file;
            }
        }

        $post_data = '';
        foreach ($request as $name => $content) {
            if (is_array($content)) {
                foreach ($content as $key => $val) {
                    if (is_bool($val)) {
                        $val = ($val) ? 'true' : 'false';
                    }
                    $post_data .= "--" . $delimiter . $eol
                        .'Content-Disposition: form-data; name="'.$name.'['.$key.']"'.$eol.$eol
                        .$val.$eol;
                }
            } else {
                $post_data .= "--" . $delimiter . $eol
                    .'Content-Disposition: form-data; name="'.$name.'"'.$eol.$eol
                    .$content.$eol;
            }
        }
        $count = 0;
        foreach ($files as $filename => $filedata) {
            $post_data .= "--".$delimiter.$eol
                .'Content-Disposition: form-data; name="attachments['.$count.']"; filename="'.$filename.'"'.$eol
                .'Content-Type: '.mime_content_type($filedata).$eol.$eol
                .file_get_contents($filedata).$eol;
            $count++;
        }
        $post_data .= "--".$delimiter."--";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://'.$host.'/'.$method);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($request !== null) {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        $output = curl_exec($ch);
        curl_close($ch);

        $decoded = json_decode($output);
        return $decoded;
    }
}