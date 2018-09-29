<?php

/**
 * @author  Mediotype <@mediotype>
 */
class Mediotype_BundleWizard_Model_Resource_Bundle_Option_Collection extends Mage_Bundle_Model_Resource_Option_Collection
{
    /**
     * Joins values to options
     *
     * @param int $storeId
     * @return Mage_Bundle_Model_Resource_Option_Collection
     */
    public function joinValues($storeId)
    {
        parent::joinValues($storeId);
        $this->getSelect()
            ->columns(
                array(
                    'configurable_attribute_id' => 'main_table.configurable_attribute_id',
                    'default_description' => 'option_value_default.description',
                    'default_config_description' => 'option_value_default.config_description',
                    'default_config_title' => 'option_value_default.config_title'
                )
            );

        if ($storeId !== null) {
            $this->getSelect()
                ->columns(
                    array(
                        'configurable_attribute_id' => 'main_table.configurable_attribute_id',
                        'description' => 'option_value.description',
                        'config_description' => 'option_value.config_description',
                        'config_title' => 'option_value.config_title'
                    ));
        }

        return $this;
    }
}