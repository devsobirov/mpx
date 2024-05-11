<?php


namespace App\Services\Seo;


use App\Models\Shop\GamePlatform;
use App\Models\Shop\ShopProductOffer;

class OfferPageSeoHelper
{
    public string $metaTitle = '';
    public string $metaDescription = '';
    protected array $context = [];

    /**
     * OfferPageSeoHelper constructor.
     * @param ShopProductOffer $offer
     * @param GamePlatform|null $gamePlatform
     * @param mixed $options
     * @param mixed $parameters
     * @param float|null $price
     * @param string|null $sign
     */
    public function __construct(
        protected ShopProductOffer $offer,
        protected ?GamePlatform $gamePlatform,
        protected mixed $options,
        protected mixed $parameters,
        protected ?float $price = null,
        protected ?string $sign = ''
    ){}

    public function getMetaTitle(): string
    {
        if (!$this->metaTitle) {
            $raw = $this->gamePlatform?->meta_offer_title;

            $this->metaTitle = !empty($raw)
                ? str_replace(array_keys($this->getContext()), array_values($this->getContext()), $raw)
                : $this->getDefaultMetaTitle();
        }

        return $this->metaTitle;
    }

    public function getMetaDescription(): string
    {
        if (!$this->metaDescription) {
            $raw = $this->gamePlatform?->meta_offer_description;

            $this->metaDescription = !empty($raw)
                ? str_replace(array_keys($this->getContext()), array_values($this->getContext()), $raw)
                : $this->getDefaultMetaDescription();
        }

        return $this->metaDescription;
    }

    protected function getContext(): array
    {
        if (empty($this->context)) {
            $this->context = [
                '_NAME_' => $this->offer->name,
                '_PLATFORM_' => $this->gamePlatform->title,
                '_PRICE_' => "$this->price $this->sign",
                '_OPTION_' => $this->getOptionsContext()
            ];
        }

        return $this->context;
    }

    /**
     * If url parameters contain keys from options [array with data for generating input elements],
     *  then if option is not checkbox and option is 'modifier_visible'
     *  then collects text [label] of related options variant and return all of them separated by coma
     *
     * @return string
     */
    protected function getOptionsContext(): string
    {
        $context = [];

        if (!empty($this->options) && !empty($this->parameters)) {
            foreach ($this->options as $option) {
                if (
                    array_key_exists($option['name'], $this->parameters)
                    && $option['type'] !== 'checkbox'
                    && !empty($option['modifier_visible'])
                    && !empty($option['variants']))
                {
                    foreach ($option['variants'] as $variant) {
                        if ($variant['value'] == $this->parameters[$option['name']]) {
                            $context[] = $variant['text'] ?? '';
                        }
                    }
                }
            }
        }

        return implode(',',  $context);
    }

    protected function getDefaultMetaTitle(): string
    {
        return "Купить ". $this->offer->name;
    }

    protected function getDefaultMetaDescription(): string
    {
        return substr(strip_tags((string)$this->offer->info), 0, 150);
    }
}
