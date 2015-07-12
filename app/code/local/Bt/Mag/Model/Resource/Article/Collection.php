<?php
class Bt_Mag_Model_Resource_Article_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('bt_mag/article', 'bt_mag/article');
    }
}
