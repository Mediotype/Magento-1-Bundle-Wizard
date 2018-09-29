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
        'autoadd_target_option',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
            'length' => 11,
            'comment' => 'The target option id'
        )
    );
$installer->endSetup();
