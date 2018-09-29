<?php
/**
 *
 * @author      Joel Hart
 */

/* @var $installer Mage_Eav_Model_Entity_Setup */
$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn(
        $installer->getTable('bundle/option'),
        'configurable_attribute_id',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
            'length' => 11,
            'comment' => 'The attribute id of the configurable option'
        )
    );

$installer->getConnection()->addColumn(
    $installer->getTable('bundle/option'),
    'textbox_attribute_id',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'length' => 11,
        'comment' => 'The attribute id of the textbox option'
    )
);

$installer->getConnection()->addColumn(
    $installer->getTable('bundle/option_value'),
    'config_description',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment' => 'A config description of the bundle item group'
    )
);

$installer->getConnection()->addColumn(
    $installer->getTable('bundle/option_value'),
    'config_title',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'comment' => 'The config title of the bundle item group'
    )
);

$installer->endSetup();
