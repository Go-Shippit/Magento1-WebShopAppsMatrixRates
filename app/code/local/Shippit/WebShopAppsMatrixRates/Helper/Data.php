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

class Shippit_WebShopAppsMatrixRates_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_SETTINGS = 'shippit/addon_webshopappsmatrixrates/';

    /**
     * Return store config value for key
     *
     * @param   string $key
     * @return  string
     */
    public function getStoreConfig($key, $flag = false)
    {
        $path = self::XML_PATH_SETTINGS . $key;

        if ($flag) {
            return Mage::getStoreConfigFlag($path);
        }
        else {
            return Mage::getStoreConfig($path);
        }
    }

    public function isActive()
    {
        return self::getStoreConfig('active', true);
    }

    public function getModuleVersion()
    {
        $version = (string) Mage::getConfig()
            ->getNode('modules/Shippit_WebShopAppsMatrixRates/version');

        return $version;
    }
}
