<?php

namespace Karamcoffee\Maraexpress\Observer;

use Magento\Framework\Event\ObserverInterface;

class SalesOrderShipmentAfter implements ObserverInterface
{


 /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;
    protected $trackFactory;
    protected $scopeConfig;
 
    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Sales\Model\Order\Shipment\TrackFactory $trackFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_objectManager = $objectManager;
        $this->trackFactory = $trackFactory;
        $this->scopeConfig = $scopeConfig;
        $this->_request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    { 
      $post = $this->_request->getPost();
      if(!isset($post['shipment']['express_shipment'])){
         return;
      }
      
      $shipment = $observer->getEvent()->getShipment();
        /** @var \Magento\Sales\Model\Order $order */
      $order = $shipment->getOrder(); 


    //product name and sku start    
    $productitems =$order->getAllVisibleItems();     
    $productname = '';
    $productsku='';
    $combine_product_info='';
    foreach($productitems as $item) {
        $productname= $item->getName();
        $productsku=$item->getSku();
        $combine_product_info .=$productname.'-'.$productsku.',';
    }
    $combine_product_info=rtrim($combine_product_info,',');
    $combine_product_info = substr($combine_product_info,0,248);
    //end 
    
        
    $name = $order->getShippingAddress()->getFirstname().' '.$order->getShippingAddress()->getLastname();

        if($order->getPayment()->getMethod() == 'cashondelivery'){
         $payment_method = "CashOnDelivery";
         $ordergrandtotal=$order->getGrandTotal(); 
        }else{
         $payment_method = "Prepaid";
         $ordergrandtotal=0;
        }
        $street_address=isset($order->getShippingAddress()->getStreet()[0])?$order->getShippingAddress()->getStreet()[0]:'';
        $street_address1=isset($order->getShippingAddress()->getStreet()[1])?$order->getShippingAddress()->getStreet()[1]:'';
        $street_address2=isset($order->getShippingAddress()->getStreet()[2])?$order->getShippingAddress()->getStreet()[2]:'';
        $combine_address=$street_address." ".$street_address1." ".$street_address2;
                

       if($order->getShippingMethod()==='pickupatstore_pickupatstore_1') return false;

        // Do some things
       $name = $order->getShippingAddress()->getFirstname().' '.$order->getShippingAddress()->getLastname();

        if($order->getPayment()->getMethod() == 'cashondelivery'){
           $payment_method = "CashOnDelivery"; 
           $ordergrandtotal=$order->getGrandTotal();
        }else{
           $payment_method = "Prepaid";
           $ordergrandtotal=0;
        }
      
        $maraexpress_enable = $this->scopeConfig->getValue('maraexpress/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($maraexpress_enable==TRUE){
            $maraexpress_carrier_name = $this->scopeConfig->getValue('maraexpress/general/carrier_name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $maraexpress_sandbox = $this->scopeConfig->getValue('maraexpress/general/sandbox', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $maraexpress_api_key = $this->scopeConfig->getValue('maraexpress/general/api_key', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

            $url = 'https://api.shipadelivery.com/orders';
            if(intval($maraexpress_sandbox)==TRUE){
                $url = 'https://sandbox-api.shipadelivery.com/orders';
            }
            $params = array('apikey'=>$maraexpress_api_key);
            $url = $url.'?'.http_build_query($params);

            $OrderData = $this->_objectManager->create('Karamcoffee\Maraexpress\Model\Maraexpress')->getCollection()->addFieldToFilter('order_id',$order->getEntityId())->getData();
            if(empty($OrderData) || count($OrderData) < 1){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, '
           [{"id":"'.$order->getIncrementId().'","amount":'.$ordergrandtotal.',"paymentMethod":"'.$payment_method.'","description":"'.$combine_product_info.'","typeDelivery":"forward","sender":{"email":"sales@karamfoods.ae","phone":"+971564420875","address": "Building # 358,4th Street,Al Quoz 3 - Dubai - United Arab Emirates","name": "Karam Foods Industries, Sales Office"},"recipient":{"name":"'.$name.'","phone":"+971'.$order->getShippingAddress()->getTelephone().'","address":"'.$combine_address.'","city":"'.$order->getShippingAddress()->getRegion().'"}}]');
          
          $database=' [{"id":"'.$order->getIncrementId().'","amount":'.$ordergrandtotal.',"paymentMethod":"'.$payment_method.'","description":"'.$combine_product_info.'","typeDelivery":"forward","sender":{"email":"sales@karamfoods.ae",
          "phone":"+971564420875","address": "Building # 358,4th Street,Al Quoz 3 - Dubai - United Arab Emirates","name": "Karam Foods Industries, Sales Office"},"recipient":{"name":"'.$name.'","phone":"+971'.$order->getShippingAddress()->getTelephone().'","address":"'.$combine_address.'","city":"'.$order->getShippingAddress()->getRegion().'"}}]';
          //print_r($database);die;

          //generate log file            
          $data_log='['.date('Y-m-d h:i:s').'] - Sending - url -'.$url.' - Order id -'. $order->getIncrementId(). '- send data to shipa - '.$database;
          $mylogfile = file_put_contents('pub/shipalogs.txt',$data_log.PHP_EOL , FILE_APPEND | LOCK_EX);

          //generate log file
          //end generate log file
       
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

          $headers = array();
          $headers[] = "Accept: application/json";
          $headers[] = "Content-Type: application/json";
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          $result = curl_exec($ch);
         
          if (curl_errno($ch)) {
              echo 'Error:' . curl_error($ch);
          }
            curl_close ($ch);
            $rowData = $this->_objectManager->create('Karamcoffee\Maraexpress\Model\Maraexpress');
            $rowData->setOrderId($order->getEntityId());
            $rowData->setIncrementId($order->getIncrementId());
            $rowData->setMaraResponse($result);
            $rowData->save();

                // For create tracking number

            //generate log file            
            $data_logss='['.date('Y-m-d h:i:s').'] - Receiving - Order id -'. $order->getIncrementId(). '- Receive data from shipa - '.$result;
            file_put_contents('pub/shipalogs.txt',$data_logss.PHP_EOL , FILE_APPEND | LOCK_EX);
            //end generate log file
                $result = json_decode($result);                
               
                //mail("testck92@gmail.com","subject data",print_r($data_logss,true));

        


                //$mainvalues=array('url'=>$url ,'postfields'=>$database,'results'=>$result);
                //mail("testck92@gmail.com","subject data",print_r($mainvalues,true));  die;
                $deliveryInfo = (!is_object($result))?(isset($result[0]->deliveryInfo)?$result[0]->deliveryInfo:array()):array();
                if(!empty($deliveryInfo)){
                    $reference = isset($deliveryInfo->reference)?$deliveryInfo->reference:'';
                    $data = array(
                        'carrier_code' => 'custom',
                        'title' => $maraexpress_carrier_name,
                        'number' => $reference, // Replace with your tracking number
                    );

                    $track = $this->trackFactory->create()->addData($data);
                    $shipment->addTrack($track)->save();
                }
            }/*else{
                $result = isset($OrderData[0]->mara_response)?$OrderData[0]->mara_response:'';
            }*/
        }
    }
}