<?php 

namespace Raakkan\Yali\Core\Pages\Manager;

class PageService
{
    protected $pageRepository;
    protected $pageFactory;

    public function __construct(PageRepository $pageRepository, PageFactory $pageFactory)
    {
        $this->pageRepository = $pageRepository;
        $this->pageFactory = $pageFactory;
    }

    public function createPages($pagesConfig)
    {
        foreach ($pagesConfig as $pageConfig) {
            $page = $this->pageFactory->create($pageConfig);
            $this->pageRepository->add($page);
        }
    }

    public function getPages()
    {
        return $this->pageRepository->all();
    }

    public function getPageBySlug($slug)
    {
        return $this->pageRepository->findBySlug($slug);
    }
}