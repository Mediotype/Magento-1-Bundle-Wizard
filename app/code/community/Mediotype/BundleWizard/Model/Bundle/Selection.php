<?php

/**
 * Created by PhpStorm.
 * User: stevenzurek
 * Date: 4/15/15
 * Time: 7:40 PM
 */
class Mediotype_BundleWizard_Model_Bundle_Selection extends Mage_Bundle_Model_Selection
{
    public function getSelectionCanChangeQty()
    {


        $option = Mage::getModel('bundle/option')->load($this->getOptionId());

        if ($option->getId() && ($option->getType() == "textbox" || $option->getType() == "autoadd")) {
            return false;
        }

        return parent::getSelectionCanChangeQty();
    }
}