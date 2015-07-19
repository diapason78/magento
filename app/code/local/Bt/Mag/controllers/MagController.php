<?php
class Bt_Mag_MagController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $magBlock = 
			$this
				->getLayout()
                ->createBlock('bt_mag/mag');
        $this
			->loadLayout()
            ->_addContent($magBlock)
            ->renderLayout();
    }

    public function editAction()
    {
        $session = Mage::getSingleton('adminhtml/session');
        $postData = $this->getRequest()->getPost('magData');
        $mag = Mage::getModel('bt_mag/mag');
        $postedMagId = $this->getRequest()->getParam('id', false);
        if ($postedMagId) {
            $mag->load($postedMagId);
            if (empty($mag->getId())) {
				$session->addError($this->__('This mag no longer exists.'));

                return $this->_redirect('adminhtml/mag/index');
			}
        }
        if ($postData) {
            try {
                $mag
					->addData($postData)
					->save();
                $session->addSuccess($this->__('The mag has been saved.'));

                return $this->_redirect('adminhtml/mag/edit', ['id' => $mag->getId()]);
            } catch (Exception $e) {
                Mage::logException($e);
                $session->addError($e->getMessage());
            }
        }
        Mage::register('current_mag', $mag);
        $magEditBlock = $this->getLayout()->createBlock('bt_mag/mag_edit');
        $this
			->loadLayout()
            ->_addContent($magEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $session = Mage::getSingleton('adminhtml/session');
        $mag = Mage::getModel('bt_mag/mag');
		$magId = $this->getRequest()->getParam('id', false);
        if ($magId) {
            $mag->load($magId);
        }
		if (empty($mag->getId())) {
			$session->addError($this->__('This mag no longer exists.'));

			return $this->_redirect('adminhtml/mag/index');
		}
        try {
            $article->delete();
            $session->addSuccess($this->__('The mag has been deleted.'));
        } catch (Exception $e) {
            Mage::logException($e);
            $session->addError($e->getMessage());
        }

        return $this->_redirect('adminhtml/mag/index');
    }

    protected function _isAllowed()
    {
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession->isAllowed('bt_mag/mag');
                break;
        }

        return $isAllowed;
    }
}
