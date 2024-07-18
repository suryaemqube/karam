<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Emqube\CartRestore\Controller\Onepage;
class CustomFailure extends \Magento\Checkout\Controller\Onepage\Failure
{
    /**
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        // $lastQuoteId = $this->getOnepage()->getCheckout()->getLastQuoteId();
        // $lastOrderId = $this->getOnepage()->getCheckout()->getLastOrderId();

        // if (!$lastQuoteId || !$lastOrderId) {
        //     return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        // }

        // return $this->resultPageFactory->create();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $_checkoutSession = $objectManager->create('\Magento\Checkout\Model\Session');
        $_quoteFactory = $objectManager->create('\Magento\Quote\Model\QuoteFactory');
        
        $order = $_checkoutSession->getLastRealOrder();
        $quote = $_quoteFactory->create()->loadByIdWithoutStore($order->getQuoteId());
        //echo $quote->getId();
        if ($quote->getId()) {
            $quote->setIsActive(1)->setReservedOrderId(null)->save();
            $_checkoutSession->replaceQuote($quote);
            //return $this->resultRedirectFactory->create()->setPath('checkout/cart');
        }
        return $this->resultPageFactory->create();
        
    }
}
