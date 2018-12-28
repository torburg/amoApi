<?php
//	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
//		$uri = 'https://';
//	} else {
//		$uri = 'http://';
//	}
//	$uri .= $_SERVER['HTTP_HOST'];
//	header('Location: '.$uri.'/dashboard/');
//	exit;
header('Location: src/pages/authorization.html');

require($_SERVER['DOCUMENT_ROOT'] . '/header.php');

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$response = $amoApi->authorization($login, $hash);
dump($response);

//$leads['add'] = [
//    [
//        'name' => 'Сделка по карандашам',
//        'created_at' => 1298904164,
//        'status_id' => 142,
//        'sale' => 300000,
//        'responsible_user_id'=>215302,
//        'tags' => 'Important, USA', #Теги
//        'custom_fields' => [
//            [
//                'id' => 427496, #Уникальный индентификатор заполняемого дополнительного поля
//                'values' => [ # id значений передаются в массиве values через запятую
//                    1240665,
//                    1240664
//                ]
//            ],
//            [
//                'id' => 427497, #Уникальный индентификатор заполняемого дополнительного поля
//                'values' => [
//                    [
//                        'value'=>1240667
//                    ]
//                ]
//            ],
//            [
//                'id' => 427231, #Уникальный индентификатор заполняемого дополнительного поля
//                'values' => [
//                    [
//                        'value'=>'14.06.2014' # в качестве разделителя используется точка
//                    ]
//                ]
//            ],
//            [
//                'id' => 458615, #Уникальный индентификатор заполняемого дополнительного поля
//                'values' => [
//                    [
//                        'value' => 'Address line 1',
//                        'subtype' => 'address_line_1',
//                    ],
//                    [
//                        'value' => 'Address line 2',
//                        'subtype' => 'address_line_2',
//                    ],
//                    [
//                        'value' => 'Город',
//                        'subtype' => 'city',
//                    ],
//                    [
//                        'value' => 'Регион',
//                        'subtype' => 'state',
//                    ],
//                    [
//                        'value' => '203',
//                        'subtype' => 'zip',
//                    ],
//                    [
//                        'value' => 'RU',
//                        'subtype' => 'country'
//                    ]
//                ]
//            ]
//        ]
//    ],
//    [
//        'name' => 'Бумага',
//        'created_at' => 1298904164,
//        'status_id' => 7087609,
//        'sale' => 600200,
//        'responsible_user_id' => 215309,
//        'custom_fields' => [
//            [
//                #Нестандартное дополнительное поле типа "мультисписок", которое мы создали
//                'id' => 426106,
//                'values' => [
//                    1237756,
//                    1237758
//                ]
//            ]
//        ]
//    ]
//];
//$companies['add']=array(
//    array(
//        'name' => 'Покупатель',
//        'responsible_user_id' => 504141,
//        'created_by' => 504141,
//        'created_at' => "1509051600",
//        'tags' => "недвижимость,застройка,аренда",
//        'leads_id' => array(
//            "45615",
//            "43510"
//        ),
//        'next_date' => "1508878800",
//        'custom_fields' => array(
//            array(
//                'id' => 4396818,
//                'values' => array(
//                    array(
//                        'value' => "89993456872",
//                        'enum' => "WORK"
//                    ),
//                    array(
//                        'value' => "89998495162",
//                        'enum' => "MOB"
//                    )
//                )
//            ),
//            array(
//                'id' => 4396819,
//                'values' => array(
//                    array(
//                        'value' => "company@company.moc",
//                        'enum' => "WORK"
//                    )
//                )
//            ),
//            array(
//                'id' => 4400115,
//                'values' => array(
//                    array(
//                        'value' => "ул. Октябрьская, д. 2",
//                        'subtype' => "address_line_1"
//                    ),
//                )
//            )
//        )
//    ),
//    array(
//        'name' => 'Второй Покупатель',
//        'responsible_user_id' => 504141,
//        'created_by' => 504141,
//        'created_at' => "1509051600",
//        'tags' => "недвижимость,застройка,аренда",
//        'leads_id' => array(
//            "45615",
//            "43510"
//        ),
//        'next_date' => "1508878800",
//        'custom_fields' => array(
//            array(
//                'id' => 4396818,
//                'values' => array(
//                    array(
//                        'value' => "89993456872",
//                        'enum' => "WORK"
//                    ),
//                    array(
//                        'value' => "89998495162",
//                        'enum' => "MOB"
//                    )
//                )
//            ),
//            array(
//                'id' => 4396819,
//                'values' => array(
//                    array(
//                        'value' => "company@company.moc",
//                        'enum' => "WORK"
//                    )
//                )
//            ),
//            array(
//                'id' => 4400115,
//                'values' => array(
//                    array(
//                        'value' => "ул. Октябрьская, д. 2",
//                        'subtype' => "address_line_1"
//                    ),
//                )
//            )
//        )
//    )
//);

//dump($amoApi->add('customers', $companies));

