<?php
/**
 * Front plugin for Craft CMS 3.x
 *
 * Integration with Front
 *
 * @link      https://adigital.agency
 * @copyright Copyright (c) 2018 A Digital
 */

namespace adigital\front\models;

use adigital\front\Front;

use Craft;
use craft\base\Model;

/**
 * Front Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    A Digital
 * @package   Front
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $pluginName = 'Support';
    public $supportCompanyLogo = [];
    public $jsonWebToken = '';
    public $inbox = '';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['pluginName', 'string'],
            ['pluginName', 'default', 'value' => 'Support'],
            ['jsonWebToken', 'string'],
            ['jsonWebToken', 'default', 'value' => ''],
            ['inbox', 'string'],
            ['inbox', 'default', 'value' => '']
        ];
    }
}
