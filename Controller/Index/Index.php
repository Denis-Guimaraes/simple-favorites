<?php

namespace SimpleMage\SimpleFavorites\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Response\Http;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private Session $session;
    private Http $response;
    private PageFactory $pageFactory;

    public function __construct(
        Session $session,
        Http $response,
        PageFactory $pageFactory
    ) {
        $this->session = $session;
        $this->response = $response;
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        if (!$this->session->authenticate()) {
            return $this->response;
        }
        return $this->pageFactory->create();
    }
}
