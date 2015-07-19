<?php
class Bt_Mag_Model_Resource_Status extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('bt_mag/status', 'status_id');
    }
}
