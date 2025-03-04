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


namespace Mirasvit\RewardsCheckout\Controller;

abstract class Checkout extends \Magento\Checkout\Controller\Cart
{
    /**
     * @var \Magento\Checkout\Model\Type\Onepage
     */
    protected $typeOnepage;
    /**
     * @var \Mirasvit\Rewards\Helper\Checkout
     */
    protected $rewardsCheckout;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonEncoder;
    /**
     * @var \Magento\Framework\App\Action\Context
     */
    protected $context;
    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $serializer;


    public function __construct(
        \Magento\Checkout\Model\Type\Onepage $typeOnepage,
        \Mirasvit\Rewards\Helper\Checkout $rewardsCheckout,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Json\Helper\Data $jsonEncoder,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->typeOnepage     = $typeOnepage;
        $this->rewardsCheckout = $rewardsCheckout;
        $this->logger          = $logger;
        $this->scopeConfig     = $scopeConfig;
        $this->jsonEncoder     = $jsonEncoder;
        $this->context         = $context;
        $this->serializer      = $serializer;
        $this->resultFactory   = $context->getResultFactory();

        parent::__construct($context, $scopeConfig, $checkoutSession, $storeManager, $formKeyValidator, $cart);
    }

    /**
     * @return \Magento\Checkout\Model\Type\Onepage
     */
    public function getOnepage()
    {
        return $this->typeOnepage;
    }

    const XML_PATH_DEFAULT_PAYMENT = 'opc/default/payment';

//    /**
//     * Used only for IWD.
//     * Get payments method step html.
//     *
//     * @param string|bool $useMethod
//     *
//     * @return string
//     */
//    protected function _getPaymentMethodsHtml($useMethod = false)
//    {
//        /* UPDATE PAYMENT METHOD **/
//        // check what method to use
//        $applyMethod = $this->scopeConfig->getValue(self::XML_PATH_DEFAULT_PAYMENT);
//        if ($useMethod) {
//            $applyMethod = $useMethod;
//        }
//
//        $_cart = $this->_getCart();
//        $_quote = $_cart->getQuote();
//        $_quote->getPayment()->setMethod($applyMethod);
//        $_quote->setTotalsCollectedFlag(false)->collectTotals();
//        $_quote->save();
//
//        $layout = $this->getLayout();
//        $update = $layout->getUpdate();
//        $update->load('checkout_onepage_paymentmethod');
//        $layout->generateXml();
//        $layout->generateBlocks();
//
//        $output = $layout->getOutput();
//
//        return $output;
//    }

    /**
     * @return array
     */
    protected function processRequest()
    {
        return $this->rewardsCheckout->processRequest();
    }
}
