<?php

/**
 * Created by PhpStorm.
 * User: stevenzurek
 * Date: 4/11/15
 * Time: 5:05 PM
 */
class Mediotype_BundleWizard_Model_Bundle_Option extends Mage_Bundle_Model_Option
{
    public function hasConfig()
    {
        if ($this->getData("configurable_attribute_id") != 0) {
            return true;
        }
        return false;
    }

    public function getConfigurableAttribute()
    {
        return Mage::getModel('catalog/resource_eav_attribute')->load($this->getData('configurable_attribute_id'));
    }

    public function getConfigurableOptions()
    {
        $options = array();
        foreach ($this->getSelections() as $selectionModel) {
            $options[$selectionModel->getData('configurable_value_id')] = $selectionModel->getData('configurable_value');
        }
        return $options;
    }

    public function getConfigurableOptionHtml()
    {
        $html = array();
        $html[] = "<select onchange='bWizard.configChanged(event, " . $this->getId() . ")' name='bundle_option_config[" . $this->getId() . "]'>";
        $html[] = "<option value=''></option>";
        foreach ($this->getConfigurableOptions() as $value_id => $value) {
            $html[] = "<option value='$value_id'>$value</option>";
        }
        $html[] = "</select>";
        return implode(null, $html);
    }

    /**
     * @return Mage_Catalog_Model_Resource_Eav_Attribute
     */
    public function getTextboxAttribute()
    {
        return Mage::getModel('catalog/resource_eav_attribute')->load($this->getData('textbox_attribute_id'));
    }
}