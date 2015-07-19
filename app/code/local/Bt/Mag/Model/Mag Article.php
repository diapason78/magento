<?php
class Bt_Mag_Model_MagArticle extends Mage_Core_Model_Abstract
{
    
    protected function _construct()
    {
        $this->_init('bt_mag/mag_article');
    }

    //~ public function getCategories()
    //~ {
        //~ return [
            //~ Mage::helper('bt_mag')->__('Bloc simple'),
            //~ Mage::helper('bt_mag')->__('Bloc extensible')
        //~ ];
    //~ }
	//~ 
    //~ protected function _beforeSave()
    //~ {
        //~ parent::_beforeSave();
//~ 
        //~ $this->_changeCreateTime();
        //~ $this->_changeUpdateTime();
        //~ $this->_uploadFile();
        //~ $this->_changeImgPath();
        //~ $this->_changeBackgroundColor();
//~ 
        //~ return $this;
    //~ }
}
