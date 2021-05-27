<?php
//Essa função gera um valor de String aleatório do tamanho recebendo por parametros
function geraString($size){
	//String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
	$basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	$return= "";

	for($count= 0; $size > $count; $count++){
		//Gera um caracter aleatorio
		$return.= $basic[rand(0, strlen($basic) - 1)];
	}

	return $return;
}



/*	
	FUNÇÃO:			inverteData
					Inverte o formato da data
	PARÂMETROS:		var
	RETORNO:		data formatada em dd/mm/aaaa ou YYYY-mm-dd
*/
function inverteData($date)
{
    if (count(explode("/",$date)) > 1){
        toDateUs($date);
    }
    if (count(explode("-",$date)) > 1){
        toDateBr($date);
    }
    return $date;
}

//	Formata data dd/mm/YYYY
function toDateBr(&$date) {
    if (strtotime($date)) {
        $date= date("d/m/Y", strtotime($date));
    }
}

//	Formata data YYYY-mm-dd
function toDateUs(&$date) {
	if (strtotime($date)) {
        $date= date("Y-m-d", strtotime($date));
    }
}


/*	
	FUNÇÃO:			formataData
					Formata a data para o formato desejado
	PARÂMETROS:		data, formato
	RETORNO:		data formatada
*/
function formataData($data, $formato){
	
	switch($formato){
		case "dd/mm/aaaa": $data= date('d/m/Y', strtotime($data)); break;
		case "dd/mm/aaaa hh:mm:ss": $data= date('d/m/Y H:i:s', strtotime($data)); break;
		case "dd/mm/aaaa hh:mm": $data= date('d/m/Y H:i', strtotime($data)); break;
		case "dd/mm": $data= date('d/m', strtotime($data)); break;
		
		case "aaaa": $data= date('Y', strtotime($data)); break;
		case "aaaa-mm-dd": $data= date('Y-m-d', strtotime($data)); break;
		
		case "hh:mm:ss": $data= date('H:i:s', strtotime($data)); break;
		case "hh:mm": $data= date('H:i', strtotime($data)); break;
		case "aaaa-mm-dd": $data= date('Y-m-d', strtotime($data)); break;
	}
	return $data;

}


/*	
	FUNÇÃO:			show
					Mostra os atributos e valores da variável
	PARÂMETROS:		var
	RETORNO:		lista os atributos da variável
*/
function show($var)
{
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
/*
	Função:			process_time
	Parâmetros:	null
	Retorno:		tempo
	Descrição:	retorna o tempo em microsegundos 
							com a função microtime()
							para calcular o processamento
*/
function process_time()
{
	return microtime();
}
/*
	Função:			encrypta
	Parâmetros:	texto
	Retorno:		texto criptografado
	Descrição:	retorna o texto criptografado por base64
*/
function encrypta($texto)
{

	return base64_encode($texto);
	
}
/*
	Função:			decrypta
	Parâmetros:	texto
	Retorno:		texto descriptografado
	Descrição:	retorna o texto descriptografado por base64
*/
function decrypta($texto)
{

	return base64_decode($texto);
	
}
/*	
	Função:			clearSpecialChars
	Parâmetros:	string
	Retorno:		string
	Descrição:	remove todos os caractéres especiais da string
*/
function clearSpecialChars($str) {

	$str=utf8_encode($str);

	$clear_array = array("&" => "e");
	$clear_array = array(
						"á" => "a" , "é" => "e" , "í" => "i" , "ó" => "o" , "ú" => "u"
						, "à" => "a" , "è" => "e" , "ì" => "i" , "ò" => "o" , "ù" => "ù"
						, "ã" => "a" , "õ" => "o" , "â" => "a" , "ê" => "e" , "î" => "i" , "ô" => "o" , "û" => "u"
						
						//, "," => ""  , "!" => "" , "#" => "" , "%" => "", "¬" => "" , "{" => "" , "}" => ""
						, "!" => "" , "#" => "" , "%" => "", "¬" => "" , "{" => "" , "}" => ""
						
						, "^" => ""  , "´" => "" , "`" => "" , "" => "" , "/" => "" , ";" => "" , ":" => "" , "?" => ""
						, "¹" => "1" , "²" => "2" , "³" => "3" , "ª" => "a" , "º" => "o" , "ç" => "c" , "ü" => "u"
						, "ä" => "a" ,"ï" => "i" , "ö" => "o" , "ë" => "e" , "$" => "s" , "ÿ" => "y" , "w" => "w" , "<" => ""
						, ">" => "" ,"[" => "" , "]" => "", "&" => "e"
						, " " => " " , "'" => "" , '"' => ""
						, 'á' => 'a' , 'Á' => 'A' ,  'é' => 'e' , 'É' => 'E' ,  'í' => 'i' , 'Í' => 'i' ,  'ó' => 'o'
						, 'Ó' => 'O' ,  'ú' => 'u' , 'Ú' => 'U' ,  'â' => 'â' , 'â' => 'â' ,  'ê' => 'ê' , 'Ê' => 'â'
						, 'ô' => 'ô' , 'Ô' => 'â' ,  'à' => 'a' , 'À' => 'â' ,  'ç' => 'c' , 'Ç' => 'C' ,  'ã' => 'a'
						, 'Ã' => 'ã' ,  'õ' => 'o' , 'Õ' => 'o'
					);

	foreach($clear_array as $key=>$val) {

		$str = str_replace($key, $val, $str);

	}

	return $str;
}


/*	
	FUNÇÃO:		geraCodigo
				Gera um código único. O time é único a cada segundo, já que retorna o TIMESTAMP atual, ou seja, a cada segundo retorna um a mais.
	PARÂMETROS:	string
	RETORNO:	string
*/
function geraCodigo() {
	return md5(uniqid(rand(), true) );
}



/*	
	FUNÇÃO:			redimensiona_img
					Redimensiona uma imagem sem perder a proporção
	PARÂMETROS:		caminho, $largura
	RETORNO:		void
*/
function redimensiona_img($caminho, $largura) {
	
	#	Separa o nome do arquivo para verificar seu tipo
	$separa = explode("/", mime_content_type($caminho) );
	$separa = array_reverse($separa);
	#	Pegamos o tipo do arquivo
	$tipo = strtolower($separa[0]);
	
	#	Verifica o tipo da imagem
	switch($tipo) {
		case "jpeg": $imagem_orig = ImageCreateFromJPEG($caminho); break;#	Cria uma nova imagem JPEG
		case "jpg":	$imagem_orig = ImageCreateFromJPEG($caminho); break;#	Cria uma nova imagem JPG
		case "gif":	$imagem_orig = ImageCreateFromGIF($caminho); break;#	Cria uma nova imagem GIF
		case "png":	$imagem_orig = ImageCreateFromPNG($caminho); break;#	Cria uma nova imagem PNG
	}//	Fim verifica o tipo da imagem
	
	
	#	Largura / Altura da imagem
	$pontoX = ImagesX($imagem_orig);//Define a largura da imagem de origem
	$pontoY = ImagesY($imagem_orig);//Define a altura da imagem de origem
	$fator = ($pontoY / $pontoX);
	$altura = ($largura * $fator);
	$imagem_fin = ImageCreateTrueColor($largura, $altura);//Cria uma imagem preta com essas medidas
				
	#	Copia a imagem de origem na imagem de destino
	ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura, $altura, $pontoX, $pontoY);
					
	#	Verifica o tipo da imagem
	switch($tipo) {
		case "jpeg": ImageJPEG($imagem_fin, $caminho); break;#	Salva a imagem JPEG
		case "jpg":	ImageJPEG($imagem_fin, $caminho); break;#	Salva a imagem JPG
		case "gif":	ImageGIF($imagem_fin, $caminho); break;#	Salva a imagem GIF
		case "png":	ImagePNG($imagem_fin, $caminho); break;#	Salva a imagem PNG
	}//	Fim verifica o tipo da imagem<strong></strong>
	
	#	Libera a memória
	ImageDestroy($imagem_orig);
	ImageDestroy($imagem_fin);
	
}


function return_bytes($size_str) {
	switch (substr ($size_str, -1) ) {
		case 'M': case 'm': return (int)$size_str * 1048576;
		case 'K': case 'k': return (int)$size_str * 1024;
		case 'G': case 'g': return (int)$size_str * 1073741824;
		default: return $size_str;
	}
}


function getValuesByJson() {
	$json = isset($_REQUEST["json"]) ? json_decode($_REQUEST["json"]) : "";
	$json = isset($_REQUEST["json"]) ? json_decode($json) : "";
	return $json;
}


function logMe($msg){
	$arquivo= "../logs/log.txt";
	$log= "[".date("d/m/Y H:i:s")." - ".$_SERVER["PHP_SELF"]."] ** ".$msg."\r\n";
	$fp = file_put_contents($arquivo, $log, FILE_APPEND);
}
?>