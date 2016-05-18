<?php

/**
 * Script Manufactures to Suppliers Class
 *
 * Métodos para reagisnar un producto a las distintas multitiendas y al proveedor correspondiente 
 * Trabajo específico para el proyecto Paula Alonso
 *
 * @package	OdaCash
 * @subpackage	Paula Alonso
 * @category	Script
 * @author		Daniel Martin Ambrosio Domenech
 * @link		http://www.OdaCash.com
 */
require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/../../init.php');
ini_set('error_reporting', E_ALL);

class ScriptSuppliers
{

    public function ScriptSuppliers()
    {
        
    }

    public function RestockNonGroups()
    {
        try {
            Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'stock_available` SET `id_shop_group` = 1');
        } catch (Exception $e) {
            Logger::addLog('Fallo en RestockNonGroups CODE 01 ' . $e->getMessage(), 4);
        }
    }

    public function RelocateAllNoneShopProducts()
    {
        $shops = Shop::getShops();

        try {
            foreach ($shops as $shop_id => $shop) {
                $rows = Db::getInstance()->executeS('SELECT * FROM  `' . _DB_PREFIX_ . 'product` WHERE id_product NOT IN 
                    (SELECT id_product FROM ' . _DB_PREFIX_ . 'product_shop WHERE id_shop = ' . (int) $shop['id_shop'] . ')');

                foreach ($rows as $row) {
                    Db::getInstance()->execute('
                                INSERT INTO `' . _DB_PREFIX_ . 'product_shop` (`id_product`, `id_shop`, `id_category_default`,id_tax_rules_group,
                                on_sale,online_only,ecotax,minimal_quantity,price,wholesale_price,unity,unit_price_ratio,additional_shipping_cost,
                                customizable,uploadable_files,text_fields,active,redirect_type,id_product_redirected,available_for_order,available_date,`condition`,
                                show_price,indexed,visibility,cache_default_attribute,advanced_stock_management,date_add,date_upd)
                                VALUES (' . (int) $row['id_product'] . ', ' . (int) $shop['id_shop'] . ', ' . (int) $row['id_category_default'] . ',' . $row['id_tax_rules_group'] . ',
                                    0,0,0,1,"' . $row['price'] . '",0,0,0,0,
                                    0,0,0,0,404,0,1,0,"new",
                                    1,1,"both",0,0,"' . date("Y-m-d H:i:s") . '","' . date("Y-m-d H:i:s") . '")
                                ON DUPLICATE KEY UPDATE `id_product` = ' . (int) $row['id_product']
                    );
                    try {
                        $Product = new Product($row['id_product']);
                        $Product->active = 1;
                        $Product->update();
                    } catch (Exception $e) {
                        Logger::addLog('Fallo en RestockNonGroups CODE 02 ' . $e->getMessage(), 4);
                    }
                }
            }
        } catch (Exception $e) {
            Logger::addLog('Fallo en RestockNonGroups CODE 03 ' . $e->getMessage(), 4);
        }
    }

    public function RegenerateMultishopLanguageProducts()
    {
        try {
            $rowsEdit = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'product_lang` WHERE id_lang = 3 AND id_shop <> 1 AND name = ""');

            foreach ($rowsEdit as $row) {
                $originalLang = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'product_lang WHERE id_lang = 3 AND id_shop = 1 AND name <> "" AND id_product = ' . $row['id_product']);
                if (isset($originalLang['id_product'])) {
                    Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'product_lang SET link_rewrite = "' . $originalLang['link_rewrite'] . '", name = "' . $originalLang['name'] . '" WHERE id_product = ' . $row['id_product'] . ' AND name = ""');
                }
            }

            $rows = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'product_lang` WHERE id_product NOT IN (SELECT id_product FROM `' . _DB_PREFIX_ . 'product_lang` WHERE id_shop=2) GROUP BY id_product');
            $langs = Language::getLanguages();
            $shops = Shop::getShops();
            foreach ($rows as $row) {
                foreach ($langs as $lang) {
                    foreach ($shops as $shop) {
                        if ($shop['id_shop'] != "1") {
                            Db::getInstance()->execute('INSERT INTO `' . _DB_PREFIX_ . 'product_lang` (id_product,id_shop,id_lang,description,description_short,link_rewrite,meta_description
                        ,meta_keywords,meta_title,name,available_now,available_later) 
                        VALUES ("' . $row['id_product'] . '","' . $shop['id_shop'] . '","' . $lang['id_lang'] . '","' . $row['description'] . '","' . $row['description_short'] . '","' . $row['link_rewrite'] . '","' . $row['meta_description'] . '"
                            ,"' . $row['meta_keywords'] . '","' . $row['meta_title'] . '","' . $row['name'] . '","' . $row['available_now'] . '","' . $row['available_later'] . '")');
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Logger::addLog('Fallo en RestockNonGroups CODE 04 ' . $e->getMessage(), 4);
        }
    }

    public function RegenerateCombinations()
    {
        $shops = Shop::getShops();
        foreach ($shops as $shop) {
            if ($shop['id_shop'] != "1") {
                $rows = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'product_attribute` WHERE id_product_attribute 
                    NOT IN (SELECT id_product_attribute FROM ' . _DB_PREFIX_ . 'product_attribute_shop where id_shop = ' . $shop['id_shop'] . ') 
                        ');
                foreach ($rows as $row) {
                    $original = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'product_attribute_shop WHERE id_product_attribute 
                        = ' . $row['id_product_attribute'] . ' AND id_shop = 1');
                    Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'product_attribute_shop 
                        VALUES(' . $original['id_product_attribute'] . ',' . $shop['id_shop'] . ',' . $original['wholesale_price'] . ',' . $original['price'] . ',' . $original['ecotax'] . ',' . $original['weight'] . ',
                            ' . $original['unit_price_impact'] . ',' . $original['default_on'] . ',' . $original['minimal_quantity'] . ',"' . $original['available_date'] . '")');
                }
            }
        }
    }

    public function RemakeProductThings()
    {
        //$this->moveToSuppliers();
        $this->RelocateAllNoneShopProducts();
        $this->ResetDefaultCombinations();
        $this->RestockNonGroups();
        $this->RegenerateMultishopLanguageProducts();
        $this->RegenerateCombinations();
        $this->ResetInitialCategory();
    }

    public function ResetDefaultCombinations()
    {
        $shops = Shop::getShops();
        if(count($shops)<=1){
            $rows = Db::getInstance()->executeS('SELECT id_product, pa.id_product_attribute FROM  `' . _DB_PREFIX_ . 'product_attribute` pa '
                    . ' GROUP BY id_product HAVING (SUM( pa.default_on ) = 0 OR SUM( pa.default_on ) IS NULL)');
        }else{
            $rows = Db::getInstance()->executeS('SELECT id_product, pa.id_product_attribute FROM  `' . _DB_PREFIX_ . 'product_attribute` pa INNER JOIN `' . _DB_PREFIX_ . 'product_attribute_shop` pas ON pas.id_shop = 1 '
                    . 'AND pas.id_product_attribute = pa.id_product_attribute  GROUP BY id_product HAVING SUM( pas.default_on ) = 0');
        }
        if ($rows)
            foreach ($rows as $row) {
                Db::getInstance()->execute('UPDATE `ps_product_attribute` SET default_on = 1 WHERE id_product_attribute = ' . $row['id_product_attribute']);
                $combination = new Combination($row['id_product_attribute']);
                $combination->default_on = 1;
                $combination->update();
            }

        $rows = Db::getInstance()->executeS('SELECT id_attribute_group FROM `' . _DB_PREFIX_ . 'attribute_group`'
                . ' WHERE id_attribute_group NOT IN (SELECT DISTINCT id_attribute_group FROM `' . _DB_PREFIX_ . 'attribute_group_shop`)');

        if ($rows)
            foreach ($rows as $row) {
                $ag = new AttributeGroup($row['id_attribute_group']);
                $ag->update();
            }

        $rows = Db::getInstance()->executeS('SELECT id_attribute FROM `' . _DB_PREFIX_ . 'attribute` '
                . 'WHERE id_attribute NOT IN (SELECT DISTINCT id_attribute FROM `' . _DB_PREFIX_ . 'attribute_shop`)');

        if ($rows)
            foreach ($rows as $row) {
                $ag = new Attribute($row['id_attribute']);
                $ag->update();
            }
    }

    public function ResetInitialCategory()
    {
        Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'category SET id_parent = ' . pSQL(Configuration::get('SOAPBACKEND_INITIAL_CATEGORY')) . ' '
                . ' WHERE id_parent = ' . pSQL(Configuration::get('SOAPBACKEND_ROOT_CATEGORY')) . ' AND is_root_category = 0');
    }

}

$Script = new ScriptSuppliers();
$Script->RemakeProductThings();