<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\Netaxept;

use Omnipay\Common\AbstractResponse;

/**
 * Netaxept Response
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        if (isset($this->data->Error)) {
            return false;
        }

        return 'OK' === (string) $this->data->ResponseCode;
    }

    public function getGatewayReference()
    {
        if ($this->isSuccessful()) {
            return (string) $this->data->TransactionId;
        }
    }

    public function getMessage()
    {
        if (isset($this->data->Error)) {
            return (string) $this->data->Error->Message;
        } else {
            return (string) $this->data->ResponseCode;
        }
    }
}
