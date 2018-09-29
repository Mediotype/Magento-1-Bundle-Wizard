<?php
/**
 * Created by PhpStorm.
 * User: stevenzurek
 * Date: 4/9/15
 * Time: 12:08 PM
 */ 
class Mediotype_BundleWizard_Block_Bundle_Adminhtml_Catalog_Product_Edit_Tab_Bundle_Option_Selection extends Mage_Bundle_Block_Adminhtml_Catalog_Product_Edit_Tab_Bundle_Option_Selection {
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('mediotype/bundlewizard/bundle/product/edit/bundle/selection.phtml');
    }

}