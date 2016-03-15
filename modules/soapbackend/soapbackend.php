<?php
class SoapBackend extends Module {
    // <editor-fold defaultstate="collapsed" desc="modulepath() / modulename() / moduleurl() / wsurl() / wskey() / enabled() / installed() ">
    static private $_modulepath = null;
    public function modulepath() {
        if (is_null(self::$_modulepath))
            self::$_modulepath = dirname(__FILE__);
        return self::$_modulepath;
    }
    static private $_modulename = null;
    public function modulename() {
        if (is_null(self::$_modulename))
            self::$_modulename = basename($this->modulepath());
        return self::$_modulename;
    }
    static private $_moduleurl = null;
    public function moduleurl() {
        if (is_null(self::$_moduleurl)) {
            $protocol = $_SERVER['SERVER_PROTOCOL'];                                // 'HTTP/1.1'
            $protocol = explode('/', $protocol);
            $protocol = strtolower($protocol[0]);                                   // 'HTTP'
            $server = $_SERVER['SERVER_NAME'];                                      // 'LOCALHOST'
            $relurl = $_SERVER['PHP_SELF']; // $_SERVER['SCRIPT_NAME'];             // '/prestashop_1.2.5/administrador/index.php'
            $relurlPartes = explode('/', $relurl);
            $countPartes = count($relurlPartes);
            $relurl = '';
            for ($i = 0; $i < ($countPartes - 2); $i++)
                $relurl .= $relurlPartes[$i].'/';                                   // 'prestashop_1.2.5/'
            self::$_moduleurl = "{$protocol}://{$server}{$relurl}modules/" . self::modulename();   // 'http://localhost/prestashop_1.2.5/modules/soapbackend'
        }
        return self::$_moduleurl;
    }
    static private $_wsurl = null;
    public function wsurl() {
        if (is_null(self::$_wsurl))
            //self::$_wsurl = self::moduleurl() . '/ws.php' . '?key=' . $this->wskey();
            self::$_wsurl = self::moduleurl() . '/ws.php';
        return self::$_wsurl;
    }
    static private $_wskey = null;
    public function wskey($reset = null) {
        if (!is_null($reset)) {
            self::$_wskey = self::generateKey();
            Configuration::updateValue('SOAPBACKEND_KEY', self::$_wskey);;
        }
        if (is_null(self::$_wskey))
            self::$_wskey = Configuration::get('SOAPBACKEND_KEY','');
        return self::$_wskey;
    }
    public function installed() {
        return self::wskey() != '';
    }
    public function enabled($value = null) {
        return $this->active;
    }
// </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="static functions">
    static function str_makerand($minlength, $maxlength, $uselower, $useupper, $usespecial, $usenumbers)
    {
        $charset = "";
        if ($uselower) $charset .= "abcdefghijklmnopqrstuvwxyz";
        if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($usenumbers) $charset .= "0123456789";
        if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
        if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
        else $length = mt_rand ($minlength, $maxlength);
        for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
        return $key;
    }
    static function generateKey() {
        return self::str_makerand(32, 32, false, true, false, true);
    }
// </editor-fold>

    function __construct() {
        $this->name = 'soapbackend';
        $this->tab = 'Tools';
        $this->version = '1.0';
        parent::__construct();
        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('OdaCash SOAP Backend Service');
        $this->description = $this->l('Webservice to access backend functions');
        $this->confirmUninstall = $this->l('Are you sure you want to delete your key?');
        
        $SOAPBACKEND_INITIAL_CATEGORY = Configuration::get('SOAPBACKEND_ROOT_CATEGORY');
        if(empty($SOAPBACKEND_INITIAL_CATEGORY) || $SOAPBACKEND_INITIAL_CATEGORY = ''){
            Configuration::updateValue('SOAPBACKEND_ROOT_CATEGORY', 1);
            Configuration::updateValue('SOAPBACKEND_INITIAL_CATEGORY', 2);
        }
        
    }

    function install() {
        if (!parent::install())
            return false;
        self::wskey(true);
        self::enabled(true);
        return true;
    }

    function uninstall() {
        if (!parent::uninstall())
            return false;        
        Configuration::deleteByName('SOAPBACKEND_KEY', '');
        Configuration::deleteByName('SOAPBACKEND_ENABLED', '');
        Configuration::deleteByName('SOAPBACKEND_ROOT_CATEGORY');
        Configuration::deleteByName('SOAPBACKEND_INITIAL_CATEGORY');
        return true;
    }

    public function getContent() {
        if (self::installed()) {
            /*global $smarty;
            $smarty->assign('module',$this);
            $smarty->display($this->modulepath().'/default.tpl');*/
            $this->_html = '<h2>'.$this->displayName.'</h2>';

            if (Tools::isSubmit('btnSubmit'))
            {
                    //$this->_postValidation();
                    if (!count($this->_postErrors))
                            $this->_postProcess();
                    else
                            foreach ($this->_postErrors as $err)
                                    $this->_html .= '<div class="alert error">'.$err.'</div>';
            }else{
                    $this->_html .= '<br />';
            }

            $this->_displayInfo();
            $this->_displayForm();

            return $this->_html;
        } else {
            echo $this->l('Module is not installed');
        }
    }
    
    private function _postProcess()
    {
        if (Tools::isSubmit('btnSubmit'))
        {
                Configuration::updateValue('SOAPBACKEND_ROOT_CATEGORY', Tools::getValue('SOAPBACKEND_ROOT_CATEGORY'));
                Configuration::updateValue('SOAPBACKEND_INITIAL_CATEGORY', Tools::getValue('SOAPBACKEND_INITIAL_CATEGORY'));
                $this->_html .= '<div class="conf confirm"> '.$this->l('Settings updated').'</div>';
        }

    }

    private function _displayInfo()
    {
            $this->_html .= '<!--<img src="../modules/'.$this->name.'/logo.png" style="float:left; margin-right:15px;">--><b>'.$this->l('SOAPBACKEND OdaCash Integration.').'</b><br /><br />'.
            '<br /><br />';
    }

    private function _displayForm()
    {
            $this->_html .= '
            <div class="hint" style="display:block"> <b>Check categories:</b>
            <br> If your store is a Prestashop 1.4 migration:<br/>
            - Set ROOT CATEGORY to 1 <br/>
            - Set INITIAL CATEGORY to 1 <br/>
            <br> If your store is a new Prestashop 1.5:<br/>
            - Set ROOT CATEGORY to 1 <br/>
            - Set INITIAL CATEGORY to 2 <br/>
            <br/>
            <br/>
            <b>Web Service URL: </b>'.$this->wsurl().'<br/>
            <b>Web Service KEY: </b>'.$this->wskey().'<br/>
            </div>
            </div>        
            <form action="'.Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']).'" method="post">
                    <fieldset>
                    <legend><img src="../img/admin/contact.gif" />'.$this->l('API CREDENTIALS').'</legend>
                            <table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
                                    <tr><td width="250" style="height: 35px;">'.$this->l('ROOT CATEGORY').'</td><td><input type="text" name="SOAPBACKEND_ROOT_CATEGORY" value="'.Tools::htmlentitiesUTF8(Tools::getValue('SOAPBACKEND_ROOT_CATEGORY', Configuration::get('SOAPBACKEND_ROOT_CATEGORY'))).'" style="width: 300px;" /></td></tr>
                                    <tr><td width="250" style="height: 35px;">'.$this->l('INITIAL CATEGORY').'</td><td><input type="text" name="SOAPBACKEND_INITIAL_CATEGORY" value="'.Tools::htmlentitiesUTF8(Tools::getValue('SOAPBACKEND_INITIAL_CATEGORY', Configuration::get('SOAPBACKEND_INITIAL_CATEGORY'))).'" style="width: 300px;" /></td></tr>
                                    <tr><td colspan="2" align="center"><br /><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
                            </table>
                    </fieldset>
            </form>';
    }
}

