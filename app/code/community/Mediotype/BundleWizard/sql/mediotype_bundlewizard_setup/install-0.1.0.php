<?php
/**
 * @author  Mediotype <@mediotype>
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;
$eav       = new Mage_Eav_Model_Entity_Setup('catalog_product');
$installer->startSetup();

$installer->getConnection()
    ->addColumn(
        $installer->getTable('bundle/option_value'),
        'description',
        array(
            'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'A description of the bundle item group'
        )
    );

$eav->addAttribute(
    Mage_Catalog_Model_Product::ENTITY,
    'use_wizard',
    array(
        'group'                      => 'General',
        'type'                       => 'int',
        'backend'                    => '',
        'frontend'                   => '',
        'label'                      => 'Use Wizard',
        'input'                      => 'select',
        'source'                     => 'eav/entity_attribute_source_boolean',
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'                    => true,
        'required'                   => false,
        'user_defined'               => true,
        'default'                    => '',
        'searchable'                 => false,
        'filterable'                 => true,
        'comparable'                 => false,
        'visible_on_front'           => true,
        'visible_in_advanced_search' => true,
        'used_in_product_listing'    => true,
        'unique'                     => false,
        'apply_to'                   => Mage_Catalog_Model_Product_Type::TYPE_BUNDLE,
        'note'                       => 'Yes / No to enable bundle wizard on a bundled product'
    )
);
$eav->updateAttribute('catalog_product', 'use_wizard', 'apply_to', Mage_Catalog_Model_Product_Type::TYPE_BUNDLE);

$installer->endSetup();