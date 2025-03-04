<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   3.2.4
 * @copyright Copyright (C) 2024 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\Rewards\Setup\UpgradeSchema;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema108 implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public static function upgrade(SchemaSetupInterface $installer, ModuleContextInterface $context)
    {
        $installer->getConnection()->addIndex(
            $installer->getTable('mst_rewards_earning_rule'),
            'Earning rule fulltext index',
            ['name'],
            AdapterInterface::INDEX_TYPE_FULLTEXT
        );
        $installer->getConnection()->addIndex(
            $installer->getTable('mst_rewards_spending_rule'),
            'Spending rule fulltext index',
            ['name'],
            AdapterInterface::INDEX_TYPE_FULLTEXT
        );
        $installer->getConnection()->addIndex(
            $installer->getTable('mst_rewards_notification_rule'),
            'Notification rule fulltext index',
            ['name'],
            AdapterInterface::INDEX_TYPE_FULLTEXT
        );
    }
}