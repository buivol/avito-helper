<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07.08.2018
 * Time: 14:11
 */

namespace common\helpers;

use yii\helpers\Json;

class YandexMarket
{

    const STATUS_OK = 'ok';
    const STATUS_NOT_FOUND = 'not_found';
    const STATUS_ERROR = 'error';

    const API_PAYLOAD = 'http://market.apisystem.name/';
    const API_VERSION = 'v2';
    const DEBUG = 1;

    const API_KEY = '109ccd912a78763e225cc40affe21597fd4c8bb9d5e5d46121';

    //$photos, $names, $descriptions, $specifications, $category, $categoryId, $modelId, $prices
    public static function parseItem($item, &$data)
    {
        foreach ($item['photos'] as $photo) {
            if (!in_array($photo['url'], $data['photos'])) {
                $data['photos'][] = $photo['url'];
            }
        }
        if (isset($item['name']) && !in_array($item['name'], $data['names'])) {
            if (strlen($item['name'])) {
                $data['names'][] = $item['name'];
            }
        }

        if (isset($item['vendor'])) {
            if (!isset($data['vendor']['name']) && strlen($item['vendor']['name'])) {
                $data['vendor']['name'] = $item['vendor']['name'];
            }
            if (!isset($data['vendor']['id']) && strlen($item['vendor']['id'])) {
                $data['vendor']['id'] = $item['vendor']['id'];
            }
            if (!isset($data['vendor']['logo']) && strlen($item['vendor']['picture'])) {
                $data['vendor']['logo'] = $item['vendor']['picture'];
            }
        }

        if (isset($item['description']) && !in_array($item['description'], $data['descriptions'])) {
            if (strlen($item['description'])) {
                $data['descriptions'][] = $item['description'];
            }
        }

        if (isset($item['specification'])) {
            foreach ($item['specification'] as $spec) {
                if (isset($spec['features'])) {
                    foreach ($spec['features'] as $feature) {
                        if (isset($feature['value']) && !in_array($feature['value'], $data['specifications'])) {
                            $data['specifications'][] = $feature['value'];
                        }
                    }
                }

            }
        }

        if (!$data['category'] && isset($item['category'])) {
            $data['category'] = $item['category']['fullName'];
            $data['categoryId'] = $item['category']['id'];
        }

        if (isset($item['price'])) {
            if (isset($item['price']['min']) && !in_array($item['price']['min'], $data['prices'])) {
                $data['prices'][] = $item['price']['min'];
            }

            if (isset($item['price']['max']) && !in_array($item['price']['max'], $data['prices'])) {
                $data['prices'][] = $item['price']['max'];
            }

            if (isset($item['price']['avg']) && !in_array($item['price']['avg'], $data['prices'])) {
                $data['prices'][] = $item['price']['avg'];
            }

            if (isset($item['price']['value']) && !in_array($item['price']['value'], $data['prices'])) {
                $data['prices'][] = $item['price']['value'];
            }
        }

        if (!$data['modelId']) {
            if (isset($item['__type']) && $item['__type'] == 'model') {
                $data['modelId'] = $item['id'];
            } else if (isset($item['model'])) {
                $data['modelId'] = $item['model']['id'];
            }
        }

        if (isset($item['offer'])) {
            self::parseItem($item['offer'], $data);
        }
    }

    public static function search($name)
    {
        $result = ['status' => self::STATUS_ERROR, 'data' => null, 'query' => $name];

        $link = self::API_PAYLOAD . self::API_VERSION . '/search';
        $link .= '?text=' . urlencode($name);
        $link .= '&fields=ALL';
        $link .= '&api_key=' . self::API_KEY;


        if (self::DEBUG) {
            $body = file_get_contents(__DIR__ . '/yandex-reports/search.json');
        } else {
            $request = \Requests::get($link);
            $body = $request->body;
        }

        $payload = Json::decode($body);

        if (!$payload['context']['page']['totalItems']) {
            $result['status'] = self::STATUS_NOT_FOUND;
            return $result;
        }

        $data = [
            'photos' => [],
            'names' => [],
            'descriptions' => [],
            'specifications' => [],
            'prices' => [],
            'categoryId' => null,
            'category' => null,
            'modelId' => null,
            'vendor' => [],
        ];

        foreach ($payload['items'] as $item) {
            self::parseItem($item, $data);
        }

        $result['data'] = $data;
        $result['status'] = self::STATUS_OK;

        return $result;
    }
}