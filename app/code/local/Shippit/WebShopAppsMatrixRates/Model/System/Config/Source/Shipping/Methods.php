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

class Shippit_WebShopAppsMatrixRates_Model_System_Config_Source_Shipping_Methods extends Shippit_Shippit_Model_System_Config_Source_Shipping_Methods
{
    public function toOptionArray($excludeShippit = false)
    {
        $optionsArray = parent::toOptionArray($excludeShippit);

        // If the webshopappsmodule is installed,
        // fetch the available methods from their tables
        if (!Mage::helper('shippit_webshopappsmatrixrates')->isActive()
            || !Mage::helper('core')->isModuleEnabled('Webshopapps_Matrixrate')) {
            return $optionsArray;
        }

        // Find and remove the existing matrixrates entry
        // if (PHP_VERSION_ID < 50500) {
        //     foreach ($items as $key => $value) {
        //         if (isset($value[$itemKey]) && $value[$itemKey] == $itemValue) {
        //             if (isset($value[$itemDataKey])) {
        //                 return $value[$itemDataKey];
        //             }
        //             else {
        //                 return false;
        //             }
        //         }
        //     }
        // }
        // else {
        //     $searchResult = array_search($itemValue, array_column($items, $itemKey));

        //     if ($searchResult !== false) {
        //         return $items[$searchResult][$itemDataKey];
        //     }
        // }

        $matrixRateOptions = $this->getWsaMatrixRateOptions();
        $optionsArray = array_merge($optionsArray, $matrixRateOptions);

        return $optionsArray;
    }

    protected function getWsaMatrixRateOptions()
    {
        $optionsArray = [];

        $matrixRateRates = $this->getWsaMatrixRateRates();

        // Get the matrix rate name
        $title = Mage::getStoreConfig('carriers/matrixrate/title');

        foreach ($matrixRateRates as $matrixRateRate) {
            $optionsArray[] = array(
                'label' => sprintf(
                    '%s (%s)',
                    $title,
                    $matrixRateRate['delivery_type']
                ),
                'value' => sprintf(
                    'matrixrate_matrixrate_%s',
                    $matrixRateRate['pk']
                )
            );
        }

        return $optionsArray;
    }

    protected function getWsaMatrixRateRates()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $query = 'SELECT `pk`, `delivery_type` FROM `shipping_matrixrate`';

        return $readConnection->fetchAll($query);
    }
}
