<?php
namespace Wyomind\PickupAtStore\Controller\Adminhtml\Calendar\Events;

/**
 * Interceptor class for @see \Wyomind\PickupAtStore\Controller\Adminhtml\Calendar\Events
 */
class Interceptor extends \Wyomind\PickupAtStore\Controller\Adminhtml\Calendar\Events implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Sales\Model\OrderRepository $orderRepository, \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\Framework\Api\FilterBuilder $filterBuiler, \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder, \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory, \Magento\Framework\Serialize\Serializer\Json $jsonHelper)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $orderRepository, $searchCriteriaBuilder, $filterBuiler, $filterGroupBuilder, $posCollectionFactory, $jsonHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
