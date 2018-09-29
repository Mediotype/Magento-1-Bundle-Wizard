<?php

/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 6/30/14
 * Time: 10:27 PM
 */
class Mediotype_BundleWizard_Block_Bundle_Adminhtml_Catalog_Product_Edit_Tab_Bundle_Option extends Mage_Bundle_Block_Adminhtml_Catalog_Product_Edit_Tab_Bundle_Option
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('mediotype/bundlewizard/bundle/product/edit/bundle/option.phtml');
    }

    protected function _prepareLayout()
    {
        $return = parent::_prepareLayout();

        $this->setChild(
            'option_delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(
                    array(
                        'label' => Mage::helper('catalog')->__('Delete Option'),
                        'class' => 'delete delete-product-option',
                        'on_click' => 'bOption.remove(event)',
                        "style" => "float:right;"
                    )
                )
        );

        return $return;
    }

    public function getAttributeList()
    {
        /** @var Mage_Catalog_Model_Product_Type_Configurable $configurableProductTypeInstance */
        $configurableProductTypeInstance = Mage::getModel('catalog/product_type_configurable');
        $product = $this->getProduct()->load($this->getProduct()->getId());
        $attributes = $product->getTypeInstance(true)->getSetAttributes($product);
        $filteredAttributes = array();
        foreach ($attributes as $attributeModel) {
            if ($configurableProductTypeInstance->canUseAttribute($attributeModel)) {
                $filteredAttributes[] = $attributeModel;
            }
        }

        return $filteredAttributes;
    }

    public function getAttributeOptionsArray()
    {
        $optionsArray = array(array("label" => "Not Configurable", "value" => null));
        foreach ($this->getAttributeList() as $attribute) {
            /** @var Mage_Eav_Model_Entity_Attribute $attribute */
            $optionsArray[] = array("label" => $attribute->getStoreLabel(), "value" => $attribute->getId());
        }
        return $optionsArray;
    }

    public function getAttributeListHtml()
    {
        $select = $this->getLayout()->createBlock('adminhtml/html_select')
            ->setData(array(
                'id' => $this->getFieldId() . '_{{index}}_configurable_attribute_id',
                'class' => 'select',
                'extra_params' => 'onchange="bOption.changeConfigurableAttribute(event, {{index}})"'
            ))
            ->setName($this->getFieldName() . '[{{index}}][configurable_attribute_id]')
            ->setOptions($this->getAttributeOptionsArray());

        return $select->getHtml();
    }

    public function getTextboxAttributeListHtml()
    {
        $select = $this->getLayout()->createBlock('adminhtml/html_select')
            ->setData(array(
                'id' => $this->getFieldId() . '_{{index}}_textbox_attribute_id',
                'class' => 'select',
                'extra_params' => 'onchange="bOption.changeConfigurableAttribute(event, {{index}})"'
            ))
            ->setName($this->getFieldName() . '[{{index}}][textbox_attribute_id]')
            ->setOptions($this->getAttributeOptionsArray());

        return $select->getHtml();
    }

    public function getTargetOptionsArray(){
        $optionsArray = array(array("label" => "", "value" => null));
        foreach($this->getOptions() as $index=> $optionModel){
            $optionsArray[] = array("label" => $optionModel->getTitle(), "value" => $optionModel->getId());
        }
        return $optionsArray;
    }

    public function getTargetOptionsListHtml()
    {
        $select = $this->getLayout()->createBlock('adminhtml/html_select')
            ->setData(array(
                'id' => $this->getFieldId() . '_{{index}}_autoadd_target_option',
                'class' => 'select',
            ))
            ->setName($this->getFieldName() . '[{{index}}][autoadd_target_option]')
            ->setOptions($this->getTargetOptionsArray());

        return $select->getHtml();
    }

}