<?php
class OdaProductStruct {
    var $productCode;
//    var $color;
//    var $size;
    var $descriptionShort;
    var $description;
    var $manufacturerCode;
    var $manufacturerName;
    var $supplierCode;
    var $supplierName;
    var $ean;
    var $categoryCode;
    var $categoryName;
    //var $webStartDate;
    //var $webFinishDate;
    var $price;
    var $reductionFrom;
    var $reductionTo;
    var $reductionPrice;
    
    var $stock;
    /*
    var $material;
    var $suela;
    var $horma;
    var $tacon;
    var $comments;
     */
    var $photo;
    var $productName;
    var $refprov;

    function OdaProductStruct(
        $productCode = null,
        /*$color = null, $size = null, */$descriptionShort = null,
        $description = null, $manufacturerCode = null, $manufacturerName = null, 
        $supplierCode = null, $supplierName = null, $ean = null, $categoryCode = null,
        $categoryName = null, /*$webStartDate = null, $webFinishDate = null,*/
        $price = null, $reductionFrom = null, $reductionTo = null, $reductionPrice = null,
        $stock = null,
        /*
        $material = null, $suela = null, $horma = null, $tacon = null,
        $comments = null, 
        */
        $photo = null, $productName = null, $refprov = null)
    {
        $this->productCode = $productCode;
//        $this->color = $color;
//        $this->size = $size;
        $this->descriptionShort = $descriptionShort;
        $this->description = $description;
        $this->manufacturerCode = $manufacturerCode;
        $this->manufacturerName = $manufacturerName;
        $this->supplierCode = $supplierCode;
        $this->supplierName = $supplierName;
        $this->ean = $ean;
        $this->categoryCode = $categoryCode;
        $this->categoryName = $categoryName;
        //$this->webStartDate = $webStartDate;
        //$this->webFinishDate = $webFinishDate;
        $this->price = $price;
        $this->reductionFrom = $reductionFrom;
        $this->reductionTo = $reductionTo;
        $this->reductionPrice = $reductionPrice;
        $this->stock = $stock;
        /*
        $this->material = $material;
        $this->suela = $suela;
        $this->horma = $horma;
        $this->tacon = $tacon;
        $this->comments = $comments;
         */
        $this->photo = $photo;
        $this->productName = $productName;
        $this->refprov = $refprov;
    }

    function &__to_soap($name = 'inputStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('productCode', 'string', $this->productCode),
            //new SOAP_Value('color', 'string', $this->color),
            //new SOAP_Value('size', 'string', $this->size),
            new SOAP_Value('descriptionShort', 'string', $this->descriptionShort),
            new SOAP_Value('description', 'string', $this->description),
            new SOAP_Value('manufacturerCode', 'string', $this->manufacturerCode),
            new SOAP_Value('manufacturerName', 'string', $this->manufacturerName),
            new SOAP_Value('manufacturerCode', 'string', $this->supplierCode),
            new SOAP_Value('manufacturerName', 'string', $this->supplierName),
            new SOAP_Value('ean', 'string', $this->ean),
            new SOAP_Value('categoryCode', 'string', $this->categoryCode),
            new SOAP_Value('categoryName', 'string', $this->categoryName),
            //new SOAP_Value('webStartDate', 'date', $this->webStartDate),
            //new SOAP_Value('webFinishDate', 'date', $this->webFinishDate),
            new SOAP_Value('price', 'decimal', $this->price),
            new SOAP_Value('reductionFrom', 'date', $this->reductionFrom),
            new SOAP_Value('reductionTo', 'date', $this->reductionTo),
            new SOAP_Value('reductionPrice', 'decimal', $this->reductionPrice),
            new SOAP_Value('stock', 'decimal', $this->stock),
            /*
            new SOAP_Value('material', 'string', $this->material),
            new SOAP_Value('suela', 'string', $this->suela),
            new SOAP_Value('horma', 'string', $this->horma),
            new SOAP_Value('tacon', 'string', $this->tacon),
            new SOAP_Value('comments', 'string', $this->comments),
             */
            new SOAP_Value('photo', 'string', $this->photo),
            new SOAP_Value('productName', 'string', $this->productName),
            new SOAP_Value('refprov', 'string', $this->refprov)
                    );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaProductStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaProductStruct',
                                    $inner);
        }

        return $value;
    }
}

