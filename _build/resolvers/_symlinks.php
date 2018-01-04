<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/msSimplePayInvoice/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/mssimplepayinvoice')) {
            $cache->deleteTree(
                $dev . 'assets/components/mssimplepayinvoice/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/mssimplepayinvoice/', $dev . 'assets/components/mssimplepayinvoice');
        }
        if (!is_link($dev . 'core/components/mssimplepayinvoice')) {
            $cache->deleteTree(
                $dev . 'core/components/mssimplepayinvoice/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/mssimplepayinvoice/', $dev . 'core/components/mssimplepayinvoice');
        }
    }
}

return true;