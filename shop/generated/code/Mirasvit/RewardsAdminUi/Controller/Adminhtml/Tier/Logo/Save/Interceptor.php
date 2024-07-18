<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Tier\Logo\Save;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Tier\Logo\Save
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Tier\Logo\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Mirasvit\Rewards\Model\Tier\Backend\FileProcessor $fileProcessor)
    {
        $this->___init();
        parent::__construct($context, $fileProcessor);
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
