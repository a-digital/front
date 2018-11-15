# Front plugin for Craft CMS 3.x

Integration with Front

## Requirements

This plugin requires [Craft CMS](https://github.com/craftcms/cms) 3.0.0-beta.23 or later.

This plugin also requires [Redactor](https://github.com/craftcms/redactor) 1.0.0-beta.1 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require adigital/front

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Front.

## Front Overview

If you're using [Front](https://frontapp.com/) to manage your shared inboxes, this plugin will allow your customers to create new conversations with you via a dashboard widget. Replies can also be added to existing conversations within the CMS.

## Configuring Front

*Settings* - You will need to enter your JSON Web Token into the settings page once installed. You can get your JSON web token directly from Front (go to > Plugins & API > API).

Once your JSON Web Token has been saved, you will need to go back into your settings page and select which inbox you wish to send messages to. This is a two step process because the inboxes can only be loaded once your token has been saved.

*Tags* - If you want users to be able to select tags to be added to a message, these tags can be configured in a config file. Just copy the config.php file to crafts config folder and rename it Front.php. Any options added will then appear in a dropdown for users to select when creating a conversation.

*Redactor* - We are using the redactor field in this plugin and a custom redactor config can be created for this. Just move the redactor.json file into crafts config redactor folder and rename it Front.json. If you fail to do this then the default config will be used.

## Using Front

You can add the widget to the dashboard to allow users to create a new conversation via a form.

Alternatively you can allow access to the plugin within a users permissions, they will be then see Front in the sidebar navigation. This section will then show all of the latest conversations using the logged in users email address. A new conversation can be added or a conversation can be viewed by clicking on the subject.

Once inside a conversation, you will see dates, recipients, the original senders address, and the message contents. By default the most recent message is expanded and all of the others are collapsed. You can click on a messages header to expand or collapse it.

You can also click the "Reply" button at the bottom of the most recent message to display a form where you can add a new message. By default this message will be sent from the logged in users email address to all of the previous recipients using the mailbox you specified on your plugin settings page.

Brought to you by [A Digital](https://adigital.agency)
