<?php
namespace Emqube\WyomindFixed\Helper;

use Wyomind\PickupAtStore\Helper\Data as WyomindData;

class Data extends WyomindData
{
    public function formatDatetime($datetime)
    {
        if ($datetime !== null) {
            $formattedDateTime = $this->_dateTime->gmtDate(
                $this->_configHelper->getDateFormat() . ' ' . $this->_configHelper->getTimeFormat(),
                strtotime($datetime)
            );
            return $this->dateTranslate($formattedDateTime);
        } else {
            // Log an error if $datetime is null
            $this->_logger->error('The datetime value is null. Cannot format date and time.');

            // Optionally, set a default value or handle this case as needed
            $defaultDateTime = $this->_dateTime->gmtDate(
                $this->_configHelper->getDateFormat() . ' ' . $this->_configHelper->getTimeFormat()
            );
            return $this->dateTranslate($defaultDateTime);
        }
    }
}
