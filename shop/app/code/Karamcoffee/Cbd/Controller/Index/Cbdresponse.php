<?php
namespace Karamcoffee\Cbd\Controller\Index;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Session;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Sales\Api\OrderManagementInterface;
class Cbdresponse extends  \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{
    const METHOD = 'AES-128-CBC';
    protected $pageFactory;
    protected $checkoutSession;
    protected $orderFactory;
    protected $_messageManager;
    protected $storeManager;
    protected $orderManagement;
    
     public function __construct(Context $context, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Store\Model\StoreManagerInterface $storeManager, Session $checkoutSession, OrderFactory $orderFactory, PageFactory $pageFactory,OrderManagementInterface $orderManagement) {
        $this->pageFactory = $pageFactory;
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
        $this->_messageManager = $messageManager;
        $this->_storeManager = $storeManager;
        $this->orderManagement = $orderManagement;
        parent::__construct($context);
                            
    }

    public function getBaseurl(){
        $baseurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
        return $baseurl;
    }

    public function execute()
    {
        if(isset($_POST['c'])){
               $encryptedData=$_POST['c'];
			//   if($_SERVER['REMOTE_ADDR'] == '103.93.136.56'){
				// $decryptedData = $this->decrypt($encryptedData, "M8HV4PODC4MAWJX");
			//   } else {
				$decryptedData = $this->decrypt($encryptedData, "UP9S7VDVMX5890E");
			//   }
              

            $array = json_decode(json_encode((array)simplexml_load_string($decryptedData)),true);
            $this->generateLog($array, $encryptedData, $decryptedData);
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            if($array['Header']['ResponseCode'] == '00' || $array['Header']['ResponseMsg'] == 'success' || $array['Header']['ResponseCode'] == 'Success'){
                $orderState = 'processing';
                $orderStatus = 'processing';
                $orderId = $this->checkoutSession->getLastOrderId();
                //$orderId = $array['Body']['PaymentInformation']['OrderID'];
                
                $order = $this->orderFactory->create()->load($orderId);
                $order->setState($orderState)->setStatus($orderStatus);
                $trans_id = $array['Body']['PaymentInformation']['CBDReferenceNo'];
                $order->getPayment()->setLastTransId($trans_id);
                $order->getPayment()->setTransactionId($trans_id);
                $order->getPayment()->setAdditionalInformation($array);
                $order->save();
                $order->setEmailSent(0);
                $objectManager->create('Magento\Sales\Model\OrderNotifier')->notify($order);
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->generateLog($array, $encryptedData, $decryptedData);
                // Pay attention to leading slash in url.
                return $resultRedirect->setPath('checkout/onepage/success', ['_secure' => true]);
				print_r($array);print_r($encryptedData);print_r($decryptedData);die();
            }else if ($array['Header']['ResponseMsg'] == 'Transaction_Cancelled' || $array['Header']['ResponseMsg'] == 'transaction_cancelled' || $array['Header']['ResponseCode'] == '1009'){
                /*'credit_card_error'*/
                $orderState = 'canceled';
                $orderStatus = 'canceled';
                $orderId = $this->checkoutSession->getLastOrderId();
                $this->orderManagement->cancel($orderId);
               // $orderId = $array['Body']['PaymentInformation']['OrderID'];
                // $order = $this->orderFactory->create()->load($orderId);
                // $order->setState($orderState)->setStatus($orderStatus);
                // $order->save();
                //$order->setEmailSent(0);
                $resultRedirect = $this->resultRedirectFactory->create();
                //$this->generateLog($array, $encryptedData, $decryptedData);
                $this->messageManager->addErrorMessage('Your order has been cancelled');
            //added by shreyas starts on 13-08-2021

                $_quoteFactory = $objectManager->create('\Magento\Quote\Model\QuoteFactory');
                $order = $this->checkoutSession->getLastRealOrder();
                $quote = $_quoteFactory->create()->loadByIdWithoutStore($order->getQuoteId());
                if ($quote->getId()) {
                    $quote->setIsActive(1)->setReservedOrderId(null)->save();
                }
                $this->checkoutSession->restoreQuote();
                $this->_redirect('checkout/cart');


                // $this->_messageManager->addErrorMessage('Your order has been cancelled');

                // $messages = $this->messageManager->getMessages(true);  
                // $logger->info(print_r($messages, true));
                //added by shreyas ends on 13-08-2021
            }else {
                /*'credit_card_error'*/
                $orderState = 'canceled';
                $orderStatus = 'canceled';
                //$orderId = $array['Body']['PaymentInformation']['OrderID'];
                $orderId = $this->checkoutSession->getLastOrderId();
                $this->orderManagement->cancel($orderId);
                // $order = $this->orderFactory->create()->load($orderId);
                
                // $order->setState($orderState)->setStatus($orderStatus);
                // $order->save();
                //$order->setEmailSent(0);
                $resultRedirect = $this->resultRedirectFactory->create();
                //$this->generateLog($array, $encryptedData, $decryptedData);
                $this->messageManager->addError('There was an error processing your payment');
                //added by shreyas starts on 13-08-2021
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $_quoteFactory = $objectManager->create('\Magento\Quote\Model\QuoteFactory');
                $order = $this->checkoutSession->getLastRealOrder();
                $quote = $_quoteFactory->create()->loadByIdWithoutStore($order->getQuoteId());
                if ($quote->getId()) {
                    $quote->setIsActive(1)->setReservedOrderId(null)->save();
                }
                $this->checkoutSession->restoreQuote();
                $this->_redirect('checkout/cart');
                
            }
          
       }
        // else{
        //     echo "failed our side";
        //     exit;
        // }
    }

    public function decrypt($inputText, $password)
    {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $ivdata = openssl_random_pseudo_bytes($ivlen);       
        $iv = substr($password, 0, 16);     
        $output = openssl_decrypt(base64_decode($inputText), 'AES-128-CBC', $password, OPENSSL_RAW_DATA, $iv."\0");
        return  $output;
    }

    public function generateLog($array, $encryptedData, $decryptedData)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cbdresponse.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);

        $logger->info('--------------');
        $logger->info('encryptedData--------'.$encryptedData);
        $logger->info('--------------');
        $logger->info('decryptedData--------'.$decryptedData);
        $logger->info('--------------');
        // $logger->info(print_r($array, true));
        // $logger->info('--------------');

        // print_r($array['Body']['PaymentInformation']);
        // print_r($array['Body']['PaymentInformation']['OrderID']);
        // echo count($array['Body']['PaymentInformation']['CBDReferenceNo']);

        //if(count($array['Body']['PaymentInformation']['CBDReferenceNo']) > 0) {
        if(!empty($array['Body']['PaymentInformation']['CBDReferenceNo'])) {
            $logger->info('CBTRANSACTIONID: '.$array['Body']['PaymentInformation']['CBDReferenceNo'].'--ORDERID: '.$array['Body']['PaymentInformation']['OrderID']);
        } else {
            $logger->info('CBTRANSACTIONID: NA--ORDERID: '.$array['Body']['PaymentInformation']['OrderID']);
        }

        //die('reached');
        //$logger->info('CBTRANSACTIONID: --ORDERID: ');
    }

    public function createCsrfValidationException(RequestInterface $request): ? InvalidRequestException
    {
       return null;
    }
    
    public function validateForCsrf(RequestInterface $request): ?bool
    {
       return true;
    }

}
