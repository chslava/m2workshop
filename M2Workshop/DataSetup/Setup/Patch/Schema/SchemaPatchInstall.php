<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace M2Workshop\DataSetup\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class SchemaPatchInstall implements SchemaPatchInterface
{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }


    public static function getDependencies()
    {
        return [

        ];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $table = $this->moduleDataSetup->getConnection()->newTable('car')
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
        $this->moduleDataSetup->getConnection()->createTable($table);
        $this->moduleDataSetup->endSetup();
    }

//    public function revert()
//    {
//        // TODO: Implement revert() method.
//    }


}