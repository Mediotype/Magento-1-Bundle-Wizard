<?php

/**
 * @author  Mediotype <@mediotype>
 */
class Mediotype_BundleWizard_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getJsInclude()
    {
        if (Mage::registry('product')->getData('use_wizard')) {
            return "mediotype/bundlewizard/wizard.js";
        }
        return null;
    }

    public function getCssInclude()
    {
        if (Mage::registry('product')->getData('use_wizard')) {
            return "mediotype/bundlewizard/wizard.css";
        }
        return null;
    }
}