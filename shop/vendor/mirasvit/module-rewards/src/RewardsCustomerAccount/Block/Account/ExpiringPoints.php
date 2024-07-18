<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   3.2.4
 * @copyright Copyright (C) 2024 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\RewardsCustomerAccount\Block\Account;

use Mirasvit\Rewards\Service\ExpirationPoints;
use Magento\Customer\Model\Session;
use Mirasvit\Rewards\Helper\Data as PointsData;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ExpiringPoints extends Template
{
    protected $expirationPoints;

    private   $pointsData;

    public function __construct(
        ExpirationPoints $expirationPoints,
        PointsData       $pointsData,
        Context          $context,

        array            $data = []
    ) {
        parent::__construct($context, $data);

        $this->expirationPoints = $expirationPoints;
        $this->pointsData       = $pointsData;
    }

    public function getExpiringPointsAmount(): int
    {
        return $this->expirationPoints->getExpiringPointsAmount();
    }

    public function getExpiringPointsDays(): int
    {
        return $this->expirationPoints->getExpiringPointsDays();
    }

    public function getPointsName(): string
    {
        return $this->pointsData->getPointsName();
    }
}
