<?php
class Celtic_Gauniversal_Block_Ecommerce extends Mage_Core_Block_Template
{
    public function getOrders($orderIds)
    {
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }
        $collection = Mage::getResourceModel('sales/order_collection')
            ->addFieldToFilter('entity_id', array('in' => $orderIds))
        ;
        return $collection;
    }

    public function getOrderTag($order)
    {
        $tag = "
        ga('ecommerce:addTransaction', {
        'id': '{$order->getIncrementId()}',
        'affiliation': '". Mage::app()->getStore()->getFrontendName(). "',
        'revenue': '{$order->getBaseGrandTotal()}',
        'shipping': '{$order->getBaseShippingAmount()}',
        'tax': '{$order->getBaseTaxAmount()}',
        'currency': '{$order->getBaseCurrencyCode()}'
        });";

        return $tag;
    }

    public function getOrderItemTag($item, $order)
    {
        $tag = "
        ga('ecommerce:addItem', {
        'id': '{$order->getIncrementId()}',
        'name': '{$this->jsQuoteEscape($item->getName())}',
        'sku': '{$this->jsQuoteEscape($item->getSku())}',
        'category': '',
        'price': '{$item->getBasePrice()}',
        'quantity': '{$item->getQtyOrdered()}',
        'currency': '{$order->getBaseCurrencyCode()}'
        });
        ";

        return $tag;
    }
}