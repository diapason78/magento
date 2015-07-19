<?php
class Bt_Mag_ArticleController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $articleBlock = 
			$this
				->getLayout()
                ->createBlock('bt_mag/article');
        $this
			->loadLayout()
            ->_addContent($articleBlock)
            ->renderLayout();
    }

    public function editAction()
    {

        $session = Mage::getSingleton('adminhtml/session');
        $postData = $this->getRequest()->getPost('articleData');
        $article = Mage::getModel('bt_mag/article');
        $postedArticleId = $this->getRequest()->getParam('id', false);
        if ($postedArticleId) {
            $article->load($postedArticleId);
            if (empty($article->getId())) {
				$session->addError($this->__('This article no longer exists.'));

                return $this->_redirect('adminhtml/article/index');
			}
        }
        if ($postData) {
            try {
                $article
					->addData($postData)
					->save();
                $session->addSuccess($this->__('The article has been saved.'));

                return $this->_redirect('adminhtml/article/edit', ['id' => $article->getId()]);
            } catch (Exception $e) {
                Mage::logException($e);
                $session->addError($e->getMessage());
            }
        }
        Mage::register('current_article', $article);
        $articleEditBlock = $this->getLayout()->createBlock('bt_mag/article_edit');
        $this
			->loadLayout()
            ->_addContent($articleEditBlock);
        $this
            ->getLayout()
            ->getBlock('head')
            ->setCanLoadTinyMce(true);
        $this
            ->renderLayout();
    }

    public function deleteAction()
    {
        $session = Mage::getSingleton('adminhtml/session');
        $article = Mage::getModel('bt_mag/article');
		$articleId = $this->getRequest()->getParam('id', false);
        if ($articleId) {
            $article->load($articleId);
        }
		if (empty($article->getId())) {
			$session->addError($this->__('This article no longer exists.'));

			return $this->_redirect('adminhtml/article/index');
		}
        try {
            $article->delete();
            $session->addSuccess($this->__('The article has been deleted.'));
        } catch (Exception $e) {
            Mage::logException($e);
            $session->addError($e->getMessage());
        }

        return $this->_redirect('adminhtml/article/index');
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
                $isAllowed = $adminSession->isAllowed('bt_mag/article');
                break;
        }

        return $isAllowed;
    }
}
