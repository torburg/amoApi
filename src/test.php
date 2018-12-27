<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/api/AmoApi.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/helpers.php');

use Amo\Api\AmoApi;


$n = 1;

$api = new AmoApi();
$entities = [
    'contacts',
    'companies',
    'leads',
    'customers'
];
$data = [];
foreach ($entities as $entity) {
    for ($i = 0; $i < $n; $i++) {

        //entities for adding them to current entity
        $entities_to_add = $entities;
        $entities_to_add = array_diff($entities_to_add, [$entity]);

        //if entity isn't company changing 'companies' to 'company' to add company_id
        if (array_search('companies', $entities_to_add)) {
            $entities_to_add[array_search('companies', $entities_to_add)] = 'company';
        }

        //leads and customers isn't connect
        if ($entity == 'leads') {
            $entities_to_add = array_diff($entities_to_add, ['customers']);
        }
        if ($entity == 'customers') {
            $entities_to_add = array_diff($entities_to_add, ['leads']);
        }

        $fields_to_add = [];
        $fields_to_add['name'] = $entity . $i;
        foreach ($entities_to_add as $entity_to_add) {
             $fields_to_add["{$entity_to_add}_id"] = "$entity_to_add" . $i;
        }
        $data[$entity]['add'][] = $fields_to_add;
    }
}

$contacts['add']= [
    [
        'name' => 'Александр Крылов',
        'responsible_user_id' => 504141,
        'created_by' => 504141,
        'created_at' => "1509051600",
        'tags' => "важный,доставка",
        'leads_id' => [
            "45615",
            "43510"
        ],
        'company_id' => 30615,
   ]
];
$link = 'https://' . 'mfilippov' . '.amocrm.ru/api/v2/companies';


//$api->add('contacts', $contacts);


$companies['add']=array(
    array(
        'name' => 'ООО Компания',
        'responsible_user_id' => 504141,
        'created_by' => 504141,
        'created_at' => "1509051600",
        'tags' => "недвижимость,застройка,аренда",
        'leads_id' => array(
            "45615",
            "43510"
        ),
        'custom_fields' => array(
            array(
                'id' => 4396818,
                'values' => array(
                    array(
                        'value' => "89993456872",
                        'enum' => "WORK"
                    ),
                    array(
                        'value' => "89998495162",
                        'enum' => "MOB"
                    )
                )
            ),
            array(
                'id' => 4396819,
                'values' => array(
                    array(
                        'value' => "company@company.moc",
                        'enum' => "WORK"
                    )
                )
            ),
            array(
                'id' => 4400115,
                'values' => array(
                    array(
                        'value' => "ул. Октябрьская, д. 2",
                        'subtype' => "address_line_1"
                    ),
                )
            )
       )
    )
);

    $curl=curl_init(); #Сохраняем дескриптор сеанса cURL
    #Устанавливаем необходимые опции для сеанса cURL
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
    curl_setopt($curl,CURLOPT_URL,$link);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($companies));
    curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
    $out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
    /* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
    $code=(int)$code;
    $errors=array(
        301=>'Moved permanently',
        400=>'Bad request',
        401=>'Unauthorized',
        403=>'Forbidden',
        404=>'Not found',
        500=>'Internal server error',
        502=>'Bad gateway',
        503=>'Service unavailable'
    );
    try
    {
        #Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
        if($code!=200 && $code!=204)
            throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
    }
    catch(Exception $E)
    {
        die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
    }
    /*
     Данные получаем в формате JSON, поэтому, для получения читаемых данных,
     нам придётся перевести ответ в формат, понятный PHP
     */
    $Response=json_decode($out,true);
    $Response=$Response['_embedded']['items'];
    $output='ID добавленных контактов:'.PHP_EOL;
    foreach($Response as $v)
     if(is_array($v))
       $output.=$v['id'].PHP_EOL;
    dump($output);


die;

foreach ($entities as $entity) {
    dump($entities);
    dump($entity);
    dump($data[$entity]);
    die();
    $api->add($entity, $data[$entity]);
}



