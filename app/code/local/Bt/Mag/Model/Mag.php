<?php
class Bt_Mag_Model_Mag extends Mage_Core_Model_Abstract
{
    
    protected function _construct()
    {
        $this->_init('bt_mag/mag');
    }

	public function getTitles()
	{
		return ['tile1', 'title2'];
	}
	
	public function getStatuses()
	{
		$statusesCollection = Mage::getModel('bt_mag/status')->getCollection()->addFieldToSelect('name');
		$statuses = [];
		foreach($statusesCollection as $status) {
			$statuses[] = $status->getData('name');
		}

		return $statuses;
	}
	
	public function getArticles()
	{
		$articlesCollection = Mage::getModel('bt_mag/article')->getCollection()->addFieldToSelect('title');
		$articles = [];
		foreach($articlesCollection as $article) {
			$articles[] = $article->getData('title');
		}

		return $articles;
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
