<?php

class Insurance
{
    public function quote($providers = ['bank', 'insurance-company'])
    {
        $quote = array();
        $baseUrl = 'http://demo9084693.mockable.io/';
        $curl = curl_init();
        for ($i = 0; $i < count($providers); $i++) {
            $prices = 0; 
                try {
                    switch ($providers[$i]) {
                        case 'bank':
                            
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $baseUrl. 'bank',
                            ));

                            $prices         = curl_exec($curl);
                            $errno          = curl_errno($curl);
                            $error          = curl_error($curl);
                
                            $info = curl_getinfo($curl);

                            if ($errno || $info['http_code'] != 200 || $error) {

                                $error_msg = curl_error($curl);
                                $prices = 0;
                                echo $error_msg;
                                echo "status code" . $info['http_code'];
                            }
                            break;
                            
    
                        case 'insurance-company':
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $baseUrl. 'insurance',
                                CURLOPT_POST => 1,
                                CURLOPT_POSTFIELDS => array(
                                    'month' => 3,
                                )
                            ));
                            
                            $prices         = curl_exec($curl);
                            $errno          = curl_errno($curl);
                            $error          = curl_error($curl);
                
                            $info = curl_getinfo($curl);
                            if ($errno || $info['http_code'] != 200 || $error) {

                                $error_msg = curl_error($curl);
                                $prices = 0;
                                echo $error_msg;
                                echo "status code" . $info['http_code'];
                            }
                            else
                            {
                                $prices = json_decode($prices);
                            }
                        break;
                    }
                } catch (Exception $e) {  
                 echo "error=>" . $e->message;
                }  
                $quote[$providers[$i]] = $prices;
                
        }
        curl_close($curl);
        return $quote;
    }
}

$insurance = new Insurance();
$quote = $insurance->quote();

var_dump($quote);
