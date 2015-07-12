<?php
class Bt_Mag_Model_Resource_Article extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('bt_mag/article', 'article_id');
    }
}
