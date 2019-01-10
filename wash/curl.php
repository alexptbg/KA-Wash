<?php
$pump = "1";
$quantity = "10000";
                $curl = curl_init();
                curl_setopt_array($curl,array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://localhost/sys/wash/index.php?z=1&q=10000',
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));
                $resp = curl_exec($curl);
print_r($resp);
                curl_close($curl);
?>
