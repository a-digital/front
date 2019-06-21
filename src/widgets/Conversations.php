<?php
/**
 * Front plugin for Craft CMS 3.x
 *
 * Integration with Front
 *
 * @link      https://adigital.agency
 * @copyright Copyright (c) 2018 A Digital
 */

namespace adigital\front\widgets;

use adigital\front\Front;
use adigital\front\assetbundles\conversationswidget\ConversationsWidgetAsset;

use Craft;
use craft\base\Widget;

/**
 * Front Widget
 *
 * Dashboard widgets allow you to display information in the Admin CP Dashboard.
 * Adding new types of widgets to the dashboard couldn’t be easier in Craft
 *
 * https://craftcms.com/docs/plugins/widgets
 *
 * @author    A Digital
 * @package   Front
 * @since     1.0.0
 */
class Conversations extends Widget
{

    // Static Methods
    // =========================================================================

    /**
     * Returns the display name of this class.
     *
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('front', 'Conversations');
    }

    /**
     * Returns the path to the widget’s SVG icon.
     *
     * @return string|null The path to the widget’s SVG icon
     */
    public static function iconPath()
    {
        return Craft::getAlias("@adigital/front/assetbundles/conversationswidget/dist/img/Conversations-icon.svg");
    }

    /**
     * Returns the widget’s maximum colspan.
     *
     * @return int|null The widget’s maximum colspan, if it has one
     */
    public static function maxColspan()
    {
        return null;
    }

    // Public Methods
    // =========================================================================

    /**
     * Returns the widget's body HTML.
     *
     * @return string|false The widget’s body HTML, or `false` if the widget
     *                      should not be visible. (If you don’t want the widget
     *                      to be selectable in the first place, use {@link isSelectable()}.)
     */
    public function getBodyHtml()
    {
        Craft::$app->getView()->registerAssetBundle(ConversationsWidgetAsset::class);

        return Craft::$app->getView()->renderTemplate(
            'front/_components/widgets/Conversations_body',
            [
                'settings' => Front::$plugin->getSettings()
            ]
        );
    }
}
