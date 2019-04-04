<?php

namespace M2Workshop\DataSetup\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $data = [
            ['name' => 'VolksWagen Passat'],
            ['name' => 'Peugeot']
        ];
        foreach ($data as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('car'), $bind);
        }
    }

}