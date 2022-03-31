<?php

namespace Navigate\HomepageBannerSlider\Controller\Adminhtml\Bannerslider;

use Navigate\HomepageBannerSlider\Model\BannersliderFactory;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var bool
     */
    protected $resultPageFactory = false;
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        BannersliderFactory $bannersliderFactory
    ) {
        parent::__construct($context);
        $this->_resultFactory = $context->getResultFactory();
        $this->bannersliderFactory = $bannersliderFactory;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->bannersliderFactory->create();
                $model->load($id);
                $data = $model->getData();
                $model->delete();
                $this->messageManager->addSuccess(__("Bannerslider deleted successfully."));
            } catch (\Exception $e) {
                $this->messageManager->addError('Something went wrong '.$e->getMessage());
            }
        } else {
            $this->messageManager->addError('Bannerslider not found, please try once more.');
        }
        
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('bannerslider/bannerslider/index');
        return $resultRedirect;
    }
}
