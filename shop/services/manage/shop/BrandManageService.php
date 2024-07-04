<?php

namespace shop\services\manage\shop;

use shop\entities\Meta;
use shop\entities\shop\Brand;
use shop\forms\manage\MetaForm;
use shop\forms\manage\shop\BrandForm;
use shop\repositories\shop\BrandRepository;
use shop\repositories\shop\ProductRepository;

class BrandManageService
{
    private BrandRepository $brands;
    private ProductRepository $productRepository;

    public function __construct(BrandRepository $brandRepository, ProductRepository $productRepository)
    {
        $this->brands = $brandRepository;
        $this->productRepository = $productRepository;
    }

    public function create(BrandForm $form): Brand
    {
        $brand = Brand::create(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
        return $brand;
    }

    public function edit($id, BrandForm $form): void
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->brands->save($brand);
    }

    public function remove($id): void
    {
        $brand = $this->brands->get($id);
        if ($this->productRepository->existsByBrand($brand->id)) {
            throw new \DomainException('Unable to remove brand with products.');
        }
        $this->brands->remove($brand);
    }
}