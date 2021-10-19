<?php

namespace Js\CmsPageAuthor\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config
{
    /**
     * Config path for Author
     */
    const XML_PATH_AUTHOR = 'author/general/enable';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * Get URL redirect Error
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getAuthorConfig()
    {
        return $this->getConfig(self::XML_PATH_AUTHOR);
    }

    /**
     * Get scope config for xml path
     * @param $xmlPath
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getConfig($xmlPath)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()
        );
    }
}
