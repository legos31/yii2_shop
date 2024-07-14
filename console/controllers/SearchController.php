<?php

namespace console\controllers;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use shop\entities\shop\Category;
use shop\entities\shop\Product\CategoryAssignment;
use shop\entities\Shop\Product\Product;
use shop\entities\shop\Product\Value;
use shop\services\search\ProductIndexer;
use yii\base\Exception;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
    private $client;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->client = ClientBuilder::create()->setHosts([
            'http://localhost:9200'
        ])->build();
    }

    public function actionReindex(): void
    {

        $client = (new \OpenSearch\ClientBuilder())
            ->setHosts(['http://localhost:9200'])
            ->setBasicAuthentication('admin', 'Qaz308001') // For testing only. Don't store credentials in code.
            ->setSSLVerification(false) // For testing only. Use certificate for validation
            ->build();


        $query = Product::find()
            ->active()
            ->with(['category', 'categoryAssignments', 'tagAssignments', 'values'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try {
            $client->deleteByQuery([
                'index' => 'products',
                //'type' => 'products',
                'body' => [
                    'query' => [
                        'match_all' => new \stdClass(),
                    ],
                ],
            ]);
        } catch (Exception $e) {
            $this->stdout('Index is empty' . PHP_EOL);
        }


        $this->stdout('Indexing of products' . PHP_EOL);


        foreach ($query->each() as $product) {
            /** @var Product $product */
            $this->stdout('Product #' . $product->id . PHP_EOL);
            $client->index([
                'index' => 'products',
                //'type' => 'products',
                'id' => $product->id,
                'body' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => strip_tags($product->description),
                    'price' => $product->price_new,
                    'rating' => $product->rating,
                    'brand' => $product->brand_id,
                    'categories' => ArrayHelper::merge(
                        [$product->category->id],
                        ArrayHelper::getColumn($product->category->parents, 'id'),
                        ArrayHelper::getColumn($product->categoryAssignments, 'category_id'),
                        array_reduce(array_map(function (CategoryAssignment $category) {
                            return ArrayHelper::getColumn($category->findCategory($category->category_id)->parents, 'id');
                        }, $product->categoryAssignments),'array_merge', [])
                    ),
                    'tags' => ArrayHelper::getColumn($product->tagAssignments, 'tag_id'),
                    'values' => array_map(function (Value $value) {
                        return [
                            'characteristic' => $value->characteristic_id,
                            'value_string' => (string)$value->value,
                            'value_int' => (int)$value->value,
                        ];
                    }, $product->values),
                ],
            ]);
        }

        $this->stdout('Done!' . PHP_EOL);


//        $response = $client->search([
//                'index' => 'product',
//                'body' => [
//                    'query' => [
//                        'match' => [
//                            'text_entry' => 'блок',
//
//                        ]
//                    ]
//                ]
//            ]
//        );
//
//        dd($response);
    }
}