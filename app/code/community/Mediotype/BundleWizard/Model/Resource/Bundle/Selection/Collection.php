<?php

/**
 * Class Mediotype_BundleWizard_Model_Resource_Bundle_Selection_Collection
 */
class Mediotype_BundleWizard_Model_Resource_Bundle_Selection_Collection extends Mage_Bundle_Model_Resource_Selection_Collection
{
    protected $_optionids = array();

    public function setOptionIdsFilter($optionIds)
    {
        $this->joinConfigurableAttributes(0);
        return parent::setOptionIdsFilter($optionIds);
    }

    /**
     * Join website scope prices to collection, override default prices
     *
     * @param int $websiteId
     * @return Mage_Bundle_Model_Resource_Selection_Collection
     */
    public function joinConfigurableAttributes($websiteId)
    {

        $this->getSelect()
            ->joinLeft(array('cpbo' => 'catalog_product_bundle_option'), 'cpbo.option_id = selection.option_id')
            ->joinLeft(array('cpei' => 'catalog_product_entity_int'), 'cpei.attribute_id = cpbo.configurable_attribute_id AND cpei.entity_id = e.entity_id')
            ->joinLeft(array('eaov' => 'eav_attribute_option_value'), 'eaov.option_id = cpei.value')
            ->joinLeft(array('cpeiText' => 'catalog_product_entity_int'), 'cpeiText.attribute_id = cpbo.textbox_attribute_id AND cpeiText.entity_id = e.entity_id')
            ->joinLeft(array('eaovText' => 'eav_attribute_option_value'), 'eaovText.option_id = cpeiText.value')
            ->reset(Zend_Db_Select::COLUMNS)
            ->columns("e.*")
            ->columns("selection.*")
            ->columns("eaov.value as configurable_value")
            ->columns("eaov.value_id as configurable_value_id")
            ->columns("eaovText.value as textbox_attribute_value")
            ->columns("eaovText.value_id as textbox_attribute_value_id")
            ->group('selection.selection_id');

        return $this;
    }

    public function getConfigurableAttributes($optionIds)
    {
        $results = array();
        if (!empty($optionIds)) {
            $optionCollection = Mage::getModel('bundle/option')->getCollection()->addFieldToFilter("option_id", array("in" => $optionIds))->load();
            foreach ($optionCollection as $optionModel) {
                $attribute = Mage::getModel('catalog/resource_eav_attribute')->load($optionModel->getData('configurable_attribute_id'));
                $results[] = $attribute;
            }
        }
        return $results;
    }
}