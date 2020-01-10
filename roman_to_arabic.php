<?php
    class roman_to_arabic{
            
        public $error = '';
        
        public function conversion($value){ //Início - Conversão de Algarismo Romano p /Indo-Arábico 
            $arRoman = array('I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000); //Array dos Algarismos Romanos

            $strValue = $value; //String do Valor inserido p/ as funções str_split e count

            $arResult = str_split($strValue); //Split no valor inserido p/ separação das casa na array
            $result   = count($arResult); //Count da qtde. de casas da array

            $resultArabic = 0; //Int que receberá os Números Arábicos

            //Variáveis p/ validação dos valores digitados
            $v = 0; //5
            $l = 0; //50
            $d = 0; //500

            $i  = 0; //1
            $x  = 0; //10
            $xb = 0; //10    (2)
            $c  = 0; //100
            $cb = 0; //100   (2)
            $m  = 0; //1.000
            $mb = 0; //1.000 (2)

            //Início - Validação se V, L ou D se repetem mais de 01 vez ou se I ou M se repetem mais de 03 vezes e atribuição aos Contrladores
            for($j = 0; $j < $result; $j++){

                //V, L e D
                if($arResult[$j] == 'V'){
                    $v++;
                } else if($arResult[$j] == 'L'){
                    $l++;
                } else if($arResult[$j] == 'D'){
                    $d++;
                } 

                //I, X, e M
                if($arResult[$j] == 'I'){
                    $i++;
                } else if($arResult[$j] == 'X'){
                    if($arResult[$j - 1] == 'X' || $arResult[$j + 1] == 'X'){
                        $x++;
                    } else{
                        $xb++;
                    }   
                } else if($arResult[$j] == 'C'){
                    if($arResult[$j - 1] == 'C' || $arResult[$j + 1] == 'C'){
                        $c++;
                    } else{
                        $cb++;
                    }   
                } else if($arResult[$j] == 'M'){
                    if($arResult[$j - 1] == 'M' || $arResult[$j + 1] == 'M'){
                        $m++;
                    } else{
                        $mb++;
                    }
                } 
            } //Fim - Atribuição aos Controladores

            if($v > 1 || $l > 1 || $d > 1){ //Início - Validações
                $this->error = 'Algorismo "V", "L" ou "D" digitados mais de 01 vez!';
            } else if($i > 3 || $m > 3){
                $this->error = 'Algorismo "I" digitado mais de 03 vezes seguidas!';
            } else if($x > 3 || $xb > 1){
                $this->error = 'Algorismo "X", digitado mais de 03 no primeiro conjunto ou mais de 01 vez no segundo conjunto de "X"!';
            } else if($c > 3 || $cb > 1){
                $this->error = 'Algorismo "C", digitado mais de 03 no primeiro conjunto ou mais de 01 vez no segundo conjunto de "C"!';
            } else if($m > 3 || $mb > 1){
                $this->error = 'Algorismo "M", digitado mais de 03 no primeiro conjunto ou mais de 01 vez no segundo conjunto de "M"!';
            }//Fim - Validações
            
            for($j = 0; $j < $result; $j++){ //Início - Subtração
                if($arResult[$j] == 'C' && ($arResult[$j + 1] == 'M' || $arResult[$j + 1] == 'D')){
                    $resultArabic = $arRoman[$arResult[$j + 1]] - $arRoman[$arResult[$j]];
                } else if($arResult[$j] == 'X' && ($arResult[$j + 1] == 'C' || $arResult[$j + 1] == 'L')){
                    $resultArabic = $arRoman[$arResult[$j + 1]] - $arRoman[$arResult[$j]];
                } else if($arResult[$j] == 'I' && ($arResult[$j + 1] == 'X' || $arResult[$j + 1] == 'V')){
                    $resultArabic = $arRoman[$arResult[$j + 1]] - $arRoman[$arResult[$j]];
                }
            } //Fim - Subtração

            for($j = 0; $j < $result; $j++){ //Início - Soma
                if($arRoman[$arResult[$j]] >= $arRoman[$arResult[$j + 1]]){
                    $resultArabic += $arRoman[$arResult[$j]]; 

                } else if(empty($arRoman[$arResult[$j + 1]])){
                    $resultArabic += $arRoman[$arResult[$j]];

                } else {
                    $resultArabic -= $arRoman[$arResult[$j + 1]];
                }
            } //Fim - Soma

            return $resultArabic;
        } //Fim - Conversão de Algarismo Romano p /Indo-Arábico 
        
        public function validation(){ //Início - Tranamento de Erros
            
            return $this->error;
        } //Fim - Tranamento de Erros
    }
?>