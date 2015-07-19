<?php
class Bt_Mag_Model_Resource_MagArticle extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('bt_mag/magarticle', 'mag_article_id');
    }
}
