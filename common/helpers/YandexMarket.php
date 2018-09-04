<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07.08.2018
 * Time: 14:11
 */

namespace common\helpers;

use Behat\Mink\Driver\GoutteDriver;
use DiDom\Document;
use DMore\ChromeDriver\ChromeDriver;
use yii\helpers\Json;

class YandexMarket
{

    const STATUS_OK = 'ok';
    const STATUS_NOT_FOUND = 'not_found';

    public static function search($name)
    {

        $link = 'https://market.yandex.ru/search?cvredirect=2&text=' . $name;

        //$request = self::anon($link, '&text=' . $name);




        // Choose a Mink driver. More about it in later chapters.
        $driver = new GoutteDriver();

        $session = new \Behat\Mink\Session($driver);

// start the session
        $session->start();
        $session->visit($link);

        $body = $session->getPage()->getContent();

        $document = new Document($body);
        $images = [];
        //

        foreach ($document->find('meta[property="og:image"]') as $item) {
            $images[] = $item->attr('content');
        }

        foreach ($document->find('.n-product-spec-list__item') as $item) {
            dd($item->text());
        }


        return [
            'status' => self::STATUS_OK,
            'query' => $name,
            'result' => [
                'images' => $images,
            ],
            'debug' => [
                'requests' => [
                    'first' => [
                        'link' => $link,
                        'body' => $body,
                    ]
                ]
            ]
        ];
    }

    /**
     * @param $url string
     * @param $addParams string
     * @return \Requests_Response
     */
    public static function anon($url, $addParams)
    {
        $anonimizerApi ='http://noblockme.ru/api/anonymize?url=' . $url;
        $requestAnonimizer = \Requests::get($anonimizerApi);
        $res = Json::decode($requestAnonimizer->body);
        return \Requests::get($res['result'] . $addParams);
    }
}