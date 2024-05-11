<?php


namespace App\Services\Seo;


class SearchPageSeoHelper
{
    public string $metaTitle = '';
    public string $metaDescription = '';
    protected array $context = [];

    const TITLE_KEY = 'v2_seo.search_title';
    const DESC_KEY = 'v2_seo.search_desc';

    public function __construct(
        protected ?string $search,
        protected ?array $platforms = []
    ){}

    public function getMetaTitle(): string
    {
        if (!$this->metaTitle) {
            $this->metaTitle = str_replace(array_keys($this->getContext()), array_values($this->getContext()), __(self::TITLE_KEY));
        }

        return $this->metaTitle;
    }

    public function getMetaDescription(): string
    {
        if (!$this->metaDescription) {
            $this->metaDescription = str_replace(array_keys($this->getContext()), array_values($this->getContext()), trans(self::DESC_KEY));
        }

        return $this->metaDescription;
    }

    protected function getContext(): array
    {
        if (empty($this->context)) {
            if (!is_array($this->platforms)) $this->platforms = [];

            $this->context = [
                '_KEY_' => $this->search,
                '_PLATFORM_' => implode(', ', $this->platforms),
            ];
        }

        return $this->context;
    }
}
