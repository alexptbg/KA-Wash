<?php
function country($code){
    $country = '';
    if($code == 'bg') $country = 'Български';
    if($code == 'en') $country = 'English';
    if($country == '') $country = $code;
    return $country;
}
?>