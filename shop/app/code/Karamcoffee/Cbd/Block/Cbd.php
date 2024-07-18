<?php

namespace Karamcoffee\Cbd\Block;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\Session;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\App\Response\Http;
use Magento\Sales\Model\Order\Payment\Transaction\Builder as TransactionBuilder;

class Cbd extends \Magento\Framework\View\Element\Template
{
    const METHOD = 'AES-128-CBC';
    protected $_objectmanager;
    protected $checkoutSession;
    protected $orderFactory;
    protected $urlBuilder;
    protected $response;
    protected $config;
    protected $messageManager;
    protected $transactionBuilder;
    protected $inbox;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        OrderFactory $orderFactory,
        Http $response,
        TransactionBuilder $tb,
        \Magento\AdminNotification\Model\Inbox $inbox
    ) {

        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
        $this->response = $response;
        $this->config = $context->getScopeConfig();
        $this->transactionBuilder = $tb;
        $this->inbox = $inbox;

        $this->urlBuilder = \Magento\Framework\App\ObjectManager::getInstance()
            ->get('Magento\Framework\UrlInterface');
        parent::__construct($context);
    }

    public function grandTotal()
    {
        $orderId = $this->checkoutSession->getLastOrderId();
        $order = $this->orderFactory->create()->load($orderId);
        $order->setState(Order::STATE_PENDING_PAYMENT, true);
        $order->setStatus(Order::STATE_PENDING_PAYMENT);
        $order->save();
        //$updateTelephone = $this->getRequest()->getParam('telephone');
        $payment = $order->getPayment();
        return $order->getGrandTotal();
    }

    public function OrderId()
    {
        return $orderId = $this->checkoutSession->getLastOrderId();
        $order = $this->orderFactory->create()->load($orderId);
        $payment = $order->getPayment();
        return $order->getGrandTotal();
    }


    public function decrypt($inputText, $password)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $ivdata = openssl_random_pseudo_bytes($ivlen);
        $iv = substr($password, 0, 16);
        $output = openssl_decrypt(base64_decode($inputText), 'AES-128-CBC', $password, OPENSSL_RAW_DATA, $iv . "\0");
        return $output;
    }

    public function encrypt($inputText, $password)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $ivdata = openssl_random_pseudo_bytes($ivlen);
        $iv = substr($password, 0, 16);
        $textUTF = mb_convert_encoding($inputText, 'UTF-8');
        $encrypted = openssl_encrypt($inputText, $cipher, $password, $options = OPENSSL_RAW_DATA, $iv . "\0");
        $encrypteddata = base64_encode($encrypted);
        return $encrypteddata;
    }

    public function chars()
    {
        // if($_SERVER['REMOTE_ADDR'] == '103.93.136.56'){
        // $data1 = '<BankInformation><ClientID>cbd_47</ClientID><ReturnPage> https://www.karamcoffee.ae/shop/cbd/index/cbdresponse</ReturnPage><CreateToken>false</CreateToken><locale>en-us</locale><PaymentInformation> <OrderID>';
        // } else {
        $data1='<BankInformation><ClientID>KARA001</ClientID><ReturnPage>https://www.karamcoffee.ae/shop/cbd/index/cbdresponse</ReturnPage><CreateToken>false</CreateToken><locale>en-us</locale><PaymentInformation>  <OrderID>';
        // }

        $data2 = '</OrderID> <TotalAmount>' . number_format($this->grandTotal(), '2', '.',
                '') . '</TotalAmount> <TransactionType>sale</TransactionType> <OrderDescription>Description</OrderDescription> <Currency>AED</Currency> </PaymentInformation></BankInformation>';

        $orderid = $this->checkoutSession->getLastRealOrderId();//rand(1000,23232323);
        $result = $data1 . (string)$orderid . $data2;
        $samplerequestxml = $result;

        // if($_SERVER['REMOTE_ADDR'] == '103.93.136.56'){
        // $chars = $this->encrypt($samplerequestxml, "M8HV4PODC4MAWJX");
        // } else {
        $chars = $this->encrypt($samplerequestxml, "UP9S7VDVMX5890E");
        // }
        $this->postLogData($samplerequestxml, $chars);
        return $chars;
        // if($_SERVER['REMOTE_ADDR'] == '103.93.136.56'){
        // $decryptedData = $this->decrypt($chars, "M8HV4PODC4MAWJX");
        // } else {
        $decryptedData = $this->decrypt($chars, "UP9S7VDVMX5890E");
        // }
    }

    public function postLogData($samplerequestxml, $chars)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cbdpostdata.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $logger->info('--------------');
        $logger->info('simple xml post data--------' . $samplerequestxml);
        $logger->info('--------------');
        $logger->info('encrypted post data--------' . $chars);
    }

}
