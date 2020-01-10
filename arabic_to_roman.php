<?php
    class arabic_to_roman{
            
        public function conversion($value){ //Início - Conversão de Indo-Arábico p/ Algarismo Romano

            $arUnidade = array(0    => '',  1    => 'I',  2    => 'II',  3   => 'III', 4   => 'IV', 5   => 'V',  6   => 'VI',  7   => 'VII',  8   => 'VIII', 9 => 'IX'); //Array das Unidades
            $arDezena  = array(10   => 'X', 20   => 'XX', 30   => 'XXX', 40  => 'XL',  50  => 'L',  60  => 'LX', 70  => 'LXX', 80  => 'LXXX', 90  => 'XC'); //Array das Dezenas
            $arCentena = array(100  => 'C', 200  => 'CC', 300  => 'CCC', 400 => 'CD',  500 => 'D',  600 => 'DC', 700 => 'DCC', 800 => 'DCCC', 900 => 'CM'); //Array das Centenas
            $arMilhar  = array(1000 => 'M', 2000 => 'MM', 3000 => 'MMM'); //Array dos Milhares

            $strValue = $value; //String do Valor inserido p/ as funções str_split e count
            $intValue = $value; //Valor inteiro p/ conversão

            $resultRoman = ''; //String que receberá os Números Romanos

            $arResult = str_split($strValue); //Split no valor inserido p/ separação das casa na array
            $result = count($arResult); //Count da qtde. de casas da array

            $resD = 0; //Resultado das Dezenas
            $resC = 0; //Resultado das Centenas
            $resU = 0; //Resultado das Unidades

            if($result == 1){ //Unidades

                if(array_key_exists($intValue, $arUnidade)){
                    $resultRoman = $arUnidade[$intValue];
                }

            } else if ($result == 2){ //Dezenas

                if(array_key_exists($intValue, $arDezena)){
                    $resultRoman = $arDezena[$intValue];
                } else {
                    foreach($arDezena as $key => $value){
                        $res = $intValue - $key;

                        if($res > 0 && $res < 10){
                            $resultRoman  = $value;
                            $resultRoman .= $arUnidade[$res]; 
                        }
                    } 
                }  

            } else if ($result == 3){ //Centenas

                if(array_key_exists($intValue, $arCentena)){
                    $resultRoman = $arCentena[$intValue];

                } else {

                    foreach($arCentena as $key => $value){
                        $res = $intValue - $key;

                        if($res > 0 && $res < 100){
                            $resD = $res;
                            $resultRoman = $value;                   
                        }
                    }

                    foreach($arDezena as $key => $value){
                        $res = $resD - $key;

                        if($res > 0 && $res < 10){
                            $resultRoman .= $value;
                            $resultRoman .= $arUnidade[$res]; 
                        }
                    }

                    if(array_key_exists($resD, $arUnidade)){
                        $resultRoman .= $arUnidade[$resD];
                    } else {
                        $resultRoman .= $arDezena[$resD];
                    }
                }
            } else if ($result == 4){ //Milhares

                if(array_key_exists($intValue, $arMilhar)){
                    $resultRoman = $arMilhar[$intValue];

                } else {

                    foreach($arMilhar as $key => $value){
                        $res = $intValue - $key;

                        if($res > 0 && $res < 1000){
                            $resC = $res;
                            $resultRoman = $value;
                        }
                    }

                    foreach($arCentena as $key => $value){
                        $res = $resC - $key;

                        if($res > 0 && $res < 100){

                            $resD = $res;
                            $resultRoman .= $value;
                            $resC = $resD;

                        } else if($resC > 0 && $resC < 10){
                            $resU = $resC;
                        } else if($resD > 0 && $resD < 10){
                            $resU = $resD;
                        } else{
                            $resD = $resC;
                        }
                    }

                    foreach($arDezena as $key => $value){
                        $res = $resD - $key;

                        if($res > 0 && $res < 10){
                            $resultRoman .= $value;
                            $resultRoman .= $arUnidade[$res]; 
                        } else if($resD > 0 && $resD < 10){
                            $resU = $resD;
                        }
                    }

                    if(array_key_exists($resC, $arCentena)){
                        $resultRoman .= $arCentena[$resC];
                    } if(array_key_exists($resD, $arDezena)){
                        $resultRoman .= $arDezena[$resD];
                    } else {
                        $resultRoman .= $arUnidade[$resU];
                    } 
                }
            }
            
            return $resultRoman;
        } //Fim - Conversão de Indo-Arábico p/ Algarismo Romano
        
        public function validation($value){ //Início - Tranamento de Erros
            if($value < 1 || $value > 3999){ //Validação do valor do Algarismo Arábico Inserido
                $error = "Favor inserir Algarismos Arábicos de 1 à 3999";
            }
            
            return $error;
        } //Fim - Tranamento de Erros
    }
?>