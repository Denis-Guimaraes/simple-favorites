<?php

namespace SimpleMage\SimpleFavorites\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ToggleFavorite implements ArgumentInterface
{
    private RequestInterface $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function getProductId(): string
    {
        return $this->request->getParam('id');
    }
}
