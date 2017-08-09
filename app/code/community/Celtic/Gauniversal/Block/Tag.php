<?php
class Celtic_Gauniversal_Block_Tag extends Mage_Core_Block_Template
{
    public function getTrackingId()
    {
        return Mage::getStoreConfig('google/celticga/account');
    }

    public function getDomainName()
    {
        return Mage::getStoreConfig('google/celticga/domain');
    }

    public function isEnabled()
    {
        return Mage::getStoreConfig('google/celticga/enable');
    }

    public function getParam()
    {
        $param ='';
        if(Mage::getStoreConfig('google/celticga/usecustom')) {
            $param = "{
                           'cookieDomain': '".Mage::getStoreConfig('google/celticga/cookiedomain')."',
                           'cookieName': '".Mage::getStoreConfig('google/celticga/cookiename')."',
                           'cookieExpires': ".Mage::getStoreConfig('google/celticga/cookieexpire')."
                        }";
        } else {
            $param = "'{$this->getDomainName()}'";
        }

        return $param;
    }

    public function getPageName() {
        if (!$this->hasData('page_name')) {
            $pageName = Mage::getSingleton('core/url')->escape($_SERVER['REQUEST_URI']);
            $pageName = rtrim(str_replace('index/','',$pageName), '/');
            $this->setPageName($pageName);
        }
        return $this->getData('page_name');
    }

    public function getAjaxPageTracking()
    {
        $baseUrl = preg_replace('/\/\?.*/', '', $this->getPageName());

        return '

            if(Ajax.Responders){
                Ajax.Responders.register({
                  onComplete: function(response){
                    if(!response.url.include("progress") && !response.url.include("getAdditional")){
                        if(response.url.include("saveOrder")){
                            ga("send", "pageview", "'.$baseUrl.'"+ "/opc-review-placeOrderClicked");
                        }else if(accordion.currentSection){
                            ga("send", "pageview", "'.$baseUrl.'/"+ accordion.currentSection);
                        }
                    }
                  }
                });
            }
';
    }

}