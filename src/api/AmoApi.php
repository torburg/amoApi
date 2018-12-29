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

    /**
     * @param string $entity_name
     * @param array $data
     * @return array
     */
    public function add(string $entity_name, array $data) : array {

        $data_to_send['add'] = $data;
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
        return $this->curl_send($link, $data_to_send);
    }

    /***
     * @param string $login
     * @param string $hash
     * @return bool
     */
    public function authorization(string $login, string $hash) : bool {
//        try {
//
//            $this->_user['USER_LOGIN'] = $login;
//        }
        $this->_user['USER_HASH'] = $hash;
        $this->_subdomain = explode("@", $login)[0];
        $link = 'https://' . $this->_subdomain . '.amocrm.ru/private/api/auth.php?type=json';
        $response = $this->curl_send($link, $this->_user);
        $response = $response['response'];
        return $response['auth'];
    }

    /**
     * @param string $entity_name
     * @param int $amount
     * @param array $existing_entities
     * @return array
     */
    public function collect(string $entity_name, int $amount, array $existing_entities = []) : array {
        $result = [];
        for ($i = 0; $i < $amount; $i++) {
            $entity = [];
            $entity['name'] = "$entity_name " . rand(0, 10000);
            if ($entity_name === "customers") {
                $entity['next_date'] = strtotime('22-09-2019');
            }
            if ($entity_name === "fields") {
                $entity['origin'] = generate_random_string();
                $entity['field_type'] = 5; //type of field - MULTISELECT
                $entity ['element_type'] = 1; //for contacts
                $entity ['enums'] = [
                    "чёрный",
                    "белый",
                    "красный",
                    "оранжевый",
                    "голубой",
                    "фиолетовый",
                    "прозрачный",
                    "жёлтый",
                    "синий",
                    "зелёный"
                ];
            }
            if (array_key_exists('contacts', $existing_entities) &&  $existing_entities['contacts']) {
                $entity['contacts_id'] = $existing_entities['contacts'][$i];
            }
            if (array_key_exists('companies', $existing_entities) && $existing_entities['companies']) {
                $entity['company_id'] = $existing_entities['companies'][$i];
            }
            $result[] = $entity;
        }
        return $result;
    }

    /**
     * @param string $link
     * @param array $params
     * @return array
     */
    private function curl_send(string $link, array $params = []) : array {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);

        if ($params) {
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($curl,CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        } else {
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'GET');
        }

        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,$_SERVER['DOCUMENT_ROOT'] . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_COOKIEJAR,$_SERVER['DOCUMENT_ROOT'] . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        $out = curl_exec($curl);
        try {
            if (!$out) {
                throw new Exception('Неверный запрос к базе данных');
            }
        } catch (Exception $E) {
            die('Ошибка. ' . $E->getMessage());
        }
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

    /**
     * @param string $entity
     * @param string $params
     * @return array
     */
    public function get(string $entity, string $params = "") : array {
        $link = 'https://' . $this->_subdomain . '.amocrm.ru/api/v2/' . $entity;
        if ($params) {
            $link .= '/?' . $params;
        }
        return $this->curl_send($link);
    }

    /**
     * @param array $response
     * @return array
     */
    public function response_processing(array $response) : array {
        $result = [];
        foreach ($response as $item) {
            $result[] = $item['id'];
        }
        return $result;
    }

    /**
     * @param string $entity_name
     * @param array $data
     * @return array
     */
    public function update(string $entity_name, array $data) {
        $data_to_send['update'] = $data;
        $link = 'https://' . $this->_subdomain . '.amocrm.ru/api/v2/' . $entity_name;
        return $this->curl_send($link, $data_to_send);
    }

}
