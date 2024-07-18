<?php

namespace Karamcoffee\Cbd\Observer;

use Magento\Framework\Event\ObserverInterface;

class CartPage implements ObserverInterface
{
    protected $_messageManager;

    /**
     * @param \Magento\Sales\Model\OrderFactory $orderModel
     * @param \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender
     * @param \Magento\Checkout\Model\Session $checkoutSession
     *
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_messageManager = $messageManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->_messageManager->addErrorMessage('Test');
        $messages = $this->_messageManager->getMessages(true);  

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cbdresponse.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('=========From Cart Page=========');
        $logger->info(print_r($messages, true));
        $logger->info('==================');
    }
}