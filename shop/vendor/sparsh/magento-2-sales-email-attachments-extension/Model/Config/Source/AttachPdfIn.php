<?php
/**
 * Sparsh_SalesEmailAttachments
 * PHP version 8.2
 *
 * @category Sparsh
 * @package  Sparsh_SalesEmailAttachments
 * @author   Sparsh <magento@sparsh-technologies.com>
 * @license  https://www.sparsh-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.sparsh-technologies.com
 */
namespace Sparsh\SalesEmailAttachments\Model\Config\Source;

/**
 * @author   Sparsh <magento@sparsh-technologies.com>
 * @license  https://www.sparsh-technologies.com  Open Software License (OSL 3.0)
 * @link     https://www.sparsh-technologies.com
 */
class AttachPdfIn implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Attach pdf from this options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'invoice', 'label' => __('Invoice')],
            ['value' => 'shipment', 'label' => __('Shipment')],
            ['value' => 'creditmemo', 'label' => __('Credit Memo')]
        ];
    }
}
