<?php

namespace AndersonTeala\ValidatePhone;

class ValidatePhone{

  public function validate($phone)
  {

    if(intval($phone['ddd']) == 0 || intval($phone['phone']) == 0) {
      $result = ['phone_number' => '0', 'type' => 'Invalid'];
    }

    $phone['ddd'] = trim(str_replace(['(',')','/',':',';',',','-','#',' '], '',  $phone['ddd']));
    $phone['phone'] = trim(str_replace(['(',')','/',':',';',',','-','#',' '], '',  $phone['phone']));

    $slimNumber = intval($phone['ddd']) . intval($phone['phone']);

    $type = '';

    $regexFixed = "/^[1-9]{2}[2-5]{1}[0-9]{7}$/";
    $regexMobile7 = "/^[1-9]{2}[6-9]{1}[0-9]{7}$/";
    $regexMobile = "/^[1-9]{2}9[0-9]{8}$/";

    $result = ['phone_number' => $slimNumber];

    if(preg_match($regexMobile, $slimNumber)){

      $type = 'Mobile';

    }elseif(preg_match($regexMobile7, $slimNumber)){

      $type = 'Mobile';
      $result['phone_number'] = $phone['ddd'] . '9' . $phone['phone'];

    }else{

      if(preg_match($regexFixed, $slimNumber)){

        $type = 'Fixed';

      }else{

        $type = 'Invalid';

      }

    }

    $codList = [
      'Distrito Federal' => ['61'],
      'Goiás' => ['62', '64'],
      'Mato Grosso' => ['65', '66'],
      'Mato Grosso do Sul' => ['67'],
      'Alagoas' => ['82'],
      'Bahia' => ['71', '73', '74', '75', '77'],
      'Ceará' => ['85', '88'],
      'Maranhão' => ['98', '99'],
      'Paraíba' => ['83'],
      'Pernambuco' => ['81', '87'],
      'Piauí' => ['86', '89'],
      'Rio Grande do Norte' => ['84'],
      'Sergipe' => ['79'],
      'Acre' => ['68'],
      'Amapá' => ['96'],
      'Amazonas' => ['92', '97'],
      'Pará' => ['91', '93', '94'],
      'Rondônia' => ['69'],
      'Roraima' => ['95'],
      'Tocantins' => ['63'],
      'Espírito Santo' => ['27', '28'],
      'Minas Gerais' => ['31', '32', '33', '34', '35', '37', '38'],
      'Rio de Janeiro' => ['21', '22', '24'],
      'São Paulo' => ['11', '12', '13', '14', '15', '16', '17', '18', '19'],
      'Paraná' => ['41', '42', '43', '44', '45', '46'],
      'Rio Grande do Sul' => ['51', '53', '54', '55'],
      'Santa Catarina' => ['47', '48', '49'],
    ];

    foreach ($codList as $key => $value) {

      $tt = array_search($phone['ddd'], $value);

      if($phone['ddd'] === $value[$tt]){
        $result['state'] = $key;
        break;
      }else{
        $result['state'] = 'Not found';
      }

    }

    $result['type'] = $type;

    return $result;

  }

}