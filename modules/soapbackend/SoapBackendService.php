<?php

@set_time_limit(120);
ini_set('error_reporting', E_ALL);
require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/../../init.php');
require_once dirname(__FILE__) . '/OdaProductStruct.php';
require_once dirname(__FILE__) . '/OdaCombinationStruct.php';
require_once dirname(__FILE__) . '/OdaStockStruct.php';
require_once dirname(__FILE__) . '/OdaPriceStruct.php';
require_once dirname(__FILE__) . '/OdaFeatureStruct.php';
require_once dirname(__FILE__) . '/OdaCategoryStruct.php';
require_once dirname(__FILE__) . '/OdaTaxStruct.php';
require_once dirname(__FILE__) . '/ScriptSuppliers.php';

class SoapBackendService {

    var $module;
    // <editor-fold defaultstate="collapsed" desc="Estructura del Webservice">
    var $__dispatch_map = array();

    function SoapBackendService($module) {
        $this->module = $module;

        $this->__typedef['{http://soapinterop.org/xsd}OdaProductStruct'] = array(
                    'productCode' => 'string',
                    //'color' => 'string',
                    //'size' => 'string',
                    'descriptionShort' => 'string',
                    'description' => 'string',
                    'manufacturerCode' => 'string',
                    'manufacturerName' => 'string',
                    'supplierCode' => 'string',
                    'supplierName' => 'string',
                    'ean' => 'string',
                    'categoryCode' => 'string',
                    'categoryName' => 'string',
                    //'webStartDate' => 'date',
                    //'webFinishDate' => 'date',
                    'price' => 'decimal',
                    'reductionFrom' => 'date',
                    'reductionTo' => 'date',
                    'reductionPrice' => 'decimal',
                    'stock' => 'decimal',
                    /*
                      'material' => 'string',
                      'suela' => 'string',
                      'horma' => 'string',
                      'tacon' => 'string',
                      'comments' => 'string',
                     */
                    'photo' => 'string',
                    'productName' => 'string',
                    'refprov' => 'string'
        );

        $this->__typedef['{http://soapinterop.org/xsd}OdaCombinationStruct'] = array(
                    'productCode' => 'string',
                    'colorCode' => 'string',
                    'colorName' => 'string',
                    'colorColor' => 'string',
                    'sizeCode' => 'string',
                    'sizeName' => 'string',
                    'stock' => 'decimal',
                    'priceDiff' => 'decimal',
                    'photo' => 'string');

        $this->__typedef['{http://soapinterop.org/xsd}OdaStockStruct'] = array(
                    'productCode' => 'string',
                    'colorCode' => 'string',
                    'sizeCode' => 'string',
                    'stock' => 'decimal');

        $this->__typedef['{http://soapinterop.org/xsd}OdaPriceStruct'] = array(
                    'productCode' => 'string',
                    'price' => 'decimal',
                    'reductionFrom' => 'date',
                    'reductionTo' => 'date',
                    'reductionPrice' => 'decimal',
                    'taxCode' => 'string');

        $this->__typedef['{http://soapinterop.org/xsd}OdaFeatureStruct'] = array(
                    'productCode' => 'string',
                    'featureCode' => 'string',
                    'featureName' => 'string',
                    'featureValueCode' => 'string',
                    'featureValueText' => 'string'
                //,'featureValueCustomized' => 'string'
        );

        $this->__typedef['{http://soapinterop.org/xsd}OdaCategoryStruct'] = array(
                    'parentCode' => 'string',
                    'categoryCode' => 'string',
                    'categoryName' => 'string'
        );

        $this->__typedef['{http://soapinterop.org/xsd}OdaTaxStruct'] = array(
                    'taxCode' => 'string',
                    'taxName' => 'string',
                    'taxRate' => 'decimal'
        );

        $this->__typedef["{http://soapinterop.org/xsd}OdaProductStructArray"] = array(array('OdaProductStruct' => '{http://soapinterop.org/xsd}OdaProductStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaCombinationStructArray"] = array(array('OdaCombinationStruct' => '{http://soapinterop.org/xsd}OdaCombinationStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaFeatureStructArray"] = array(array('OdaFeatureStruct' => '{http://soapinterop.org/xsd}OdaFeatureStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaCategoryStructArray"] = array(array('OdaCategoryStruct' => '{http://soapinterop.org/xsd}OdaCategoryStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaTaxStructArray"] = array(array('OdaTaxStruct' => '{http://soapinterop.org/xsd}OdaTaxStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaStockStructArray"] = array(array('OdaStockStruct' => '{http://soapinterop.org/xsd}OdaStockStruct'));
        $this->__typedef["{http://soapinterop.org/xsd}OdaPriceStructArray"] = array(array('OdaPriceStruct' => '{http://soapinterop.org/xsd}OdaPriceStruct'));

        $this->__dispatch_map['echoString'] = array('in' => array('inputString' => 'string'),
                    'out' => array('outputString' => 'string'));
        $this->__dispatch_map['divide'] = array('in' => array('dividend' => 'int',
                        'divisor' => 'int'),
                    'out' => array('outputFloat' => 'float'));

        $this->__dispatch_map['oda_createupdate_product'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaProductStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_products'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaProductStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_combination'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaCombinationStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_combinations'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaCombinationStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_feature'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaFeatureStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_features'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaFeatureStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_category'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaCategoryStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_categories'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaCategoryStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_tax'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaTaxStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_createupdate_taxes'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaTaxStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_update_stock'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaStockStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_update_stocks'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaStockStructArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_update_price'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaPriceStruct'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_update_prices'] = array('in' => array('key' => 'string', 'inputStruct' => '{http://soapinterop.org/xsd}OdaPriceStructArray'),
                    'out' => array('output' => 'string'));

        $this->__typedef["{http://soapinterop.org/xsd}CodeArray"] = array(array('item' => 'string'));

        $this->__dispatch_map['oda_active_products'] = array('in' => array('key' => 'string', 'activeValue' => 'boolean', 'codes' => '{http://soapinterop.org/xsd}CodeArray'),
                    'out' => array('output' => 'string'));

        $this->__dispatch_map['oda_active_product'] = array('in' => array('key' => 'string', 'activeValue' => 'boolean', 'code' => 'string'),
                    'out' => array('output' => 'string'));
    }

    function __dispatch($methodname) {
        if (isset($this->__dispatch_map[$methodname])) {
            return $this->__dispatch_map[$methodname];
        }
        return null;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Funciones públicas de prueba">
    function echoString($inputString) {
        return new SOAP_Value('outputString', 'string', 'TEST echoString "' . $inputString . '"');
    }

    function divide($dividend, $divisor) {
        if ($divisor == 0) {
            return new SOAP_Fault('You cannot divide by zero', 'Client');
        } else {
            return new SOAP_Value('outputFloat', 'float', $dividend / $divisor);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_createupdate_products">
    function oda_createupdate_products($key, $inputStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($inputStructArray as $inputStruct) {
            $results .= $this->_oda_createupdate_product($inputStruct);
            $results .= "; ";
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_createupdate_product($key, $inputStruct) {
        $this->checkKey($key);
        $id_product = $this->_oda_createupdate_product($inputStruct);
        //Logger::addLog('Estoy entrando en: '.var_export($inputStruct, true));
        return new SOAP_Value('output', 'string', $id_product);
    }

    function _oda_createupdate_product($inputStruct) {
        $this->checkRequired($inputStruct, 'productCode');
        $this->checkRequired($inputStruct, 'categoryCode');
        $id_manufacturer = 0;
        $inserted_manufacturer = false;
        $id_supplier = 0;
        $inserted_supplier = false;
        $id_category = 0;
        $inserted_category = false;
        $id_product = 0;
        $inserted_product = false;
        self::checkNullDate($inputStruct->reductionFrom);
        self::checkNullDate($inputStruct->reductionTo);
        list($id_manufacturer, $inserted_manufacturer) = $this->UpdateOrCreateOdaManufacturer($inputStruct->manufacturerCode, $inputStruct->manufacturerName);
        list($id_supplier, $inserted_supplier) = $this->UpdateOrCreateOdaSupplier($inputStruct->supplierCode, $inputStruct->supplierName);
        $ids_lang = array_keys($this->GetLangsById());

        $arrCatCodes = explode('|', $inputStruct->categoryCode);
        $arrCatNames = explode('|', $inputStruct->categoryName);
        $catCount = count($arrCatCodes);
        $arrCatIds = array();
        $arrCatInserted = array();
        for ($i = 0; $i < $catCount; $i++) {
            list($id_category, $inserted_category) = $this->UpdateOrCreateCategoryFull($arrCatCodes[$i], $arrCatNames[$i]);
            $arrCatIds[] = $id_category;
            $arrCatInserted[] = $inserted_category;
        }

        if($id_manufacturer!=0){
            $man = new Manufacturer($id_manufacturer);
            $man->date_add = date('Y-m-d');
            $man->active = 1;
            $man->update();
        }
        
        if($id_supplier!=0){
            $supp = new Supplier($id_supplier);
            $supp->date_add = date('Y-m-d');
            $supp->active = 1;
            $supp->update();
        }
        list($id_product, $inserted_product) = $this->UpdateOrCreateOdaProduct($inputStruct->productCode, $id_supplier, $id_manufacturer, $inputStruct->ean, $inputStruct->price, $inputStruct->reductionFrom, $inputStruct->reductionTo, $inputStruct->reductionPrice, $inputStruct->stock, $arrCatIds[0], $inputStruct->refprov);
        if (is_null($inputStruct->productName) || $inputStruct->productName == '')
            $inputStruct->productName = $inputStruct->descriptionShort;

        $link = self::create_slug($inputStruct->productName);
        foreach ($ids_lang as $id_lang) {
            $this->UpdateProductTexts($id_lang, $id_product, $inputStruct->description, $inputStruct->descriptionShort, $link, $inputStruct->productName);
        }

        $this->ClearProductCategories($id_product);
        foreach ($arrCatIds as $id_category) {
            $this->AssignProductCategory($id_product, $id_category);
        }
		
		try {
            $Script = new ScriptSuppliers();
            $Script->RemakeProductThings();
        } catch (Exception $e) {
            file_put_contents('error_script_suppliers', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
		
		$data = array(
			'price' => $inputStruct->price,
			'id_tax_rules_group' => 1
		);
		self::updateRecord('`' . _DB_PREFIX_ . 'product_shop`', 'id_product', $id_product, $data);
		
        $id_image = $this->UpdateImage($id_product, $inputStruct->photo);

        if ($id_image > 0) {
            foreach ($ids_lang as $id_lang) {
                $this->UpdateImageTexts($id_lang, $id_image, $inputStruct->descriptionShort);
            }
        }
		
		try {
            $Script = new ScriptSuppliers();
            $Script->RemakeProductThings();
        } catch (Exception $e) {
            file_put_contents('error_script_suppliers', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
		
		
        return $id_product;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_createupdate_combination">
    function oda_createupdate_combinations($key, $OdaCombinationStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($OdaCombinationStructArray as $OdaCombinationStruct) {
            $results .= $this->_oda_createupdate_combination($OdaCombinationStruct);
            $results .= "; ";
        }
        try {
            $Script = new ScriptSuppliers();
            $Script->ResetDefaultCombinations();
        } catch (Exception $e) {
            file_put_contents('error_script_suppliers', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_createupdate_combination($key, $OdaCombinationStruct) {
        $this->checkKey($key);
        $id_combination = $this->_oda_createupdate_combination($OdaCombinationStruct);
        try {
            $Script = new ScriptSuppliers();
            $Script->ResetDefaultCombinations();
        } catch (Exception $e) {
            file_put_contents('error_script_suppliers', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
        return new SOAP_Value('output', 'string', $id_combination);
    }

    function _oda_createupdate_combination($OdaCombinationStruct) {
        $this->checkRequired($OdaCombinationStruct, 'productCode');
        $this->checkRequired($OdaCombinationStruct, 'colorCode');
        $this->checkRequired($OdaCombinationStruct, 'sizeCode');
        $tableproducts = '`' . _DB_PREFIX_ . 'product`';
        $tableCombinationImages = '`' . _DB_PREFIX_ . 'product_attribute_image`';
        $product = $this->getDataBySoapBackendCode($tableproducts, $OdaCombinationStruct->productCode);
        if (is_null($product)) {
            raiseFault('ProductCode invalid', 'ProductCode is not exists.');
        } else {
            $id_product = $product['id_product'];
            //return $id_product;
            list($id_color_group, $inserted_color_group) = $this->UpdateOrCreateOdaAttributeGroup('COLOR', 'Color', 'Color', true);
            list($id_talle_group, $inserted_talle_group) = $this->UpdateOrCreateOdaAttributeGroup('TALLE', 'Talle', 'Talle', false);
            list($id_color_attr, $inserted_color_attr) = $this->UpdateOrCreateOdaAttribute($id_color_group, $OdaCombinationStruct->colorCode, $OdaCombinationStruct->colorName, $OdaCombinationStruct->colorColor);
            list($id_talle_attr, $inserted_talle_attr) = $this->UpdateOrCreateOdaAttribute($id_talle_group, $OdaCombinationStruct->sizeCode, $OdaCombinationStruct->sizeName);
            list($id_combination, $inserted_combination) = $this->UpdateOrCreateOdaProductCombination($id_product, $id_color_attr, $id_talle_attr, $OdaCombinationStruct->stock, $OdaCombinationStruct->priceDiff);
            $id_image = $this->UpdateImage($id_product, $OdaCombinationStruct->photo, $id_combination);
            if ($id_image > 0) {
                $ids_lang = array_keys($this->GetLangsById());
                foreach ($ids_lang as $id_lang) {
                    $this->UpdateImageTexts($id_lang, $id_image, "({$OdaCombinationStruct->SizeName},{$OdaCombinationStruct->colorName})");
                }
                $sql = "DELETE FROM {$tableCombinationImages} WHERE id_product_attribute = '{$id_combination}'";
                Db::getInstance()->execute($sql);

                self::insertRecord($tableCombinationImages, array('id_product_attribute' => $id_combination, 'id_image' => $id_image));
            }
            return $id_combination;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_update_stock">
    function oda_update_stocks($key, $OdaStockStructArray) {
        $this->checkKey($key);
        $results = '';
        //$st = new OdaStockStruct('productCode', 'colorCode', 'sizeCode', 'stock');
        //$sts[] = $st;
        //return $sts;
        foreach ($OdaStockStructArray as $OdaStockStruct) {
            $results .= $this->_oda_update_stock($OdaStockStruct);
            $results .= "; ";
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_update_stock($key, $OdaStockStruct) {
        $this->checkKey($key);
        $id_combination = $this->_oda_update_stock($OdaStockStruct);
        return new SOAP_Value('output', 'string', $id_combination);
    }

    function _oda_update_stock($OdaStockStruct) {
        $this->checkRequired($OdaStockStruct, 'productCode');
        $product = $this->getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'product`', $OdaStockStruct->productCode);
        $id_product = empty($product) ? 0 : $product['id_product'];

        if ($id_product == 0) {
            raiseFault('ProductCode invalid', 'ProductCode is not exists.');
        } else if (trim($OdaStockStruct->colorCode) == '' || trim($OdaStockStruct->sizeCode) == '') {
            if ($product['quantity'] != $OdaStockStruct->stock) {
                $data = array(
                    'quantity' => $OdaStockStruct->stock,
                );
                self::updateRecord('`' . _DB_PREFIX_ . 'product`', 'id_product', $id_product, $data);
            }
        } else {
            $combination = $this->GetProductCombination($OdaStockStruct->productCode, $OdaStockStruct->colorCode, $OdaStockStruct->sizeCode);
            $id_combination = empty($combination) ? 0 : $combination['id_product_attribute'];
            if ($id_combination == 0) {
                raiseFault('Combination invalid', 'Combination not exist.');
            } else if ($combination['quantity'] != $OdaStockStruct->stock) {
                $data = array(
                    'quantity' => $OdaStockStruct->stock,
                );
                //Daniel Martin - Seteo del Stock correctamente en la 1.5
                $Product_Stock = new Product();
                $Product_Stock->setCorrectStock($id_combination, $OdaStockStruct->stock);
                self::updateRecord('`' . _DB_PREFIX_ . 'product_attribute`', 'id_product_attribute', $id_combination, $data);
            }
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_update_price">
    function oda_update_prices($key, $OdaPriceStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($OdaPriceStructArray as $OdaPriceStruct) {
            $results .= $this->_oda_update_price($OdaPriceStruct);
            $results .= "; ";
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_update_price($key, $OdaPriceStruct) {
        //raiseFault('OdaPriceStruct', print_r($OdaPriceStruct, true));
        $this->checkKey($key);
        $id_combination = $this->_oda_update_price($OdaPriceStruct);
        return new SOAP_Value('output', 'string', $id_combination);
    }

    function _oda_update_price($OdaPriceStruct) {
        //raiseFault(print_r($OdaPriceStruct, true), print_r($OdaPriceStruct, true));
        $this->checkRequired($OdaPriceStruct, 'productCode');
        $product = $this->getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'product`', $OdaPriceStruct->productCode);

        if (!is_null($OdaPriceStruct->taxCode) && trim($OdaPriceStruct->taxCode) != "") {
            $tax = $this->getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'tax`', $OdaPriceStruct->taxCode);
            //raiseFault('tax', print_r($tax, true));
            if (is_null($tax)) {
                raiseFault('taxCode not valid', 'Enter a valid taxCode o a /empty string/');
            }
        } else {
            $tax = null;
        }

        $id_product = empty($product) ? 0 : $product['id_product'];

        if ($id_product == 0) {
            raiseFault('ProductCode invalid', 'ProductCode is not exists.');
        } else {
            if ($product['price'] != $OdaPriceStruct->price || (!is_null($tax) && ($tax['id_tax'] != $product['id_tax_rules_group']))
            ) {
                $data = array(
                    'price' => $OdaPriceStruct->price,
                    'id_tax_rules_group' => 1
                );
                self::updateRecord('`' . _DB_PREFIX_ . 'product`', 'id_product', $id_product, $data);
                self::updateRecord('`' . _DB_PREFIX_ . 'product_shop`', 'id_product', $id_product, $data);
                
                try{
                    $Script = new ScriptSuppliers();
                    $Script->RemakeProductThings();
                }catch (Exception $e) {
                    file_put_contents('error_script_suppliers', $e->getMessage().PHP_EOL, FILE_APPEND);
                }
                $price = array(
                    'from' => ( $OdaPriceStruct->reductionFrom == "1900-01-01" ? "0000-00-00" : $OdaPriceStruct->reductionFrom ),
                    'to' => ( $OdaPriceStruct->reductionTo == "1900-01-01" ? "0000-00-00" : $OdaPriceStruct->reductionTo ),
                    'reduction_type' => 'amount',
                    'id_shop' => 0,
                    'from_quantity' => 1,
                    'id_product' => $id_product,
                    'price' => -1,
                    'id_currency' => 0,
                    'id_country' => 0,
                    'id_group' => 0,
                    'reduction' => $OdaPriceStruct->reductionPrice
                );

                //delete old discount
                Db::getInstance()->execute("DELETE FROM " . _DB_PREFIX_ . "specific_price WHERE id_product = " . $id_product);
                //add discount
                if ($price['reduction'] != 0)
                    self::insertRecord('`' . _DB_PREFIX_ . 'specific_price`', $price);
            }
            return $id_product;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_active_product">
    function oda_active_products($key, $activeValue, $codes) {
        $this->checkKey($key);
        $results = $this->_oda_active_products($activeValue, $codes);
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_active_product($key, $activeValue, $code) {
        $this->checkKey($key);
        $results = $this->_oda_active_products($activeValue, array($code));
        return new SOAP_Value('output', 'string', $results);
    }

    function _oda_active_products($activeValue, $codes) {
        try {
            $rows = Db::getInstance()->executeS('SELECT * 
                        FROM  `' . _DB_PREFIX_ . 'product` 
                        WHERE  `sb_code` IN (\'' . implode('\',\'', $codes) . '\')');
            foreach ($rows as $row) {
                if (isset($row['id_product'])) {
                    $active = $activeValue ? 1 : 0;
                    Db::getInstance()->execute('UPDATE  `' . _DB_PREFIX_ . 'product_shop` SET  `active` =  ' . $active . ' WHERE  `id_product` = ' . $row['id_product'] . ' AND `id_shop` =1');
                }
            }
        } catch (Exception $e) {
            file_put_contents('error_script_active', $e->getMessage());
        }

        self::updateRecords(
                '`' . _DB_PREFIX_ . 'product`', 'sb_code', $codes, array('active' => $activeValue ? 1 : 0));
    }

    // </editor-fold>
    /*     * ********************************* */

    // <editor-fold defaultstate="collapsed" desc="oda_createupdate_feature">
    function oda_createupdate_features($key, $OdaFeatureStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($OdaFeatureStructArray as $OdaFeatureStruct) {
            $results .= $this->_oda_createupdate_feature($OdaFeatureStruct);
            $results .= "; ";
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_createupdate_feature($key, $OdaFeatureStruct) {
        $this->checkKey($key);
        $id_feature = $this->_oda_createupdate_feature($OdaFeatureStruct);
        return new SOAP_Value('output', 'string', $id_feature);
    }

    function _oda_createupdate_feature($OdaFeatureStruct) {
        $this->checkRequired($OdaFeatureStruct, 'productCode');
        $this->checkRequired($OdaFeatureStruct, 'featureCode');
        $tableProducts = '`' . _DB_PREFIX_ . 'product`';
        $product = $this->getDataBySoapBackendCode($tableProducts, $OdaFeatureStruct->productCode);
        if (is_null($product)) {
            raiseFault('ProductCode invalid', 'ProductCode is not exists.');
        } else {
            $id_product = $product['id_product'];
            list($id_feature, $inserted_feature) = $this->UpdateOrCreateOdaFeature($OdaFeatureStruct->featureCode);
            $ids_lang = array_keys($this->GetLangsById(null, true));
            foreach ($ids_lang as $id_lang) {
                $this->UpdateFeatureTexts($id_lang, $id_feature, $OdaFeatureStruct->featureName);
            }
            if (is_null($OdaFeatureStruct->featureValueCode) || $OdaFeatureStruct->featureValueCode == '') {
                $table = '`' . _DB_PREFIX_ . 'feature_product`';
                $sql = "DELETE FROM {$table} WHERE id_feature = '$id_feature' AND id_product = '{$id_product}'";
                Db::getInstance()->execute($sql);
            } else {
                $customized = $OdaFeatureStruct->featureValueCode == '#';
                if ($customized)
                    $featureValueCode = $OdaFeatureStruct->featureCode . ":" . $OdaFeatureStruct->productCode;
                else
                    $featureValueCode = $OdaFeatureStruct->featureValueCode;

                list($id_feature_value, $inserted_feature_value) = $this->UpdateOrCreateOdaFeatureValue($featureValueCode, $id_feature, $customized);
                foreach ($ids_lang as $id_lang) {
                    $this->UpdateFeatureValueTexts($id_lang, $id_feature_value, $OdaFeatureStruct->featureValueText);
                }
                $this->AssignProductFeatureValue($id_product, $id_feature, $id_feature_value);
            }
            return $id_feature;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_createupdate_category">
    function oda_createupdate_categories($key, $OdaCategoryStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($OdaCategoryStructArray as $OdaCategoryStruct) {
            $results .= $this->_oda_createupdate_category($OdaCategoryStruct);
            $results .= "; ";
        }
		if(method_exists('Category','regenerateEntireNtree')){
			Category::regenerateEntireNtree();
		}
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_createupdate_category($key, $OdaCategoryStruct) {
        $this->checkKey($key);
        $id_category = $this->_oda_createupdate_category($OdaCategoryStruct);
        return new SOAP_Value('output', 'string', $id_category);
    }

    function _oda_createupdate_category($OdaCategoryStruct) {
        $this->checkRequired($OdaCategoryStruct, 'categoryCode');
        list($id_category, $inserted_category) = $this->UpdateOrCreateCategoryFull($OdaCategoryStruct->categoryCode, $OdaCategoryStruct->categoryName, $OdaCategoryStruct->parentCode);
        return $id_category;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="oda_createupdate_tax">
    function oda_createupdate_taxes($key, $OdaTaxStructArray) {
        $this->checkKey($key);
        $results = '';
        foreach ($OdaTaxStructArray as $OdaTaxStruct) {
            $results .= $this->_oda_createupdate_tax($OdaTaxStruct);
            $results .= "; ";
        }
        return new SOAP_Value('output', 'string', $results);
    }

    function oda_createupdate_tax($key, $OdaTaxStruct) {
        $this->checkKey($key);
        $id_tax = $this->_oda_createupdate_tax($OdaTaxStruct);
        return new SOAP_Value('output', 'string', $id_tax);
    }

    function _oda_createupdate_tax($OdaTaxStruct) {
        //$this->checkRequired($OdaCategoryStruct, 'taxCode');
        //$tableTaxes =  '`' . _DB_PREFIX_ . 'tax`';
        $ids_lang = array_keys($this->GetLangsById());

        list($id_tax, $inserted_tax) = $this->UpdateOrCreateOdaTax($OdaTaxStruct->taxCode, $OdaTaxStruct->taxRate);

        foreach ($ids_lang as $id_lang) {
            $this->UpdateTaxTexts($id_lang, $id_tax, $OdaTaxStruct->taxName);
        }

        if ($inserted_tax) {
            $this->AddTaxesZones($id_tax);
        }

        return $id_tax;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Funciones privadas">
    private function checkKey($key) {
        if ($this->module->wskey() != $key)
            raiseFault('KEY_INVALID', 'Key is not valid.');
    }

    private function checkRequired($input, $fieldName) {
        if (!isset($input->$fieldName) || trim($input->$fieldName) == '')
            raiseFault("Required field", "Field {$fieldName} is required.");
    }

    static private function checkNullDate(& $date) {
        if ($date < '1900-01-01')
            $date = null;
    }

    private static function columnExists($table, $column) {
        $db = Db::getInstance();
        $res = $db->executeS("SHOW COLUMNS FROM {$table}");
        $existecampo = false;
        foreach ($res as $field) {
            if ($field['Field'] == $column) {
                $existecampo = true;
                break;
            }
        }
        return $existecampo;
    }

    private static function getDataBySoapBackendCode($table, $sb_code) {
        $db = Db::getInstance();
        //raiseFault($table, $table);
        //echo "`{$table}`";
        //raiseFault(print_r($res, true), print_r($res, true));
        if (!self::columnExists($table, 'sb_code')) {
            $db->execute("ALTER TABLE {$table} ADD `sb_code` VARCHAR(50) NULL");
        }
        $sql = "
SELECT
    *
FROM
    {$table}
WHERE
    sb_code = '{$sb_code}'
LIMIT
    1
        ";
        $res = $db->executeS($sql);

        if (count($res) == 1)
            return $res[0];
        else
            return null;
    }

    private static function updateRecord($table, $idfieldname, $id, $data, $originalData = null) {
        $cambios = self::createStringKeyEqValue($data, $originalData);
        if ($cambios != '') {
            $sql = "
UPDATE
{$table}
SET {$cambios}
WHERE
{$idfieldname} = '{$id}'
            ";
            Db::getInstance()->execute($sql);
        }
    }

    private static function updateRecords($table, $idfieldname, $ids, $data) {
        $idsstr = '';
        foreach ($ids as $id) {
            if ($idsstr != '')
                $idsstr .= ', ';
            $idsstr .= "'{$id}'";
        }

        $cambios = self::createStringKeyEqValue($data, null);
        if ($cambios != '') {
            $sql = "
			UPDATE
				{$table}
			SET {$cambios}
			WHERE
				{$idfieldname} in ({$idsstr})
            ";
            Db::getInstance()->execute($sql);
        }
    }

    private static function insertRecord($table, $data) {
        $fieldList = '';
        $valueList = '';
        list($fieldList, $valueList) = self::createStringsKeysAndValues($data);
        $sql = "INSERT INTO {$table} ({$fieldList}) VALUES ({$valueList})";
        Db::getInstance()->execute($sql);
        return Db::getInstance()->Insert_ID();
    }

    private static function insertUpdateRecord($table, $data) {
        $fieldList = '';
        $valueList = '';
        list($fieldList, $valueList) = self::createStringsKeysAndValues($data);
        $cambios = self::createStringKeyEqValue($data);
        $sql = "
INSERT INTO {$table} ($fieldList
) VALUES ($valueList
) ON DUPLICATE KEY UPDATE $cambios
    ";
        Db::getInstance()->execute($sql);
    }

    private function InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata, $dataOnInsert = array()) {
        $inserted = false;
        $id = 0;
        $res = self::getDataBySoapBackendCode($table, $sb_code);
        if (is_null($res)) {
            $inserted = true;
            foreach ($dataOnInsert as $k => $v)
                $newdata[$k] = $v;

            $id = self::insertRecord($table, $newdata);
        } else {
            $id = $res[$idfieldname];
            if (!empty($newdata))
                self::updateRecord($table, $idfieldname, $id, $newdata, $res);
        }
        return array($id, $inserted);
    }

    /*
      private function GetBySoapBackendCode($table, $idfieldname, $sb_code, $newdata, $dataOnInsert = array()) {
      $inserted = false;
      $id = 0;
      $res = self::getDataBySoapBackendCode($table, $sb_code);
      if(is_null($res)) {
      $inserted = true;
      foreach($dataOnInsert as $k => $v)
      $newdata[$k] = $v;
      $id = self::insertRecord($table, $newdata);
      } else {
      $id = $res[$idfieldname];
      if (!empty($newdata))
      self::updateRecord($table, $idfieldname, $id, $newdata, $res);
      }
      return array($id, $inserted);
      }
     */

    private function UpdateOrCreateOdaProductCombination($id_product, $id_color_attr, $id_talle_attr, $stock, $priceDiff) {
        $tableCombinations = '`' . _DB_PREFIX_ . 'product_attribute`';
        $tableMembers = '`' . _DB_PREFIX_ . 'product_attribute_combination`';
        $idCombinationField = 'id_product_attribute';
        $idMemberField = 'id_attribute';
        $idProductField = 'id_product';
        $sql = "
select
	{$tableCombinations}.{$idCombinationField} as id_combination
from
	{$tableCombinations}
where
	{$tableCombinations}.{$idProductField} = '{$id_product}'
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND {$tableMembers}.{$idMemberField} = '{$id_color_attr}'
		) = 1
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND {$tableMembers}.{$idMemberField} = {$id_talle_attr}
		) = 1
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND NOT ({$tableMembers}.{$idMemberField} IN ({$id_talle_attr},{$id_color_attr}))
		) = 0
";
        $res = Db::getInstance()->executeS($sql);
        if (empty($res)) {
            $id_combination = 0;
        } else {
            $id_combination = $res[0]['id_combination'];
        }

        $data = array(
            'quantity' => $stock,
            'price' => $priceDiff
        );

        if ($id_combination > 0) {
            $inserted = false;
            self::updateRecord($tableCombinations, $idCombinationField, $id_combination, $data);
        } else {
            $inserted = true;
            $sql = "SELECT COUNT(*) as countProductCombinations FROM {$tableCombinations} WHERE {$idProductField} = '{$id_product}'";
            $countProductCombinations = Db::getInstance()->executeS($sql);
            $countProductCombinations = $countProductCombinations[0]['countProductCombinations'];
            $data['default_on'] = $countProductCombinations == 0 ? 1 : 0;
            $data[$idProductField] = $id_product;
            $id_combination = self::insertRecord($tableCombinations, $data);
            self::insertRecord($tableMembers, array($idMemberField => $id_color_attr, $idCombinationField => $id_combination));
            self::insertRecord($tableMembers, array($idMemberField => $id_talle_attr, $idCombinationField => $id_combination));
        }

        try {
            $Combination = new Combination($id_combination);
			$Combination->id_product = $id_product;
            $Combination->minimal_quantity = 1;
            $Combination->quantity = $stock;
            $Combination->price = $priceDiff;
            $Combination->update();
        } catch (Exception $e) {
            file_put_contents('error_error_log', $e->getMessage().PHP_EOL, FILE_APPEND);
        }
        StockAvailable::setQuantity($Combination->id_product, $id_combination, $stock);
        //Daniel Martin - Seteo del Stock correctamente en la 1.5
        $Product_Stock = new Product();
        $Product_Stock->setCorrectStock($id_combination, $stock);
        return array($id_combination, $inserted);
    }

    private function UpdateOrCreateOdaAttribute($id_group, $sb_code, $name, $color = '#000000') {
        $table = '`' . _DB_PREFIX_ . 'attribute`';
        $idfieldname = 'id_attribute';
        $res = self::getDataBySoapBackendCode($table, $sb_code);
		//Si ya existe, no machacar el color con el nuevo que venga O.o
        if (!is_null($res)) {
            $color = $res['color'];
        }
        $newdata = array(
            'sb_code' => $sb_code,
            'id_attribute_group' => $id_group,
            'color' => $color
        );
        list($id, $inserted) = $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
        $ids_lang = array_keys($this->GetLangsById());
        foreach ($ids_lang as $id_lang) {
            $this->UpdateAttributeTexts($id_lang, $id, $name);
        }
        return array($id, $inserted);
    }

    private function UpdateOrCreateOdaAttributeGroup($sb_code, $name, $publicName, $isColor) {
        $table = '`' . _DB_PREFIX_ . 'attribute_group`';
        $idfieldname = 'id_attribute_group';
        $newdata = array();
        $dataOnInsert = array(
            'sb_code' => $sb_code,
            'is_color_group' => $isColor ? '1' : '0');
        list($id, $inserted) = $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata, $dataOnInsert);
        if ($inserted) {
            $ids_lang = array_keys($this->GetLangsById());
            foreach ($ids_lang as $id_lang) {
                $this->UpdateAttributeGroupTexts($id_lang, $id, $name, $publicName);
            }
        }
        return array($id, $inserted);
    }

    private function UpdateOrCreateOdaManufacturer($sb_code, $name) {
        $table = '`' . _DB_PREFIX_ . 'manufacturer`';
        $idfieldname = 'id_manufacturer';
        $newdata = array(
            'sb_code' => addslashes($sb_code),
            'name' => addslashes($name)
        );
        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
    }

    private function UpdateOrCreateOdaFeatureValue($sb_code, $id_feature, $customized = false) {
        $table = '`' . _DB_PREFIX_ . 'feature_value`';
        $idfieldname = 'id_feature_value';
        $newdata = array(
            'sb_code' => addslashes($sb_code),
            'id_feature' => $id_feature,
            'custom' => $customized ? 1 : null
        );
        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
    }

    private function UpdateOrCreateOdaFeature($sb_code) {
        $table = '`' . _DB_PREFIX_ . 'feature`';
        $idfieldname = 'id_feature';
        $newdata = array(
            'sb_code' => addslashes($sb_code)
        );
        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
    }

    private function UpdateOrCreateOdaSupplier($sb_code, $name) {
        $table = '`' . _DB_PREFIX_ . 'supplier`';
        $idfieldname = 'id_supplier';
        $newdata = array(
            'sb_code' => addslashes($sb_code),
            'name' => addslashes($name)
        );
        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
    }

    private function UpdateOrCreateOdaCategory($sb_code, $parentId = null, $parentLevel = 0) {
        $table = '`' . _DB_PREFIX_ . 'category`';
        $idfieldname = 'id_category';
        $newdata = array(
            'sb_code' => addslashes($sb_code),
			'date_upd' => date('Y-m-d H:i:s')
        );
        $dataOnCreate = array(
            'active' => 1,
			'date_add' => date('Y-m-d H:i:s'),
                //, 'id_parent' => 1,
                //'level_depth' => 1
        );

        if (is_null($parentId)) {
            $dataOnCreate['id_parent'] = 1;
            $dataOnCreate['level_depth'] = 1;
        } else {
            $newdata['id_parent'] = $parentId;
            $dataOnCreate['level_depth'] = $parentLevel + 1;
        }

        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata, $dataOnCreate);
    }

    private function UpdateOrCreateOdaTax($sb_code, $taxRate) {
        $table = '`' . _DB_PREFIX_ . 'tax`';
        $idfieldname = 'id_tax';
        $newdata = array(
            'sb_code' => addslashes($sb_code),
            'rate' => $taxRate
        );
        return $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata);
    }

    private function GetLangsById($iso_code = null, $saltar = null) {
        $table = '`' . _DB_PREFIX_ . 'lang`';
        if ($saltar) {
            $filter = "1";
        } else {
            $filter = "active = '1'";
        }

        if (!is_null($iso_code))
            $filter = " AND iso_code = '{$iso_code}'";
        $sql = "SELECT * FROM {$table} WHERE {$filter}";
        $res = Db::getInstance()->executeS($sql);
        $arr = array();
        foreach ($res as $line) {
            $arr[$line['id_lang']] = $line;
        }
        return $arr;
    }

    private function GetGroupsById() {
        $table = '`' . _DB_PREFIX_ . 'group`';
        $sql = "SELECT * FROM {$table}";
        $res = Db::getInstance()->executeS($sql);
        $arr = array();
        foreach ($res as $line) {
            $arr[$line['id_group']] = $line;
        }
        return $arr;
    }

    private function AddCategoriesGroups($id_category) {
        $group_ids = array_keys($this->GetGroupsById());
        $table = '`' . _DB_PREFIX_ . 'category_group`';
        foreach ($group_ids as $id_group)
            self::insertRecord($table, array('id_category' => $id_category, 'id_group' => $id_group));
    }

    private function GetZonesById() {
        $table = '`' . _DB_PREFIX_ . 'zone`';
        $sql = "SELECT * FROM {$table}";
        $res = Db::getInstance()->executeS($sql);
        $arr = array();
        foreach ($res as $line) {
            $arr[$line['id_zone']] = $line;
        }
        return $arr;
    }

    private function AddTaxesZones($id_tax) {
        $zone_ids = array_keys($this->GetGroupsById());
        $table = '`' . _DB_PREFIX_ . 'tax_zone`';
        foreach ($zone_ids as $id_zone)
            self::insertRecord($table, array('id_tax' => $id_tax, 'id_zone' => $id_zone));
    }

    private function AssignProductCategory($id_product, $id_category) {
        $table = '`' . _DB_PREFIX_ . 'category_product`';
        $sql="DELETE FROM {$table} WHERE id_product = '$id_product' AND id_category = '$id_category'";
        Db::getInstance()->Execute($sql);
        self::insertUpdateRecord($table, array('id_product' => $id_product, 'id_category' => $id_category));
    }

    private function ClearProductCategories($id_product) {
        $table = '`' . _DB_PREFIX_ . 'category_product`';
        $sql = "DELETE FROM {$table} WHERE id_product = '$id_product'";
        Db::getInstance()->execute($sql);
    }

    private function AssignProductFeatureValue($id_product, $id_feature, $id_feature_value) {
        $table = '`' . _DB_PREFIX_ . 'feature_product`';
        $data = array(
            'id_product' => $id_product,
            'id_feature' => $id_feature,
            'id_feature_value' => $id_feature_value);
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateImage($id_product, $path, $id_combinacion = null) {
        //echo $path;
        //Tiene que estar en el sistema de archivos, en ps_images y en ps_image_lang
        $table = '`' . _DB_PREFIX_ . 'image`';
        if (!self::columnExists($table, 'soapbackend')) {
            $sql = "ALTER TABLE {$table} ADD `soapbackend` INT UNSIGNED DEFAULT '0' NULL";
            @Db::getInstance()->execute($sql);
        }

        $cover = 0;
        $pos = 1;
        $path = trim($path);
        $soapbackendfilter = is_null($id_combinacion) ? 1 : $id_combinacion;
        if ($path != '') {
            $sql = "SELECT COUNT(*) AS count FROM {$table} WHERE id_product = '$id_product'"; // AND soapbackend is not NULL AND soapbackend > 0";
            $res = Db::getInstance()->executeS($sql);
            if ($res[0]['count'] == 0 && is_null($id_combinacion)) {
                $cover = 1;
            } else {
                $sql = "SELECT * FROM {$table} WHERE id_product = '{$id_product}' AND soapbackend is not NULL AND soapbackend = '{$soapbackendfilter}'";
                $res = Db::getInstance()->executeS($sql);
                if (count($res) == 0) { //HAY IMAGENES, PERO NINGUNA ES DE ODACASH (o de la convinación que busco)
                    $sql = "SELECT (MAX(position) + 1) AS newposition FROM {$table} WHERE id_product = '$id_product' ";
                    $res = Db::getInstance()->executeS($sql);
                    $pos = $res[0]['newposition'];
                } else {
                    //aquí puedo borrar la imagen anterior.
                    //también se podrían borrar las traducciones
                    $cover = $res[0]['cover'];
                    $pos = $res[0]['position'];
                }
            }
        }

        $sql = "DELETE FROM {$table} WHERE id_product = '{$id_product}' AND soapbackend is not NULL AND soapbackend = {$soapbackendfilter}";
        Db::getInstance()->execute($sql);
        $imageid = 0;
        if ($path != '') {
            $data = array(
                'id_product' => $id_product,
                'cover' => $cover,
                'soapbackend' => $soapbackendfilter,
                'position' => $pos
            );
            $imageid = self::insertRecord($table, $data);
            $data2 = array(
                'id_image' => $imageid,
                'id_shop' => 1,
                'cover' => $cover
            );
            self::insertRecord('`' . _DB_PREFIX_ . 'image_shop`', $data2);
            $newfilename = realpath(dirname(__FILE__) . '/../../' . 'img/p/') . '/' . "{$id_product}-{$imageid}.jpg";
            self::copyImage($path, $newfilename);
            self::resizeImage($newfilename);
        }
        return $imageid;
    }

    private static function resizeImage($newfilename) {
        $version = explode('.', _PS_VERSION_);
        $sqlimagetype = "SELECT `id_image_type`, `name`, `width`, `height` FROM `" . _DB_PREFIX_ . "image_type` WHERE products = 1";
        $dat3 = Db::getInstance()->executeS($sqlimagetype);
        foreach ($dat3 as $info3) {
            if ((int) $version[1] < 1) {//es una version mayor a 1.1
                $sourceFile = array();
                $sourceFile['tmp_name'] = $newfilename;
            } else {
                $sourceFile = $newfilename;
            }
            $path = dirname($newfilename);
            $info = pathinfo($newfilename);
            $file_name = basename($newfilename, '.' . $info['extension']);
            $fnamearr = explode('-', $file_name);

            $filenameresized = "{$path}/{$fnamearr[0]}-{$fnamearr[1]}-{$info3['name']}.jpg";
            imageResize($sourceFile, $filenameresized, $info3['width'], $info3['height'], "jpg");
        }
    }

    private static function copyImage($url_path, $newfilename) {
        $path = realpath(dirname(__FILE__)) . '/images/' . str_replace("\\", '/', $url_path);
        //$path = realpath(dirname(__FILE__) . '/images/' . $url_path);
        //echo "*{$path}*{$newfilename}*";
        if (file_exists($path)) {
            copy($path, $newfilename);
        }
    }

    private function UpdateOrCreateOdaProduct($sb_code, $id_supplier, $id_manufacturer, $ean13, $price, $reduction_from, $reduction_to, $reduction_price, $quantity, $idDefaultCat, $refprov = null) {

        if (is_null($refprov) || $refprov == '') {
            $refprov = $sb_code;
        }

        $table = '`' . _DB_PREFIX_ . 'product`';
        $idfieldname = 'id_product';



        $newdata = array(
            'sb_code' => addslashes($sb_code),
            'reference' => addslashes($refprov),
            'supplier_reference' => addslashes($refprov),
            'id_supplier' => $id_supplier,
            'id_manufacturer' => $id_manufacturer,
            'ean13' => addslashes($ean13),
            'quantity' => $quantity,
            'price' => $price,
            'date_upd' => date("Y-m-d H:i:s"),
            'id_category_default' => $idDefaultCat
        );


        //Obtengo el impuesto por defecto por si estoy creaqndo el artículo
        $tableTaxes = '`' . _DB_PREFIX_ . 'tax`';
        $idTaxField = 'id_tax';
        $sql = "SELECT {$idTaxField} AS id_tax FROM {$tableTaxes} ORDER BY {$idTaxField} LIMIT 0,1";
        $res = Db::getInstance()->executeS($sql);
        if (empty($res)) {
            $idTax = 0;
        } else {
            $idTax = $res[0]['id_tax'];
        }
        //'id_color_default' => 5;
        $dataOnInsert = array(
            'active' => 0,
            'id_category_default' => $idDefaultCat,
            'id_tax_rules_group' => $idTax,
            'date_add' => date("Y-m-d H:i:s")
        );
        $newdata2 = array(
            'sb_code' => addslashes($sb_code),
            'available_for_order' => 1,
            'price' => $price,
            'date_upd' => date("Y-m-d H:i:s"),
            'id_category_default' => $idDefaultCat
        );
        list($id_product, $inserted_product) = $this->InsertUpdateBySoapBackendCode($table, $idfieldname, $sb_code, $newdata, $dataOnInsert);
        
        return array($id_product, $inserted_product);
    }

    private function UpdateFeatureValueTexts($id_lang, $id_feature_value, $featureValueText) {
        $table = '`' . _DB_PREFIX_ . 'feature_value_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_feature_value' => $id_feature_value,
            'value' => addslashes($featureValueText)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateFeatureTexts($id_lang, $id_feature, $featureName) {
        $table = '`' . _DB_PREFIX_ . 'feature_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_feature' => $id_feature,
            'name' => addslashes($featureName)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateCategoryTexts($id_lang, $id_category, $categoryName, $linkcat) {
        $table = '`' . _DB_PREFIX_ . 'category_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_category' => $id_category,
            'name' => addslashes($categoryName),
            'link_rewrite' => addslashes($linkcat)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateTaxTexts($id_lang, $id_tax, $taxName) {
        $table = '`' . _DB_PREFIX_ . 'tax_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_tax' => $id_tax,
            'name' => addslashes($taxName)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateAttributeTexts($id_lang, $id, $name) {
        $table = '`' . _DB_PREFIX_ . 'attribute_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_attribute' => $id,
            'name' => addslashes($name)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateAttributeGroupTexts($id_lang, $id_attributeGroup, $name, $publicName) {
        $table = '`' . _DB_PREFIX_ . 'attribute_group_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_attribute_group' => $id_attributeGroup,
            'name' => addslashes($name),
            'public_name' => addslashes($publicName)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateProductTexts($id_lang, $id_product, $description, $description_short, $link_rewrite, $name) {
        $table = '`' . _DB_PREFIX_ . 'product_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_product' => $id_product,
            'description' => addslashes($description),
            'description_short' => addslashes($description_short),
            'link_rewrite' => addslashes($link_rewrite),
            'name' => addslashes($name)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function UpdateImageTexts($id_lang, $id_image, $legend) {
        $table = '`' . _DB_PREFIX_ . 'image_lang`';
        $data = array(
            'id_lang' => $id_lang,
            'id_image' => $id_image,
            'legend' => addslashes($legend)
        );
        self::insertUpdateRecord($table, $data);
    }

    private function GetProductCombination($code_product, $code_color, $code_size) {
        $res = self::getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'product`', $code_product);
        $id_product = empty($res) ? 0 : $res['id_product'];
        $res = self::getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'attribute_group`', 'COLOR');
        $id_color_group = empty($res) ? 0 : $res['id_attribute_group'];
        $res = self::getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'attribute_group`', 'TALLE');
        $id_talle_group = empty($res) ? 0 : $res['id_attribute_group'];
        $res = self::getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'attribute`', $code_color);
        $id_color_attr = empty($res) ? 0 : $res['id_attribute'];
        $res = self::getDataBySoapBackendCode('`' . _DB_PREFIX_ . 'attribute`', $code_size);
        $id_talle_attr = empty($res) ? 0 : $res['id_attribute'];
        if ($id_product == 0) {
            raiseFault('ProductCode invalid', 'Product not exist.');
        } else if ($id_color_group == 0) {
            raiseFault('ColorCode invalid', 'COLOR not exist.');
        } else if ($id_talle_group == 0) {
            raiseFault('SizeCode invalid', 'SIZE not exist.');
        } else if ($id_color_attr == 0) {
            raiseFault('ColorCode invalid', 'ColorCode not exist.');
        } else if ($id_talle_attr == 0) {
            raiseFault('SizeCode invalid', 'SizeCode not exist.');
        } else {
            return $this->getProductCombinationByIds($id_product, $id_color_group, $id_talle_group, $id_color_attr, $id_talle_attr);
        }
    }

    private function GetProductCombinationByIds($id_product, $id_color_group, $id_talle_group, $id_color_attr, $id_talle_attr) {
        $tableCombinations = '`' . _DB_PREFIX_ . 'product_attribute`';
        $tableMembers = '`' . _DB_PREFIX_ . 'product_attribute_combination`';
        $idCombinationField = 'id_product_attribute';
        $idMemberField = 'id_attribute';
        $idProductField = 'id_product';
        //{$tableCombinations}.{$idCombinationField} as id_combination
        $sql = "
select
	*
from
	{$tableCombinations}
where
	{$tableCombinations}.{$idProductField} = '{$id_product}'
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND {$tableMembers}.{$idMemberField} = '{$id_color_attr}'
		) = 1
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND {$tableMembers}.{$idMemberField} = {$id_talle_attr}
		) = 1
	and (
		select count(*)
		from {$tableMembers}
		where
			{$tableMembers}.{$idCombinationField} = {$tableCombinations}.{$idCombinationField}
			AND NOT ({$tableMembers}.{$idMemberField} IN ({$id_talle_attr},{$id_color_attr}))
		) = 0
";
        $combination = Db::getInstance()->executeS($sql);
        $combination = empty($combination) ? $combination : $combination[0];
        return $combination;
    }

    private function UpdateOrCreateCategoryFull($categoryCode, $categoryName, $parentCode = null) {
        if ($categoryCode == "/")
            return array(1, false);
        $tableCategories =  '`' . _DB_PREFIX_ . 'category`';
        $ids_lang = array_keys($this->GetLangsById());

        if (is_null($parentCode) || $parentCode == '') {
            $parent = null;
            $parentId = 1;
            $parentLevel = 0;
        } else {
            $parent = $this->getDataBySoapBackendCode($tableCategories, $parentCode);
            if (is_null($parent)) {
                raiseFault("ParentCode not valid", "ParentCode not valid, use /empty string/ to root.");
            } else {
                $parentId = $parent['id_category'];
                $parentLevel = $parent['level_depth'];
            }
        }

        list($id_category, $inserted_category) = $this->UpdateOrCreateOdaCategory($categoryCode, $parentId, $parentLevel);
        $linkcat = self::create_slug($categoryName);
        foreach ($ids_lang as $id_lang) {
            $this->UpdateCategoryTexts($id_lang, $id_category, $categoryName, $linkcat);
        }
        if ($inserted_category) {
            $this->AddCategoriesGroups($id_category);
        }
        Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'category_shop  (
                    `id_category` ,
                    `id_shop` ,
                    `position`
                    )
                    VALUES (
                    '.$id_category.',  1,  0
                    ) 
                    ON DUPLICATE KEY UPDATE id_category ='.$id_category);
        return array($id_category, $inserted_category);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Armar listas de strings para los updates e inserts">
    /**
     * Arma un string para las consultas de update
     * @param <type> $arrayDatos
     * @param <type> $arrayOriginales (Opcional) si está definido, verifica que los valores sean diferentes
     */
    private static function createStringKeyEqValue($arrayDatos, $arrayOriginales = null) {
        $cambios = '';
        foreach ($arrayDatos as $key => $value) {
            if (is_null($arrayOriginales) || $arrayOriginales[$key] != $value) {
                if ($cambios != '')
                    $cambios .= ',';
                $cambios .= "
    {$key} = '{$value}'";
            }
        }
        return $cambios;
    }

    /**
     * Arma dos string para las consultas de insert, uno con la lista de campos entre ` y otro con la lista de valores entre comillas
     * @param <type> $arrayDatos
     * @return <type>
     */
    private static function createStringsKeysAndValues($arrayDatos) {
        $fieldList = '';
        $valueList = '';
        foreach ($arrayDatos as $key => $value) {
            if ($fieldList != '')
                $fieldList .= ',';
            $fieldList .= "`{$key}`";
            if ($valueList != '')
                $valueList .= ',';
            $valueList .= "'{$value}'";
        }
        return array($fieldList, $valueList);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="Generación de slugs">
    private static function caracteres_latinos($cadena) {
        //acentos
        $cadena = @ereg_replace("(À|Á|Â|Ã|Ä|Å|à|á|â|ã|ä|å)", "a", $cadena);
        $cadena = @ereg_replace("(È|É|Ê|Ë|è|é|ê|ë)", "e", $cadena);
        $cadena = @ereg_replace("(Ì|Í|Î|Ï|ì|í|î|ï)", "i", $cadena);
        $cadena = @ereg_replace("(Ò|Ó|Ô|Õ|Ö|Ø|ò|ó|ô|õ|ö|ø)", "o", $cadena);
        $cadena = @ereg_replace("(Ù|Ú|Û|Ü|ù|ú|û|ü)", "u", $cadena);
        //la ñ
        $cadena = @ereg_replace("(Ñ|ñ)", "n", $cadena);
        //caracteres extraños
        $cadena = @ereg_replace("(Ç|ç)", "c", $cadena);
        $cadena = @ereg_replace("ÿ", "y", $cadena);
        return $cadena;
    }

    private static function create_slug($cadena, $separador = '-') {
        $cadena = trim($cadena);
        $cadena = self::caracteres_latinos($cadena);
        $cadena = strtolower($cadena);
        $cadena = @ereg_replace("[ \t\n\r]+", " ", $cadena);
        $cadena = @ereg_replace("[^ A-Za-z0-9_]", "", $cadena);
        $cadena = trim($cadena);
        $cadena = str_replace(" ", $separador, $cadena);
        return $cadena;
    }

    // </editor-fold>
}
