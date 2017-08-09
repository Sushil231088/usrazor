<?php
class Celtic_Gauniversal_Model_Observer
{
    public function onCheckoutSuccess(Varien_Event_Observer $ob)
    {
        $orderIds = $ob->getEvent()->getData('order_ids');

        if ($orderIds) {
            /* @var $layout Mage_Core_Model_Layout */
            $layout = Mage::getSingleton('core/layout');
            $tagBlock = $layout->getBlock('celticga_ecommerce');
            if ($tagBlock) {
                $tagBlock->setOrderIds($orderIds);
            }
        }
    }

    public function generateFile(Varien_Event_Observer $observer){
        $file = $observer->getEvent()->getFile();
        $fileNames = $this->_getFilePath($file);

        foreach($fileNames as $_file) {
            if(!file_exists(dirname($_file))) {
                mkdir(dirname($_file), 0777, true);
            }

            if(!$file->getIsActive()) {
                //remove file if the file is inactivated.
                $this->removeFile($observer);
            } else {
                if($fp = fopen($_file, "w")) {
                    fwrite($fp, $file->getContents());
                    fclose($fp);
                }
            }
        }

        return $this;
    }

    public function removeFile(Varien_Event_Observer $observer){
        $file = $observer->getEvent()->getFile();
        $fileNames = $this->_getFilePath($file);

        foreach($fileNames as $_file) {
            if(file_exists($_file)) {
                unlink($_file);
            }
        }
        return $this;
    }

    /**
     * Remove old file if the file name and store view were changed.
     *
     * @param $observer
     * @return $this
     */
    public function removeOldFile($observer)
    {
        $curFile = $observer->getEvent()->getFile();
        $oldFile = Mage::getModel('csseditor/css')->load($curFile->getId());

        if(!$oldFile->getId())
        {
            return;
        }

        if(($oldFile->getFileName . $oldFile->getFileType()) != ($curFile->getFileName . $curFile->getFileType())) {
            $this->_removeOldNameFile($oldFile);
        }

        $oldStores = explode(',', $oldFile->getStoreIds());
        $curStores = explode(',', $curFile->getStoreIds());

        foreach($oldStores as $old) {
            if(!in_array($old, $curStores)) {
                $this->_removeUnselectedStoreViewFile($oldFile, $old);
            }
        }

        return $this;
    }

    protected function _removeOldNameFile($file)
    {
        $fileNames = $this->_getFilePath($file);

        foreach ($fileNames as $_file) {
            if(file_exists($_file)) {
                unlink($_file);
            }
        }
    }

    protected function _removeUnselectedStoreViewFile($oldFile, $diff)
    {
        //foreach($diffs as $_diff) {
        $_file = $this->_getFilePath($oldFile, $diff);

        if(file_exists($_file)) {
            $res = unlink($_file);
        }
        //}
    }

    protected function _getFilePath($file, $storeId=null)
    {
        if($storeId != null) {
            return Mage::getBaseDir('media') . DS . "celticga" . DS . $file->getPackageTheme() . DS . $storeId . DS . $file->getFileName() . $file->getFileType();
        } else {
            $_files = array();
            $_stores = explode(',', $file->getStoreIds());
            foreach ($_stores as $_store) {
                $_files[] = Mage::getBaseDir('media') . DS . "celticga" . DS . $file->getPackageTheme() . DS . $_store . DS . $file->getFileName() . $file->getFileType();
            }
            return $_files;
        }
    }
}