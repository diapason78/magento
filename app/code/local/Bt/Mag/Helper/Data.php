<?php
class Bt_Mag_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function upload()
	{
		$fileName = '';
		if (!empty($_FILES['articleData']['name']['img_path'])) {
			try {
				$file = [
					'name'     => $_FILES['articleData']['name']['img_path'],
					'type'     => $_FILES['articleData']['type']['img_path'],
					'tmp_name' => $_FILES['articleData']['tmp_name']['img_path'],
					'error'    => $_FILES['articleData']['error']['img_path'],
					'size'     => $_FILES['articleData']['size']['img_path']
				];
				$uploader = new Varien_File_Uploader($file);
				$uploader->setAllowedExtensions(array('jpg', 'png'));
				$uploader->setAllowRenameFiles(false);
				$uploader->setFilesDispersion(false);
				$path = Mage::getBaseDir('media') . DS . 'img/mag';
				if(!is_dir($path)){
					mkdir($path, 0777, true);
				}
				$uploader->save($path . DS, $_FILES['articleData']['name']['img_path']);
				
				return 'img/mag/'. $_FILES['articleData']['name']['img_path'];
			} catch (Exception $e) {
				Mage::getSingleton('customer/session')->addError($e->getMessage());
				$error = true;
			}
		}
	}
}
