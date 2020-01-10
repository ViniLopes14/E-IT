<?php
    include('arabic_to_roman.php');
    include('roman_to_arabic.php');

    $arabicToRoman = new arabic_to_roman();
    $romanToArabic = new roman_to_arabic();

    $error      = ''; //Controlador dos Erros
    $result     = ''; //Reultado do retorno das Funções de Conversão
    $to_convert = ''; //Valor do Radio Button

  if(isset($_POST['submit'])){ //Validação do Submit
      $value      = $_POST['num'];
      $to_convert = $_POST['toConvert'];
      
    if (empty($value)){ //Validação se existe valor inserido
      $error = 'Favor inserir um valor!';
    } else {
        if($to_convert == 'toRoman'){ //Validação de qual Radio Button está selecionado p/ a Chamada das Funções
            $result = $arabicToRoman->conversion($value);
            $error  = $arabicToRoman->validation($value);
            
        } else {
            $result = $romanToArabic->conversion(strtoupper($value));
            $error  = $romanToArabic->validation();
        }
    }
  }
?>

<html>
    <read>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Conversão de Algarismos</title>  
    </read>

    <body style="text-align: center; margin: auto; width: 1000px; padding: 20px;">
        <fieldset style="border: 3px solid black;">
            
            <h1>Indo-Arábicos / Algarismos Romanos</h1>
            <h4>* Inserir Algarismos Arábicos de 1 à 3999<br />
                * Inserir Algarismos Romanos de I à MMMCMXCIX</h4>
            <hr style="border: 1px solid black">

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <br /><input type="radio" name="toConvert" value="toRoman" id="convertToRoman" <?php if($to_convert == 'toRoman' || $to_convert == '') { echo 'checked'; } ?> />
                <label for="convertToRoman">Indo-Arábico para Algarismo Romano</label> 
                <input type="radio" name="toConvert" value="toArabic" id="convertToArabic" <?php if($to_convert == 'toArabic') { echo 'checked'; } ?> />
                <label for="convertToArabic">Algarismo Romano para Indo-Arábico</label> <br /><br />

                <label for="num">Número: </label>
                <input type="text" name="num" id="num" value="<?php echo $value; ?>" />
                <input type="submit" name="submit" value="Converter" style="border:1px solid #25692A; border-radius:4px; display:inline-block; cursor:pointer; font-weight:bold; font-size:13px; padding:6px 10px; text-decoration:none;" /> <br /><br />

                <label for="result">Resultado da Conversão: </label>
                <input type="text" value="<?php if($error == ''){ echo $result; } ?>" id="result" onfocus="true" disabled />
            </form>

            <?php if($error <> ''){ ?> 
                    <hr style="border: 1px solid black">
                    <p style="color: red;">
            <?php       echo '<br /><br /> * ERRO: ' . $error; } ?>
                    </p>
            
        </fieldset>
    </body>
</html>