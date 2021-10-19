<?php

namespace Js\CmsPageAuthor\Block;

use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Page\Config;
use Magento\Store\Model\StoreManagerInterface;
use Js\CmsPageAuthor\Model\Config as AuthorConfig;

class Author extends \Magento\Cms\Block\Page
{

    /**
     * String Author
     */
    const AUTHOR = 'Author: ';

    /**
     * @var AuthorConfig
     */
    private $authorConfig;

    /**
     * Author constructor.
     */
    public function __construct(
        AuthorConfig $authorConfig,
        StoreManagerInterface $storeManager,
        Context $context,
        Page $page,
        FilterProvider $filterProvider,
        PageFactory $pageFactory,
        Config $pageConfig,
        array $data = []
    ) {
        $this->authorConfig = $authorConfig;
        parent::__construct($context, $page, $filterProvider, $storeManager, $pageFactory, $pageConfig, $data = []);
    }

    /**
     * Prepare HTML content
     *
     * @throws \Exception
     */
    protected function _toHtml()
    {
        $authorField = $this->getPage()->getAuthor();
        if ($authorField != null && $this->authorConfig->getAuthorConfig()) {
            return self::AUTHOR . $this->_filterProvider->getPageFilter()->filter($authorField);
        }
    }
}
