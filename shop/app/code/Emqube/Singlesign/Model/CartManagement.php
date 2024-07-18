<?php 
namespace Emqube\Singlesign\Model;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteRepository;
class CartManagement {

	/**
	 * {@inheritdoc}
	 */

    protected $checkoutSession;
    protected $quoteFactory;
 
    public function __construct(
        CheckoutSession $checkoutSession,
        QuoteRepository $quoteRepository
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->quoteFactory = $quoteRepository;
    }
	public function getPost()
	{
       $quoteId = $this->getQouteId();
    //    echo $quoteId; 
    //    $quote = $this->quoteFactory->get($quoteId);
    //    $items = $quote->getAllItems();
      
      // var_dump($items);
       return $quoteId;
       //return json_encode($items);


	}
    public function getQouteId()
    {
        return (int)$this->checkoutSession->getQuote()->getId();
    }
}