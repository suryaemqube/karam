<?php

namespace Wyomind\PointOfSale\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory;

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 10/05/2022
 * Time: 16:49
 */

class Upgrade704 implements DataPatchInterface, PatchRevertableInterface, PatchVersionInterface
{


    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * UpgradeData constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
    
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        $collection = $this->collectionFactory->create();
        foreach ($collection as $pos) {
            if ($pos->getStatus() == 1) {
                $pos->setData('visible_store_locator', 1);
                $pos->setData('visible_product_page', 1);
                $pos->setData('visible_checkout', 1);
                $pos->save();
            }
        }
        return $this;
    }

    /**
     * Rollback all changes, done by this patch
     *
     * @return void
     */
    public function revert()
    {
        return;
    }

    /**
     * This version associate patch with Magento setup version.
     * For example, if Magento current setup version is 2.0.3 and patch version is 2.0.2 then
     * this patch will be added to registry, but will not be applied, because it is already applied
     * by old mechanism of UpgradeData.php script
     *
     * @return string
     */
    public static function getVersion()
    {
        return '7.0.4';
    }
}
