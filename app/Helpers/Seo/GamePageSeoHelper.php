<?php


namespace App\Helpers\Seo;


use App\Models\Product;

class GamePageSeoHelper
{
    public string $metaTitle = '';
    public string $metaDescription = '';
    protected array $context = [];

    public function __construct(
      protected ?Product $product,
      protected ?string $sorting = '',
      protected ?float $price = null,
      protected ?string $sign = ''
    ){}

    public function getMetaTitle(): string
    {
        if (!$this->metaTitle) {
           $title = $this->product->getTranslation('meta_title', app()->getLocale(), false) ?: '';
           $this->metaTitle = str_replace(array_keys($this->getContext()), array_values($this->getContext()), $title);
        }

        return $this->metaTitle;
    }

    public function getMetaDescription(): string
    {
        if (!$this->metaDescription) {
            $description = $this->product->getTranslation('meta_description', app()->getLocale(), false) ?: '';
            $this->metaDescription = str_replace(array_keys($this->getContext()), array_values($this->getContext()), $description);
        }

        return $this->metaDescription;
    }

    protected function getContext(): array
    {
        if (empty($this->context)) {
            $this->context = [
                '_NAME_' => $this->product->name,
                '_PRICE_' => "$this->price $this->sign",
                '_SORT_' => $this->getSortingContext()
            ];
        }

        return $this->context;
    }

    protected function getSortingContext(): string
    {
        return match ($this->sorting) {
            "sales" => __('v2_product.offer_sort_sales'),
            "min_price" => __('v2_product.offer_sort_min_price'),
            "max_price" => __('v2_product.offer_sort_max_price'),
            "rating" => __('v2_product.offer_sort_rating'),
            default => ''
        };
    }
}
