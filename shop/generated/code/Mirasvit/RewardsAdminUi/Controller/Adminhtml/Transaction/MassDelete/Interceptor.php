<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Transaction\MassDelete;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Transaction\MassDelete
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Transaction\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Model\TransactionFactory $transactionFactory, \Magento\Customer\Model\CustomerFactory $customerFactory, \Mirasvit\Rewards\Helper\Balance $rewardsBalance, \Magento\Framework\Registry $registry, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Mirasvit\Rewards\Model\ResourceModel\Transaction\CollectionFactory $collectionFactory)
    {
        $this->___init();
        parent::__construct($transactionFactory, $customerFactory, $rewardsBalance, $registry, $fileFactory, $context, $filter, $collectionFactory);
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
