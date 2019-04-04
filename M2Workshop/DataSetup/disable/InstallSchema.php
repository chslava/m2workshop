<?php

namespace M2Workshop\DataSetup\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table = $setup->getConnection()->newTable('car')
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' =>true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Car ID'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                256,
                [
                    'nullable' => false
                ],
                'Car Name'
            )
            ->setComment('Cars Table');
        $setup->getConnection()->createTable($table);
    }
}
