<?php
namespace Magento\Customer\Ui\Component\DataProvider\Document;

/**
 * Interceptor class for @see \Magento\Customer\Ui\Component\DataProvider\Document
 */
class Interceptor extends \Magento\Customer\Ui\Component\DataProvider\Document implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Api\AttributeValueFactory $attributeValueFactory, \Magento\Customer\Api\GroupRepositoryInterface $groupRepository, \Magento\Customer\Api\CustomerMetadataInterface $customerMetadata, \Magento\Store\Model\StoreManagerInterface $storeManager, ?\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig = null)
    {
        $this->___init();
        parent::__construct($attributeValueFactory, $groupRepository, $customerMetadata, $storeManager, $scopeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAttribute($attributeCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomAttribute');
        return $pluginInfo ? $this->___callPlugins('getCustomAttribute', func_get_args(), $pluginInfo) : parent::getCustomAttribute($attributeCode);
    }
}
