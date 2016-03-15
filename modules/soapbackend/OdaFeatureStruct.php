<?php
class OdaFeatureStruct {
    var $productCode;
    var $featureCode;
    var $featureName;
    var $featureValueCode;
    var $featureValueText;
    //var $featureValueCustomized;

    function OdaFeatureStruct($productCode = null, $featureCode = null, $featureName = null,
        $featureValueCode = null, $featureValueText = null/*, $featureValueCustomized*/)
    {
        $this->productCode = $productCode;
        $this->featureCode = $featureCode;
        $this->featureName = $featureName;
        $this->featureValueCode = $featureValueCode;
        $this->featureValueText = $featureValueText;
        //$this->featureValueCustomized = $featureValueCustomized;
    }

    function &__to_soap($name = 'OdaFeatureStruct', $header = false,
                        $mustUnderstand = 0,
                        $actor = 'http://schemas.xmlsoap.org/soap/actor/next')
    {
        $inner = array(
            new SOAP_Value('productCode', 'string', $this->productCode),
            new SOAP_Value('featureCode', 'string', $this->featureCode),
            new SOAP_Value('featureName', 'string', $this->featureName),
            new SOAP_Value('featureValueCode', 'string', $this->featureValueCode),
            new SOAP_Value('featureValueText', 'string', $this->featureValueText)
            //,new SOAP_Value('featureValueCustomized', 'string', $this->featureValueCustomized)
        );

        if ($header) {
            $value = new SOAP_Header($name,
                                     '{http://soapinterop.org/xsd}OdaFeatureStruct',
                                     $inner,
                                     $mustUnderstand,
                                     $actor);
        } else {
            $value = new SOAP_Value($name,
                                    '{http://soapinterop.org/xsd}OdaFeatureStruct',
                                    $inner);
        }

        return $value;
    }
}

