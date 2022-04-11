<?php

/**
 * @package Biz\Ebit
 * @author Lailson
 */

namespace Biz\Ebit\Block\Checkout\Success;

use Biz\Ebit\Helper\Data;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Success extends Template
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * @var Session
     */
    private $session;


    public function __construct(
        Context $context,
        Session $session,
        Data $helper
    ) {
        parent::__construct($context);
        $this->session = $session;
        $this->helper = $helper;
    }

    /**
     * @return bool
     */
    public function isEnableBanner(): bool
    {
        return (bool)$this->helper->getConfigValue(Data::CONFIG_ENABLE_BANNER);
    }

    /**
     * @return bool
     */
    public function showLightbox(): bool
    {
        return (bool)$this->helper->getConfigValue(Data::CONFIG_LIGHTBOX);
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return (int)$this->helper->getConfigValue(Data::CONFIG_STORE_ID);
    }

    /**
     * @return string|null
     */
    public function getEbitParams(): ?string
    {
        // $lastOrder ->  Dados do ultimo pedido sendo realizado
        $lastOrder = $this->session->getLastRealOrder();
        if (!$lastOrder) {
            return null;
        }

        // $shippingAddress -> Dados do Cliente do Pedido. exe(region,lastname,street)
        $shippingAddress = $lastOrder->getShippingAddress();

        $value = 'email=' . $lastOrder->getCustomerEmail();
        $value .= '&gender=' . $lastOrder->getCustomerGender();
        $value .= '&birthDay=' . $lastOrder->getCustomerDob();
        $value .= '&zipCode=' . (($shippingAddress) ? $shippingAddress->getPostCode() : '');
        $value .= '&deliveryTax=' . $lastOrder->getShippingInclTax();
        $value .= '&deliveryType=' . $lastOrder->getShippingMethod();
        $value .= '&totalSpent=' . $lastOrder->getGrandTotal();
        $value .= '&value=' . $lastOrder->getGrandTotal();
        $value .= '&cctype=' . $lastOrder->getPayment()->getCcType();
        $value .= '&method=' . $lastOrder->getPayment()->getMethod();

        if ($items = $lastOrder->getAllVisibleItems()) {

            try {

                $qty = [];
                $name = [];
                $sku = [];

                foreach ($items as $i => $item) {
                    $qty[$i] = $item->getQtyOrdered();
                    $name[$i] = $item->getName();
                    $sku[$i] = $item->getSku();
                }

                $value .= '&quantity=' . implode('|', $qty);
                $value .= '&productName=' . implode('|', $name);
                $value .= '&sku=' . implode('|', $sku);
                $value .= '&transactionId=' . $lastOrder->getId();
                $value .= '&storeId=' . $this->getStoreId();
                $value .= '&mktSaleID=0';
                $value .= '&plataform=0';

            } catch (\Exception $e) {
                $this->_logger->critical($e->getMessage());
            }

            return trim($value);
        }
    }

}

