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

class SchemaPatchUpdateV1
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
        return [SchemaPatchInstall::class];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        if ($this->moduleDataSetup->getConnection()->isTableExists('car')) {
            $this->moduleDataSetup->getConnection()->addColumn(
                $this->moduleDataSetup->getTable('car'),
                'color',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 16,
                    'nullable' => true,
                    'comment' => 'Car Color'
                ]
            );
        }
        $this->moduleDataSetup->endSetup();
    }
}