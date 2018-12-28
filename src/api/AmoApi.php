<?php

namespace Amo\Api;

use Exception;

class AmoApi
{
    private $_user = [
        'USER_LOGIN',
        'USER_HASH'
    ];
    private $_subdomain;

    public function add(string $entity_name, array $data) {

        $link = 'https://' . $this->_subdomain . '.amocrm.ru/api/v2/' . $entity_name;
//        $leads['add'] = [
//            ['name' => 'Сделка по карандашам',
//                'created_at' => 1298904164,
//                'status_id' => 142,
//                'sale' => 300000,
//                'responsible_user_id'=>215302,
//                'tags' => 'Important, USA', #Теги
//                'custom_fields' => [
//                    [
//                        'id' => 427496, #Уникальный индентификатор заполняемого дополнительного поля
//                        'values' => [ # id значений передаются в массиве values через запятую
//                            1240665,
//                            1240664
//                        ]
//                    ],
//                    [
//                        'id' => 427497, #Уникальный индентификатор заполняемого дополнительного поля
//                        'values' => [
//                            [
//                                'value'=>1240667
//                            ]
//                        ]
//                    ],
//                    [
//                        'id' => 427231, #Уникальный индентификатор заполняемого дополнительного поля
//                        'values' => [
//                            [
//                                'value'=>'14.06.2014' # в качестве разделителя используется точка
//                            ]
//                        ]
//                    ],
//                    [
//                        'id' => 458615, #Уникальный индентификатор заполняемого дополнительного поля
//                        'values' => [
//                            [
//                                'value' => 'Address line 1',
//                                'subtype' => 'address_line_1',
//                            ],
//                            [
//                                'value' => 'Address line 2',
//                                'subtype' => 'address_line_2',
//                            ],
//                            [
//                                'value' => 'Город',
//                                'subtype' => 'city',
//                            ],
//                            [
//                                'value' => 'Регион',
//                                'subtype' => 'state',
//                            ],
//                            [
//                                'value' => '203',
//                                'subtype' => 'zip',
//                            ],
//                            [
//                                'value' => 'RU',
//                                'subtype' => 'country'
//                            ]
//                        ]
//                    ]
//                ]
//            ],
//            [
//                'name' => 'Бумага',
//                'created_at' => 1298904164,
//                'status_id' => 7087609,
//                'sale' => 600200,
//                'responsible_user_id' => 215309,
//                'custom_fields' => [
//                    [
//                        #Нестандартное дополнительное поле типа "мультисписок", которое мы создали
//                        'id' => 426106,
//                        'values' => [
//                            1237756,
//                            1237758
//                        ]
//                    ]
//                ]
//            ]
//        ];
        return $this->curl_send($link, $data);

    }

    public function authorization(string $login, string $hash) : bool {
        $this->_user['USER_LOGIN'] = $login;
        $this->_user['USER_HASH'] = $hash;
        $this->_subdomain = explode("@", $login)[0];
        $link = 'https://' . $this->_subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $response = $this->curl_send($link, $this->_user);
        $response = $response['response'];
        return $response['auth'];
    }

    public function collect (string $entity_name, int $n, array $fields_to_add) : array {
        $result = [];
        for ($i = 0; $i < $n; $i++) {
            $entity['name'] = "$entity_name " . rand(0, 10000);
            if ($entity_name == "customers") {
                $entity['next_date'] = strtotime('22-09-2019');
            }
            if ($fields_to_add['contacts']) {
                $entity['contacts_id'] = $fields_to_add['contacts'][$i];
            }
            if ($fields_to_add['companies']) {
                $entity['company_id'] = $fields_to_add['companies'][$i];
            }
            $result['add'][] = $entity;
        }
        return $result;
    }

    private function curl_send(string $link, array $post_fields) : array {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($post_fields));
        curl_setopt($curl,CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,$_SERVER['DOCUMENT_ROOT'] . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_COOKIEJAR,$_SERVER['DOCUMENT_ROOT'] . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        $out = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        $code = (int)$code;
        try {
            if ($code != 200 && $code != 204) {
                throw new Exception(isset(ERRORS[$code]) ? ERRORS[$code] : 'Undescribed error', $code);
            }
        } catch (Exception $E) {
            die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
        }
        return json_decode($out,true);
    }

    public function response_processing(array $response) : array {
        $result = [];
        foreach ($response as $item) {
            $result[] = $item['id'];
        }
        return $result;
    }





}