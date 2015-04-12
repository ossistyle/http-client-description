<?php

namespace Vws\Test\Integ;

use GuzzleHttp\Collection;

trait ProductCatalogCreateLinkDataProvider
{
    private $catalogGuids = [];
    private $productGuids = [];

    public function productCatalogCreateLinkData()
    {
        print_r($this->buildProducts()->toArray());
        print_r($this->productGuids);

        return array_merge(
            // $this->buildCatalogs()->toArray()
            []
        );
    }







    protected function buildCatalogs()
    {
        $catalogs = new Collection();
        $this->catalogGuids = [];
        $count = 2;
        for ($i = 1; $i <= $count; $i++) {
            $catalog = new Collection();
            $catalog->set('Name', 'Root ' . $i . ' with products');

            $guid = self::getGUID();
            $this->catalogGuids[] = $guid;
            $catalog->set('ForeignId', $guid);
            for ($x = 1; $x <= $count; $x++) {
                $subCatalog = new Collection();
                $subCatalog->set('Name', 'Child ' . $i . '. ' . $x . '');

                $guid = self::getGUID();
                $this->catalogGuids[] = $guid;
                $subCatalog->set('ForeignId', $guid);
                $catalog->add('ChildCatalogs', $subCatalog);

                for ($y = 1; $y <= $count; $y++) {
                    $subCatalog1 = new Collection();
                    $subCatalog1->set('Name', 'Child ' . $i . '. ' . $x . '. ' . $y . '');

                    $guid = self::getGUID();
                    $this->catalogGuids[] = $guid;
                    $subCatalog1->set('ForeignId', $guid);
                    $subCatalog->add('ChildCatalogs', $subCatalog1);

                    for ($z = 1; $z <= $count; $z++) {
                        $subCatalog2 = new Collection();
                        $subCatalog2->set('Name', 'Child ' . $i . '. ' . $x . '. ' . $y . '. ' . $z . '');

                        $guid = self::getGUID();
                        $this->catalogGuids[] = $guid;
                        $subCatalog2->set('ForeignId', $guid);
                        $subCatalog1->add('ChildCatalogs', $subCatalog2);
                    }
                }
            }
            $catalogs->add($i-1, $catalog->toArray());
        }
        return $catalogs;
    }

    private function buildProducts()
    {
        $products = new Collection();
        $count = 30;
        for ($i = 1; $i <= $count; $i++) {
            $product = $this->buildProduct();
            $products->add($i-1, $product->toArray());
        }
        return $products;
    }

    private function buildProduct()
    {
        $product = new Collection();
        $product->set('Name', 'ProductName');

        $guid = self::getGUID();
        $this->productGuids[] = $guid;
        $product->set('ForeignId', $guid);
        $product->set('StockAmount', 1);
        $product->set('Price', 1.23);
        $product->set('Description', 'Description');
        $product->set('ShortDescription', 'ShortDescription');

        $images = new Collection();
        $image = new Collection();
        $image->set('ForeignId', self::getGUID());
        $image->set('ImageUrl', 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg');
        $image->set('Type', 2);
        $images->add(0, $image->toArray());
        $product->add('Images', $images->toArray());

        $specifics = new Collection();
        $specific = new Collection();
        $specific->set('ForeignId', self::getGUID());
        $specific->set('Name', 'Marke');
        $specific->set('Value', 'VIA-eBay');
        $specifics->add(0, $specific->toArray());
        $product->add('Specifics', $specifics->toArray());

        $randomValue = mt_rand();
        if ($randomValue&1) {
            $variations = new Collection();
            $variation = new Collection();
            $variation->set('ForeignId', self::getGUID());
            $variation->set('Price', 1.23);
            $variation->set('StockAmount', 1);
            $variation->set('Sku', self::getGUID());

            $variationSpecifics = new Collection();
            $variationSpecific = new Collection();
            $variationSpecific->set('ForeignId', self::getGUID());
            $variationSpecific->set('Name', 'Farbe');
            $variationSpecific->set('Value', 'rot');

            $variationSpecifics->add(0, $variationSpecific->toArray());
            $variation->add('Specifics', $variationSpecifics->toArray());

            $variations->add(0, $variation->toArray());
            $product->add('Variations', $variations->toArray());
        }

        return $product;
    }
}
