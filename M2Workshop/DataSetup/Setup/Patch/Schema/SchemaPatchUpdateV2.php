<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 07.04.19
 * Time: 14:32
 */

namespace M2Workshop\DataSetup\Setup\Patch\Schema;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\DB\Ddl\Table;

class SchemaPatchUpdateV2
    implements SchemaPatchInterface,
               PatchVersionInterface
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

    public static function getVersion()
    {
        return '1.0.2';
    }


    public static function getDependencies()
    {
        return [SchemaPatchUpdateV1::class];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        if ($this->moduleDataSetup->getConnection()->isTableExists('car')) {
            $this->moduleDataSetup->getConnection()->changeColumn(
                'car',
                'name',
                'brand',
                ['type' => Table::TYPE_TEXT, 'nullable' => false]
            );
        }
        $this->moduleDataSetup->endSetup();
    }
}