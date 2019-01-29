<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\UpwardConnector\Controller;

use Magento\Framework\App\FrontControllerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\HTTP\PhpEnvironment\Response;
use Magento\Upward\Controller as UpwardController;

class Upward implements FrontControllerInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var UpwardController
     */
    private $upwardController;

    /**
     * @param Response $response
     * @param UpwardController $upwardController
     */
    public function __construct(
        Response $response,
        UpwardController $upwardController
    ) {
        $this->response = $response;
        $this->upwardController = $upwardController;
    }

    /**
     * Dispatch application action
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        /** @var \Zend\Http\Response $upwardResponse */
        $upwardResponse = ($this->upwardController)();
        $this->response->setHeaders($upwardResponse->getHeaders());
        $this->response->setStatusCode($upwardResponse->getStatusCode());
        $this->response->setContent($upwardResponse->getContent());
        return $this->response;
    }
}
