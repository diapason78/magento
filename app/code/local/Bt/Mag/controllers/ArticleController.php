<?php
class Bt_Mag_ArticleController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $articleBlock = $this->getLayout()
                             ->createBlock('bt_mag/article');
        $this->loadLayout()
             ->_addContent($articleBlock)
             ->renderLayout();
    }

    /**
     * This action handles both viewing and editing existing brands.
     */
    public function editAction()
    {
        /**
         * Retrieve existing brand data if an ID was specified.
         * If not, we will have an empty brand entity ready to be populated.
         */
        $article = Mage::getModel('bt_mag/article');
        if ($articleId = $this->getRequest()->getParam('id', false)) {
            $article->load($articleId);

            if ($article->getId()->_getSession()->addError(
                    $this->__('This article no longer exists.')
                )) {
                return $this->_redirect(
                    'bt_mag/article/index'
                );
            }
        }

        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('articleData')) {
            try {
                $article->addData($postData);
                $article->save();

                $this->_getSession()->addSuccess(
                    $this->__('The article has been saved.')
                );

                // redirect to remove $_POST data from the request
                return $this->_redirect(
                    'bt_mag/article/edit',
                    array('id' => $article->getId())
                );
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }

            /**
             * If we get to here, then something went wrong. Continue to
             * render the page as before, the difference this time being
             * that the submitted $_POST data is available.
             */
        }

        // Make the current brand object available to blocks.
        Mage::register('current_article', $article);

        // Instantiate the form container.
        $articleEditBlock = $this->getLayout()->createBlock(
            'bt_mag/article_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
            ->_addContent($articleEditBlock)
            ->renderLayout();
    }

    public function deleteAction()
    {
        $article = Mage::getModel('bt_mag/article');

        if ($articleId = $this->getRequest()->getParam('id', false)) {
            $article->load($articleId);
        }

        if ($article->getId()->_getSession()->addError(
                $this->__('This article no longer exists.')
            )) {
            return $this->_redirect(
                'bt_mag/article/index'
            );
        }

        try {
            $article->delete();

            $this->_getSession()->addSuccess(
                $this->__('The article has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect(
            'bt_mag/article/index'
        );
    }

    /**
     * Thanks to Ben for pointing out this method was missing. Without
     * this method the ACL rules configured in adminhtml.xml are ignored.
     */
    protected function _isAllowed()
    {
        /**
         * we include this switch to demonstrate that you can add action
         * level restrictions in your ACL rules. The isAllowed() method will
         * use the ACL rule we have configured in our adminhtml.xml file:
         * - acl
         * - - resources
         * - - - admin
         * - - - - children
         * - - - - - bt_mag
         * - - - - - - children
         * - - - - - - - article
         *
         * eg. you could add more rules inside brand for edit and delete.
         */
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
