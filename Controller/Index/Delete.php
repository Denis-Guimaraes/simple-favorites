<?php

namespace SimpleMage\SimpleFavorites\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Customer\Model\Session;
use SimpleMage\SimpleFavorites\Api\CustomerFavoriteRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Redirect;

class Delete implements HttpPostActionInterface
{
    private RequestInterface $request;
    private Validator $formKeyValidator;
    private Session $customerSession;
    private CustomerFavoriteRepositoryInterface $customerFavoriteRepository;
    private ManagerInterface $messageManager;
    private ResultFactory $resultFactory;

    public function __construct(
        RequestInterface $request,
        Validator $formKeyValidator,
        Session $customerSession,
        CustomerFavoriteRepositoryInterface $customerFavoriteRepository,
        ManagerInterface $messageManager,
        ResultFactory $resultFactory
    ) {
        $this->request = $request;
        $this->formKeyValidator = $formKeyValidator;
        $this->customerSession = $customerSession;
        $this->customerFavoriteRepository = $customerFavoriteRepository;
        $this->messageManager = $messageManager;
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        if (!$this->isValidRequest()) {
            return $this->redirectToFavorites();
        }

        $this->deleteFavoriteAndSetMessage();
        return $this->redirectToFavorites();
    }

    private function isValidRequest(): bool
    {
        if (!$this->formKeyValidator->validate($this->request)) {
            return false;
        }
        if (!$this->customerSession->authenticate()) {
            return false;
        }
        return true;
    }

    private function deleteFavoriteAndSetMessage(): void
    {
        try {
            $this->deleteFavorite();
            $this->setSuccessMessage();
        } catch (\Exception $e) {
            $this->setErrorMessage();
        }
    }

    private function deleteFavorite(): bool
    {
        $customerId = $this->customerSession->getCustomerId();
        $productId = $this->request->getParam('productId');
        return $this->customerFavoriteRepository->deleteByIds($customerId, $productId);
    }

    private function setSuccessMessage(): void
    {
        $this->messageManager->addSuccessMessage(__('Product has been removed from your favorites.'));
    }

    private function setErrorMessage(): void
    {
        $this->messageManager->addErrorMessage(__('We can\'t remove the product from your favorites right now.'));
    }

    private function redirectToFavorites(): Redirect
    {
        $redirect = $this->createResultRedirect();
        return $redirect->setPath('*/*/');
    }

    private function createResultRedirect(): Redirect
    {
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
    }
}
