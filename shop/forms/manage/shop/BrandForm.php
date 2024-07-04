<?php

namespace shop\forms\manage\shop;

use shop\entities\shop\Brand;
use shop\forms\manage\MetaForm;
use yii\base\Model;

class BrandForm extends Model
{
    public $name;
    public $slug;
    public $meta;

    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name = $brand->name;
            $this->slug = $brand->slug;
            $this->meta = new MetaForm($brand->meta);
            $this->_brand = $brand;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            //['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null]
            //[['name', 'slug'], 'unique', 'targetClass' => Brand::class]
        ];
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}