<?php
namespace Magento\Framework\Stdlib\Cookie\PhpCookieManager;

/**
 * Interceptor class for @see \Magento\Framework\Stdlib\Cookie\PhpCookieManager
 */
class Interceptor extends \Magento\Framework\Stdlib\Cookie\PhpCookieManager implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Stdlib\Cookie\CookieScopeInterface $scope, \Magento\Framework\Stdlib\Cookie\CookieReaderInterface $reader, ?\Psr\Log\LoggerInterface $logger = null, ?\Magento\Framework\HTTP\Header $httpHeader = null)
    {
        $this->___init();
        parent::__construct($scope, $reader, $logger, $httpHeader);
    }

    /**
     * {@inheritdoc}
     */
    public function setPublicCookie($name, $value, ?\Magento\Framework\Stdlib\Cookie\PublicCookieMetadata $metadata = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPublicCookie');
        return $pluginInfo ? $this->___callPlugins('setPublicCookie', func_get_args(), $pluginInfo) : parent::setPublicCookie($name, $value, $metadata);
    }
}
