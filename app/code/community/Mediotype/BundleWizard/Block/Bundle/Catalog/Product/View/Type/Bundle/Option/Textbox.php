<?php

/**
 * @author  Mediotype <@mediotype>
 */
class Mediotype_BundleWizard_Block_Bundle_Catalog_Product_View_Type_Bundle_Option_Textbox extends Mage_Bundle_Block_Catalog_Product_View_Type_Bundle_Option_Radio
{
    protected function _construct()
    {
        parent::_construct();
        if (Mage::registry('product')->getData('use_wizard')) {
            $this->setTemplate('mediotype/bundlewizard/catalog/product/view/type/bundle/option/textbox.phtml');
        }
    }
}