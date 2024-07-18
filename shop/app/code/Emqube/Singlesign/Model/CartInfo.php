<?php 
namespace Emqube\Singlesign\Model;
use Magento\Quote\Model\QuoteFactory;
use Magento\Quote\Model\ResourceModel\Quote;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Api\ProductRepositoryInterfaceFactory;


class CartInfo {

	/**
	 * {@inheritdoc}
	 */
    protected $quoteFactory;
    protected $quoteModel;

    protected $_productloader;
    protected $_storeManager;
    protected $_productRepositoryFactory;
    public function __construct(
        QuoteFactory $quoteFactory,
        Quote $quoteModel,
        ProductRepositoryInterface $productrepository,
        StoreManagerInterface $storemanager,
        ProductRepositoryInterfaceFactory $productRepositoryFactory
    ) {
        $this->quoteFactory = $quoteFactory;
        $this->quoteModel=$quoteModel;
        $this->productrepository = $productrepository;
        $this->_storeManager =  $storemanager;
        $this->_productRepositoryFactory = $productRepositoryFactory;
    }

	public function getCart($id)
	{   
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerObj = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $quote = $this->quoteFactory->create()->loadByCustomer($customerObj);
        $items = $quote->getAllItems();

        $cart_data = array();
        $store = $this->_storeManager->getStore();
        foreach($items as $item_data)
        {
            $product = $this->productrepository->getById($item_data['product_id']);
            $productImageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' .$product->getImage(); 
            $productUrl = $product->getProductUrl();

            $product = $this->_productRepositoryFactory->create()->getById($item_data['product_id']);
            $image_url=$product->getData('small_image');
            $cart_data[] = array(
                'name'=> $item_data['name'],
                'product_id'=> $item_data['product_id'],
                'price'=>$item_data['price'],                               
                'qty'=> $item_data['qty'],
                'image'=>$image_url,
                'url'=>$productUrl
            );
        } 
    
        return json_encode($cart_data);
        
	}
   
}