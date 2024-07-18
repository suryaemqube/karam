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



namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\OrderManagement;

use Magento\Backend\App\Action;
use Mirasvit\Rewards\Helper\Balance;
use Mirasvit\Rewards\Helper\Data;
use Mirasvit\Rewards\Service\Order\Transaction;
use Magento\Sales\Model\OrderRepository;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Refund extends Action
{
    private $rewardsBalance;

    private $rewardsData;

    private $transactionService;

    private $orderRepository;

    public function __construct(
        Balance $rewardsBalance,
        Data $rewardsData,
        Transaction $transactionService,
        OrderRepository $orderRepository,
        Context $context
    ) {
        $this->rewardsBalance     = $rewardsBalance;
        $this->rewardsData        = $rewardsData;
        $this->transactionService = $transactionService;
        $this->orderRepository    = $orderRepository;
        $this->context            = $context;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $points   = $this->getRequest()->getParam('points_amount');
        $orderId  = $this->getRequest()->getParam('order_id');
        $order    = $this->orderRepository->get($orderId);

        $message = $this->transactionService->translateComment(
            $order->getStore()->getId(),
            'Admin changed points balance by %1 for the order #%2.',
            $this->rewardsData->formatPoints($points),
            $order->getIncrementId()
        );
        $this->rewardsBalance->changePointsBalance(
            $order->getCustomerId(),
            $points,
            $message,
            true, false, true);

        return $response->setData($message);
    }
}
