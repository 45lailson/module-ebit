<?php

/**
 * @package Biz\Ebit
 * @author Lailson
 */

namespace Biz\Ebit\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_ENABLE_BANNER = 'enable_banner';
//    const CONFIG_ENABLE_SELO = 'enable_selo';
    const CONFIG_STORE_ID = 'store_id';
//    const CONFIG_BUSCAPE_ID = 'buscape_id';
    const CONFIG_LIGHTBOX = 'lightbox';


    /**
     * @param string $param
     * @return mixed
     */
    public function getConfigValue(string $param = '')
    {
        return $this->scopeConfig->getValue(
            'ebit/general/' . $param,
            ScopeInterface::SCOPE_STORE
        );
    }


}
