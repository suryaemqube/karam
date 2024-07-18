<?php
namespace Karamcoffee\Cbd\Model\Order\Email\Sender;

use Magento\Sales\Model\Order;

class OrderSender extends \Magento\Sales\Model\Order\Email\Sender\OrderSender {

    public function send(Order $order, $forceSyncMode = false)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/meetanshi.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(__CLASS__ .'::'.__FUNCTION__.':: START');
        $logger->info('=========send=========');
        $payment = $order->getPayment()->getMethodInstance()->getCode();
        $emailSent = intval($order->getEmailSent());

        if((($payment == 'cbd' && $order->getStatus() == 'processing') || ($payment == 'cashondelivery' && $order->getStatus() == 'pending')) && $emailSent==false){
            $order->setSendEmail(true);
            if (!$this->globalConfig->getValue('sales_email/general/async_sending') || $forceSyncMode) {
                if ($this->checkAndSend($order)) {
                    $order->setEmailSent(true);
                    $this->orderResource->saveAttribute($order, ['send_email', 'email_sent']);
                    return true;
                }
            }

            $this->orderResource->saveAttribute($order, 'send_email');
        }

        return false;
    }
}
