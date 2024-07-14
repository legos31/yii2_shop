<?php

namespace frontend\widgets\Shop;

use shop\entities\Shop\Category;
use shop\readModels\Shop\CategoryReadRepository;
use shop\readModels\Shop\views\CategoryView;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $categories;

    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run(): string
    {
        $client = (new \OpenSearch\ClientBuilder())
            ->setHosts(['http://elasticsearch:9200'])
            ->setBasicAuthentication('admin', 'Qaz308001') // For testing only. Don't store credentials in code.
            ->setSSLVerification(false) // For testing only. Use certificate for validation
            ->build();

        $aggs = $client->search([
            'index' => 'products',
            'body' => [
                'size' => 0,
                'aggs' => [
                    'group_by_category' => [
                        'terms' => [
                            'field' => 'categories'
                        ]
                    ]
                ]
            ]
        ]);
        $count = ArrayHelper::map($aggs['aggregations']['group_by_category']['buckets'], 'key', 'doc_count');

        return Html::tag('div', implode(PHP_EOL, array_map(function (Category $view) use ($count){
            $indent = ($view->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $view->depth - 1) . '- ' : '');
            $active = $this->active && ($this->active->id == $view->id || $this->active->isChildOf($view));
            $count = ArrayHelper::getValue($count, $view->id, 0);
            return Html::a(
                $indent . Html::encode($view->name) .' ('.$count .')',
                ['/shop/catalog/category', 'id' => $view->id],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        }, $this->categories->getTreeWithSubsOf($this->active))), [
            'class' => 'list-group',
        ]);

    }
}