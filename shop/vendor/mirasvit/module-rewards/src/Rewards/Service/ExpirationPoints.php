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



namespace Mirasvit\Rewards\Service;

use Magento\Customer\Model\Session;
use Mirasvit\Rewards\Api\Data\TransactionInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Mirasvit\Rewards\Model\Config;
use Mirasvit\Rewards\Repository\TransactionRepository;

class ExpirationPoints
{
    private $transactionRepository;

    private $customerSession;

    private $date;

    private $config;

    public function __construct(
        TransactionRepository $transactionRepository,
        Session               $customerSession,
        DateTime              $date,
        Config                $config
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->customerSession       = $customerSession;
        $this->date                  = $date;
        $this->config                = $config;
    }

    public function getExpiringPointsDays(): int
    {
        $days = $this->config->getExpirationPointsDays();

        $transactions = $this->getExpiringCollection();

        /** @var TransactionInterface $transaction */
        foreach ($transactions as $transaction) {
            $diff = floor((strtotime($transaction->getExpiresAt()) - $this->date->gmtTimestamp()) / 60 / 60 / 24);
            if ($diff >= 0 && $days > $diff) {
                $days = $diff;
            }
        }

        return $days;
    }

    public function getExpiringPointsAmount(): int
    {
        $transactions = $this->getExpiringCollection();
        $used = array_sum($transactions->getColumnValues('amount_used'));

        return array_sum($transactions->getColumnValues('amount')) - $used;
    }

    /**
     * @return \Mirasvit\Rewards\Model\ResourceModel\Transaction\Collection
     */
    private function getExpiringCollection()
    {
        $customerId = (int)$this->customerSession->getCustomerId();


        $days = $this->config->getExpirationPointsDays();
        $date = $this->date->gmtDate('Y-m-d H:i', time() + 60 * 60 * 24 * $days);

        $transactions = $this->transactionRepository->getCollection()
            ->addFieldToFilter(TransactionInterface::KEY_IS_EXPIRED, 0)
            ->addFieldToFilter(TransactionInterface::KEY_CUSTOMER_ID, $customerId);

        $transactions->getSelect()
            ->where('expires_at < ?', $date)
            ->where('amount > amount_used OR amount_used IS NULL');

        return $transactions;
    }
}
