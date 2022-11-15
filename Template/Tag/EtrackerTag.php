<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Tag;

use Piwik\Piwik;
use Piwik\Settings\FieldConfig;
use Piwik\Validators\NotEmpty;
use Piwik\Validators\CharacterLength;
use Piwik\Validators\NumberRange;

class EtrackerTag extends BaseTag
{
    const PARAM_ETRACKER_CONFIG = 'etrackerConfig';

    public function getIcon()
    {
        return 'plugins/TagManager/images/icons/etracker.svg';
    }

    public function getParameters()
    {
        $trackingType = $this->makeSetting('trackingType', 'pageview', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
            $field->title = Piwik::translate('TagManager_TrackingType');
            $field->description = Piwik::translate('TagManager_EtrackerTagTrackingTypeDescription');
            $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
            $field->validators[] = new NotEmpty();
            $field->availableValues = array(
                'pageview' => 'Pageview',
                'wrapper' => 'Wrapper',
                'event' => 'Event',
                'transaction' => 'Transaction',
                'addtocart' => 'eCommerce Event - Add to cart',
                'form' => 'Form Tracking',
            );
        });
        return array(
            $trackingType,
            $this->makeSetting(self::PARAM_ETRACKER_CONFIG, '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagConfigTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagConfigDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_TYPE_COMPONENT;
                $field->uiControlAttributes = array('variableType' => 'EtrackerConfiguration');
                $field->condition = 'trackingType == "pageview" || trackingType =="wrapper"';
                if ($trackingType->getValue() === 'pageview' || $trackingType->getValue() === 'wrapper') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerWrapperPagename', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperPageNameTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagWrapperPageNameDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
                if ($trackingType->getValue() === 'wrapper') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerWrapperArea', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperAreaTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagWrapperAreaDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperTarget', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTargetTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperTval', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTvalTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperTonr', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTonrTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperTsale', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTsaleTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperCust', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTcustTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerWrapperBasket', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagWrapperTBasketTitle');
                $field->description = '';
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "wrapper"';
            }),
            $this->makeSetting('etrackerEventCategory', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagEventCategoryTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagEventCategoryDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "event"';
                if ($trackingType->getValue() === 'event') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerEventObject', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagEventObjectTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagEventObjectDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "event"';
            }),
            $this->makeSetting('etrackerEventAction', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagEventActionTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagEventActionDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "event"';
            }),
            $this->makeSetting('etrackerEventType', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = Piwik::translate('TagManager_EtrackerTagEventTypeTitle');
                $field->description = Piwik::translate('TagManager_EtrackerTagEventTypeDescription');
                $field->customFieldComponent = self::FIELD_VARIABLE_COMPONENT;
                $field->condition = 'trackingType == "event"';
            }),
            $this->makeSetting('etrackerTransactionType', 'sale', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'etracker Order Status';
                $field->description = 'Sale / Lead / Partial Cancellation / Cancellation';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->condition = 'trackingType == "transaction"';
                $field->availableValues = array(
                 'sale' => 'Sale',
                 'lead' => 'Lead',
                 'cancellation' => 'Cancellation',
                 'partial_cancellation' => 'Partial Cancellation',
                );
                if ($trackingType->getValue() === 'transaction') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerTransactionID', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'etracker Order number';
                $field->description = 'Order ID, transaction id or similar - max 50 chars';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
                if ($trackingType->getValue() === 'transaction') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerTransactionValue', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Order Value';
                $field->description = 'Order Value';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
                if ($trackingType->getValue() === 'transaction') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerTransactionCurrency', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Currency';
                $field->description = 'Currency of the order according to ISO 4217 e.g.: EUR or USD';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
                if ($trackingType->getValue() === 'transaction') {
                    $field->validators[] = new CharacterLength(3,3);
                }
            }),
            $this->makeSetting('etrackerTransactionBasket', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Basket';
                $field->description = 'dataLayer object of basket - according to etracker reference';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
                if ($trackingType->getValue() === 'transaction') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerTransactionCustomerGroup', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Customer Group';
                $field->description = 'optional, e.g. new customer, existing customer, big buyer, VIP';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
            }),
            $this->makeSetting('etrackerTransactionDeliveryConditions', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Delivery Conditions';
                $field->description = 'optional, e.g. Delivery to the kerb, Setup on site, Delivery to the pick-up station/parcel shop/branch';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
            }),
            $this->makeSetting('etrackerTransactionPaymentConditions', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Payment Conditions';
                $field->description = 'optional, e.g. Special payment targets, Cash discount, Payment in instalments';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
            }),
            $this->makeSetting('etrackerTransactionDebugMode', false, FieldConfig::TYPE_BOOL, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'etracker Ecommerce Debug Mode';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "transaction"';
            }),
            $this->makeSetting('etrackerAddToCartProduct', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Product object';
                $field->description = 'dataLayer object of the product - according to etracker reference';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "addtocart"';
                if ($trackingType->getValue() === 'addtocart') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerAddToCartNumber', '1', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Number';
                $field->description = 'Number of products added to the cart';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "addtocart"';
                if ($trackingType->getValue() === 'addtocart') {
                    $field->validators[] = new NumberRange();
                }
            }),
            $this->makeSetting('etrackerFormType', 'formConversion', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'etracker Form Type';
                $field->description = 'Conversion / Form View / Field View / Field Interaction / Field Error';
                $field->uiControl = FieldConfig::UI_CONTROL_SINGLE_SELECT;
                $field->condition = 'trackingType == "form"';
                $field->availableValues = array(
                 'formConversion' => 'Conversion',
                 'formView' => 'Form View',
                 'formFieldsView' => 'Field View',
                 'formFieldInteraction' => 'Field Interaction',
                 'formFieldError' => 'Field Error',
                );
                if ($trackingType->getValue() === 'form') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerFormName', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Form Name';
                $field->description = 'Form Name titles the report of the form which is tracked';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "form"';
                if ($trackingType->getValue() === 'form') {
                    $field->validators[] = new NotEmpty();
                }
            }),
            $this->makeSetting('etrackerFormData', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) use ($trackingType) {
                $field->title = 'Form Data';
                $field->description = 'eg. form section information. If used, a string is required';
                $field->customUiControlTemplateFile = self::FIELD_TEMPLATE_VARIABLE;
                $field->condition = 'trackingType == "form"';
            })
        );
    }
    public function getCategory()
    {
            return self::CATEGORY_ANALYTICS;
    }
}
