<?php
/**
 * Shippit Pty Ltd
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the terms
 * that is available through the world-wide-web at this URL:
 * http://www.shippit.com/terms
 *
 * @category   Shippit
 * @copyright  Copyright (c) Shippit Pty Ltd (http://www.shippit.com)
 * @author     Matthew Muscat <matthew@mamis.com.au>
 * @license    http://www.shippit.com/terms
 */

class Shippit_WebShopAppsMatrixRates_Model_Observer_System_Config
{
    protected $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('shippit_webshopappsmatrixrates');
    }

    public function showNotification(Varien_Event_Observer $observer)
    {
        if (!$this->helper->isActive()) {
            return;
        }

        Mage::getSingleton('adminhtml/session')->addWarning(
            $this->helper->__('If you have just updated your WebShopApps Matrix Rates - Don\'t Forget to update your Shippit Shipping Method Mappings')
        );
    }
}
