<?php

/**
 * @author  Mediotype <@mediotype>
 */
class Mediotype_BundleWizard_Model_Resource_Bundle_Option extends Mage_Bundle_Model_Resource_Option
{
    /**
     * After save process
     *
     * @param Mage_Core_Model_Abstract $object
     * @return Mage_Bundle_Model_Resource_Option
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        parent::_afterSave($object);

        $condition = array(
            'option_id = ?' => $object->getId(),
            'store_id = ? OR store_id = 0' => $object->getStoreId()
        );

        $write = $this->_getWriteAdapter();
        $write->delete($this->getTable('bundle/option_value'), $condition);

        $data = new Varien_Object();
        $data->setOptionId($object->getId())
            ->setStoreId($object->getStoreId())
            ->setTitle($object->getTitle())
            ->setDescription($object->getDescription())
            ->setConfigDescription($object->getConfigDescription())
            ->setConfigTitle($object->getConfigTitle());

        $write->insert($this->getTable('bundle/option_value'), $data->getData());

        /**
         * also saving default value if this store view scope
         */

        if ($object->getStoreId()) {
            $data->setStoreId(0);
            $data->setTitle($object->getDefaultTitle())
                ->setDescription($object->getDefaultDescription())
                ->setConfigDescription($object->getDefaultConfigDescription())
                ->setConfigTitle($object->getDefaultConfigTitle());
            $write->insert($this->getTable('bundle/option_value'), $data->getData());
        }

        return $this;
    }

}