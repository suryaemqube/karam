<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\NewConditionHtml;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\NewConditionHtml
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\NewConditionHtml implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $fileFactory, $dateFilter);
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
