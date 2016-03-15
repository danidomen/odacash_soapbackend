<?php

class Product extends ProductCore
{

    /**
     * Obtiene si existe ese producto por su referencia de proveedor en el sistema
     * 
     * @author       Daniel Martín
     * @access	public
     * @param        int $supplier_reference La referencia de proveedor
     * @return	int Retorna el id del producto en cuestión. FALSE si no lo encuentra
     */
    public static function existsSupplierRefInDatabase($supplier_reference)
    {
        $row = Db::getInstance()->getRow('
            SELECT `id_product`
            FROM `' . _DB_PREFIX_ . 'product` p
            WHERE p.supplier_reference = "' . pSQL($supplier_reference) . '"');
        if (!isset($row['id_product'])) {
            return FALSE;
        } else {
            return $row['id_product'];
        }
    }

    /**
     * Webservice setter : set category ids of current product for association
     *
     * @author       Daniel Martín
     * @access	public
     * @param        array $category_ids category ids
     * @param        boolean $borrar_anteriores Si deseas borrar las categorias que tenia el producto
     */
    public function setWsCategoriesExtend($category_ids, $borrar_anteriores = false)
    {
        $ids = array();
        foreach ($category_ids as $value)
            $ids[] = $value['id'];
        if ($borrar_anteriores) {
            $this->deleteCategories();
        }
        if (true) {
            if ($ids) {
                $sql_values = '';
                $ids = array_map('intval', $ids);
                foreach ($ids as $position => $id)
                    $sql_values[] = '(' . (int) $id . ', ' . (int) $this->id . ', ' . (int) $position . ')';
                $result = Db::getInstance()->execute('
                                    REPLACE INTO `' . _DB_PREFIX_ . 'category_product` (`id_category`, `id_product`, `position`)
                                    VALUES ' . implode(',', $sql_values)
                );
                return $result;
            }
        }
        return true;
    }

    /**
     * Asigna bien el stock en prestashop en la tabla correspondiente para la combinacion dada
     *
     * @author       Daniel Martín
     * @access	public
     * @param        int $id_product_attribute
     * @param        int $stock
     */
    public function setCorrectStock($id_product_attribute, $stock)
    {
        Db::getInstance()->execute('
        UPDATE `' . _DB_PREFIX_ . 'stock_available` SET quantity = "' . $stock . '" WHERE `id_product_attribute` = "' . $id_product_attribute . '"');
    }

}
