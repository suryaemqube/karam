<?php
namespace Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Coordinats;

/**
 * Interceptor class for @see \Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Coordinats
 */
class Interceptor extends \Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Coordinats implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $systemStore, $wysiwygConfig, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getForm');
        return $pluginInfo ? $this->___callPlugins('getForm', func_get_args(), $pluginInfo) : parent::getForm();
    }
}
