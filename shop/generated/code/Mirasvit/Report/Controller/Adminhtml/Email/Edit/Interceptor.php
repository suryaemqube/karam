<?php
namespace Mirasvit\Report\Controller\Adminhtml\Email\Edit;

/**
 * Interceptor class for @see \Mirasvit\Report\Controller\Adminhtml\Email\Edit
 */
class Interceptor extends \Mirasvit\Report\Controller\Adminhtml\Email\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \Mirasvit\Report\Api\Repository\EmailRepositoryInterface $emailRepository, \Mirasvit\Report\Api\Service\EmailServiceInterface $emailService, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory)
    {
        $this->___init();
        parent::__construct($context, $registry, $emailRepository, $emailService, $resultForwardFactory);
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
