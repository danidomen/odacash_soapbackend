<?php
include_once $pearpath . '/MDB2/MDB2.php';
include_once $pearpath . '/MDB2/MDB2/LOB.php';
include_once $pearpath . '/MDB2/MDB2/Driver/Datatype/Common.php';
include_once $pearpath . '/MDB2/MDB2/Driver/Function/Common.php';
include_once $pearpath . '/MDB2/MDB2/Driver/Reverse/Common.php';
include_once $pearpath . '/MDB2/MDB2/Driver/Native/Common.php';
include_once $pearpath . '/MDB2/MDB2/Driver/Manager/Common.php';

/*
static function getSingletonDb($dsn) {
    $dbh =& MDB2::singleton($dsn);
    //$dbh->setFetchMode(MDB2_FETCHMODE_ASSOC);
    //$dbh->exec("SET CHARACTER SET UTF8");
    //$dbh->exec("SET NAMES UTF8");
    return $dbh;
}
*/

