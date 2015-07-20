<?php
class Bt_Mag_Model_Article extends Mage_Core_Model_Abstract
{
    private $imgPath;
    
    protected function _construct()
    {
        $this->_init('bt_mag/article');
    }

    public function getCategories()
    {
        return [
            Mage::helper('bt_mag')->__('Bloc simple'),
            Mage::helper('bt_mag')->__('Bloc extensible')
        ];
    }

    public function getSizes()
    {
        return [
            Mage::helper('bt_mag')->__('50%'),
            Mage::helper('bt_mag')->__('100%')
        ];
    }
    
    public function getBackgroundColors($id)
    {
		$value = null;
		$bgcolor = $this
		    ->load($id)
            ->getData('background_color');
        if (!is_null($bgcolor) && !in_array($bgcolor, ['#FFFFFF', '#D8D8D8', '#F3E2A9'])) {

			$value = 'value="' . $bgcolor . '"';
		} else {
			$bgcolor = 'autre';
		}
		
		return [
			['value'=>'#FFFFFF','label'=>'<div id="bg1" title="#FFFFFF" class="firstbackground" ></div>'],
			['value'=>'#D8D8D8','label'=>'<div id="bg2" title="#D8D8D8" class="secondbackground" ></div>'],
			['value'=>'#F3E2A9','label'=>'<div id="bg3" title="#F3E2A9" class="thirdbackground" ></div>'],
			['value'=>$bgcolor,'label'=>'<input ' . $value . ' placeholder="Autre #Hexa" name="articleData[background_color_autre]" />']
		];
	}
	
    protected function _beforeSave()
    {
        parent::_beforeSave();

        $this->_changeCreateTime();
        $this->_changeUpdateTime();
        $this->_uploadFile();
        $this->_changeImgPath();
        $this->_changeBackgroundColor();

        return $this;
    }

    protected function _changeCreateTime()
    { 
        $id = $this->getId();
        if (empty($id)) {
			$dateTime = new DateTime();
			$this->setCreateTime($dateTime->format('Y-m-d h:i:s'));
	    }

        return $this;
    }

    protected function _changeUpdateTime()
    { 
        $dateTime = new DateTime();
		$this->setUpdateTime($dateTime->format('Y-m-d h:i:s'));

        return $this;
    }

    protected function _uploadFile()
    { 

		$helper = Mage::helper('bt_mag');
		$this->imgPath = null;
		$upload = $helper->upload();
		if (!empty($upload)) {
		    $this->imgPath = $upload;
	    }

        return $this;
    }

    protected function _changeImgPath()
    {
        if (!empty($this->imgPath) ) {
			$this->setImgPath($this->imgPath);
	    }
        
        return $this;
    }

    protected function _changeBackgroundColor()
    {
        $bgColor = Mage::app()->getRequest()->getParam('articleData')['background_color_autre'];
        if (Mage::app()->getRequest()->getParam('articleData')['background_color'] === 'autre') {
            $this->setBackgroundColor($bgColor);
        }

        return $this;
    }
}
