<?php



namespace Customerdata\Import\Controller\Adminhtml\Import;

use Magento\Framework\Json\EncoderInterface;

use Magento\Framework\App\Filesystem\DirectoryList;



class Save extends \Magento\Backend\App\Action

{

    /**

     * @var \Magento\Framework\Registry

     */

    protected $_coreRegistry = null;



    /**

     * @var \Magento\Framework\View\Result\PageFactory

     */

    protected $resultPageFactory;



    /**

     * @var \Magento\Framework\Filesystem

     */

    protected $_filesystem;



    /**

     * @var \Magento\Framework\App\Config\ScopeConfigInterface

     */

    protected $_scopeConfig;



    /**

     * @var \Magento\Store\Model\StoreManagerInterface

     */

    protected $_storeManager;



    /**

     * @var \Magento\Framework\App\Config\ConfigResource\ConfigInterface

     */

    protected $_configResource;

protected $_customerRepositoryInterface;

    /**

     * @param \Magento\Backend\App\Action\Context                          $context           

     * @param \Magento\Framework\View\Result\PageFactory                   $resultPageFactory 

     * @param \Lof\Setup\Helper\Import                                     $lofImport           

     * @param \Magento\Framework\Filesystem                                $filesystem        

     * @param \Magento\Store\Model\StoreManagerInterface                   $storeManager      

     * @param \Magento\Framework\App\Config\ScopeConfigInterface           $scopeConfig       

     * @param \Magento\Framework\App\ResourceConnection                    $resource          

     * @param \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configResource

     * @param \Magento\Catalog\Model\Product\Media\Config $mediaConfig    

     */

    public function __construct(

        \Magento\Backend\App\Action\Context $context,

        \Magento\Framework\View\Result\PageFactory $resultPageFactory,

        \Magento\Framework\Filesystem $filesystem,

        \Magento\Store\Model\StoreManagerInterface $storeManager,

        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,

        \Magento\Framework\App\ResourceConnection $resource,

        \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configResource,

        \Magento\Catalog\Model\Product\Media\Config $mediaConfig,

        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,

        \Magento\Customer\Model\CustomerFactory $customerFactory

    ) {

        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;

        $this->_filesystem       = $filesystem;

        $this->_storeManager     = $storeManager;

        $this->_scopeConfig      = $scopeConfig;

        $this->_configResource   = $configResource;

        $this->_resource         = $resource;

        $this->mediaConfig       = $mediaConfig;

        $this->_customerRepositoryInterface = $customerRepositoryInterface;

        $this->_customerFactory = $customerFactory;

    }



    /**

     * Forward to edit

     *

     * @return \Magento\Backend\Model\View\Result\Forward

     */





    public function execute()

    {

        $data = $this->getRequest()->getParams();

  

if (isset($data)) {





$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

$date_from = date('Y-m-d 00:00:00', strtotime($data['date_from']));

$date_to = date('Y-m-d 23:59:59', strtotime($data['date_to']));

/*     $order = $this->_objectManager->create('Magento\Sales\Model\Order')->getCollection()->addAttributeToFilter('state', 'complete')->addAttributeToFilter('created_at', array(
                                            'from' => $date_from,
                                            'to' => $date_to,
                                            'date' => true,
                                            ));*/
$order = $this->_objectManager->create('Magento\Sales\Model\Order')->getCollection()->addAttributeToFilter('main_table.state', 'complete')->addAttributeToFilter('sales_invoice.created_at', array(
                                            'from' => $date_from,
                                            'to' => $date_to,
                                            'date' => true,
                                            ));

$order->getSelect()
        ->join(array('sales_invoice' =>'sales_invoice'),  'main_table.entity_id= sales_invoice.order_id',
        array('sales_invoice_id' => 'sales_invoice.entity_id'            
        ) );



  $items_array = array();

  foreach ($order as $order_data) {



    //echo '</br>'.$order_items->getGrandTotal();



    $order_items = $this->_objectManager->create('Magento\Sales\Model\Order')->load($order_data->getEntityId());

    $billing_address = $order_items->getBillingAddress();

  

    $billing_name = $billing_address->getFirstname().' '.$billing_address->getLastname();

    $streetaddress = $billing_address->getStreet();

    $street = '';

    if(!empty($streetaddress)){

      $street = $streetaddress[0];

    }

    $shipping_amount = $order_items->getShippingAmount();



    foreach ($order_items->getInvoiceCollection() as $invoice)

        {

           $invoice_id = $invoice->getIncrementId();

           $invoice_created_at = $invoice->getCreatedAt();  

        }

    $orderItems = $order_items->getAllVisibleItems();

    foreach ($orderItems as $key=>$value) {

      $value->getQtyOrdered();

      $value->getRowTotalInclTax();

      $value->getName();

      $value->getSku();

      $value->getPriceInclTax();

        $discount_amount = $value->getDiscountAmount();
        $discount_amount = floatval(abs($discount_amount));
        $discount_percentage = (($discount_amount > 0)?($discount_amount/($value->getPrice()*$value->getQtyOrdered()) * 100):0);

            //if($key==0){

             $items_array[] = array('#'.$order_items->getIncrementId(),'#'.$invoice_id,$invoice_created_at,'','',$value->getSku(),$value->getName(),'',$value->getQtyOrdered(),$value->getPrice(),$discount_percentage,$value->getPrice()*$value->getQtyOrdered(),'','','',$billing_name,$street,$shipping_amount);

            /*}else{

              $items_array[] = array('','','','','',$value->getSku(),$value->getName(),'',$value->getQtyOrdered(),$value->getPriceInclTax(),'','','','','','','','');

            }*/

    }

  }





$date = date('Y-m-d');

// output headers so that the file is downloaded rather than displayed

header('Content-type: text/csv');

header('Content-Disposition: attachment; filename="OrderData'.$date.'.csv"');

// do not cache the file

header('Pragma: no-cache');

header('Expires: 0');

// create a file pointer connected to the output stream

$file = fopen('php://output', 'w');

// send the column headers

fputcsv($file, array('OnlineRefNo', 'Invoice No', 'Invoice Date', 'CardCode', 'CardName', 'ItemCode', 'ItemName', 'batchNum', 'Quantity', 'Price', 'Discount', 'Total', 'Uom Entry', 'Uom Code', 'Warehouse', 'Name', 'Address', 'Freight'));

$data=$items_array;



// output each row of the data

foreach ($data as $row)

{

fputcsv($file, $row);

}

 exit();



$this->messageManager->addSuccess(__("Exported Order successfully")); 

    $resultRedirect = $this->resultRedirectFactory->create();

    return $resultRedirect->setPath('*/*/');

 } 

    

    }

}

