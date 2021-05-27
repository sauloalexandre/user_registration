<?php
#	Inicializa a sessão
session_start();
ob_start();


#	Cabeçalho
header("Content-Type: text/html;  charset=utf-8",true);



#	Exibe as mensagens de erro
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Brazil/East');



#	Autoload classes
function __autoload($class){ require_once("../model/".$class.".class.php"); }//	Fim autoload
include_once("comom.php");#	Controle

function erroLogin()
{
	$_SESSION["erro_login"]["qtd_tentativas"]= (!isset($_SESSION["erro_login"]) ) ? 1 : $_SESSION["erro_login"]["qtd_tentativas"]+1;
	$_SESSION["erro_login"]["mensagem"]= "<strong>E-mail ou senha inválidos.</strong>";
	$_SESSION["erro_login"]["mensagem"].="<br>Tentativa ".$_SESSION["erro_login"]["qtd_tentativas"];
	$_SESSION["erro_login"]["mensagem"].="<br>Verifique as informações fornecidas e tente novamente!";
}

function gravaCookies()
{
	global $U;
	$expira = time() + (60*60*24*3);//	3 dias
	setCookie('CookieLembrete', encrypta('SIM'), $expira, '/');
	setCookie('CookieEmail', encrypta($U->get("email") ), $expira, '/');
	setCookie('CookieSenha', encrypta($U->get("senha") ), $expira, '/');
	show($U);
}

#	Act
if(isset($_REQUEST["act"]) ){

	#	Objetos
	$U=	new Usuario();

	#	Escolhe a act
	switch($_REQUEST["act"]){
		
		
		/**		passwordReset		*/
		case "passwordReset":
			//	parâmetros
			$param["id"] = $_REQUEST["id"];
			//	carrega o objeto
			$Obj = $U->getUsuarios($param);
			$U = $Obj[0];
			//	altera o valor dos atributos
			$U->set("senha", encrypta($U->get("email") ) );
			//	update
			$U->update();
			$U->afterPasswordReset();
			break;
		
		
		/**		passwordUpdate		*/
		case "passwordUpdate":
			//	parâmetros
			$json = getValuesByJson();
			$param["id"] = $json->id;
			//	carrega o objeto
			$Obj = $U->getUsuarios($param);
			$U = $Obj[0];
			//	altera o valor dos atributos
			$U->set("senha", encrypta($json->senha) );
			//	update
			$U->update();
			$U->afterPasswordUpdate();
			break;
		
		
		/**		update_permissoes		*/
		case "update_permissoes":
			//	trata o jSon
			$json= json_decode($_REQUEST["json"]);
			$json= json_decode($json);
			
			//	parâmetros
			#	Loop atualizando os atributos do array
			foreach($json as $atributo => $valor) {
				$param[$atributo]= $valor;
			}
			#	Update permissões
			$U->update_permissoes($param);
			
			$msg=	'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Permissões atualizadas com sucesso!</strong>
					</div>';
			echo $msg;
			break;
		
			
		/**		clone		*/
		case "clone":
			//	parâmetros
			$param["id"]= $_REQUEST["id"];
			//	carrega o objeto
			$Obj= $U->getUsuarios($param);
			$U = $Obj[0];
			//	add
			$U->add();
			$U->afterClone();
			break;
		
		
		/**		activate		*/
		case "activate":
			//	parâmetros
			$param["id"]= $_REQUEST["id"];
			//	carrega o objeto
			$Obj = $U->getUsuarios($param);
			$U = $Obj[0];
			//	altera o valor dos atributos
			$param["flag_ativo"] = ($_REQUEST["activate"] == "ON") ? 1 : 0;
			$param["flag_status"] = ($_REQUEST["activate"] == "ON") ? "Ativo" : "Inativo";
			$U->set("flag_ativo", $param["flag_ativo"]);
			$U->set("flag_status", $param["flag_status"]);
			//	add
			$U->update();
			$U->afterActivate();
			break;
		
		
		/**		add		*/
		case "add":
			$U->beforeSave();
			$U->add();
			$U->afterSave();
			break;
		
			
		/**		update		*/
		case "update":
			$U->beforeSave();
			$U->update();
			$U->afterSave();
			break;


		/**		delete		*/
		case "delete":
			$U->set("id", $_REQUEST["id"]);
			$U->delete();
			$U->afterDelete();
			break;
		
		
		/**		upload	*/
		case "upload":
			//	Cria as pastas
			$diretorio = "../upload/".strtolower(get_class($U))."s";
			$diretorio_miniatura = "../upload/".strtolower(get_class($U))."s/miniatura";
			//Verifica se as pasta já existem ou tenta cria-las
			$checarPasta = is_dir($diretorio) ? true : mkdir($diretorio, 0777);
			$checarPasta_miniatura = is_dir($diretorio_miniatura) ? true : mkdir($diretorio_miniatura, 0777);
			//Se não existir exibe um erro
			if(!$checarPasta || !$checarPasta_miniatura) {
				dir('Não pode criar ou acessar as pastas: ', $diretorio, " e ", $diretorio_miniatura);
			}
			
			#	Parâmetros
			$param["id"]=	($_REQUEST["id"] != "") ? $_REQUEST["id"] : geraCodigo();

			//	prepara retorno
			$retorno=	'<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Arquivo não selecionado!</strong>
						</div>';
			
			#	Se o tamanho da imagem excede o tamanho máximo permitido, então mostra mensagem informando
			$tamanho= filesize($_FILES['foto_arquivo']['tmp_name']);
			if($tamanho > return_bytes(ini_get('upload_max_filesize') ) || $tamanho > return_bytes(ini_get('post_max_size') ) ) {
				
				$retorno=	'<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Imagem excede o tamanho máximo permitido!</strong>
							</div>';

			} else {#	Senão, tenta fazer o upload
			
				#	Se foi passada alguma foto, faz o upload
				if (!empty($_FILES['foto_arquivo']['tmp_name']) ) {

					//	prepara retorno
					$retorno=	'<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>Arquivo inválido!</strong>
								</div>';

					#	Separa o nome do arquivo para verificar seu tipo
					$temp=	explode(".", $_FILES['foto_arquivo']['name']);
					$temp=	array_reverse($temp);

					#	Pegamos o tipo do arquivo e verificamos se é válido
					$tipo = strtolower($temp[0]);

					#	Array com tipos de arquivos permitidos
					$tipos_permitidos=	array('jpeg', 'jpg', 'gif', 'png');

					#	Se o arquivo é de um tipo permitido faz o upload
					if (in_array($tipo, $tipos_permitidos) ) {

						#	Gera código para nome do arquivo
						//$arquivo=	geraCodigo().".".$tipo;
						
						#	Gera nome do arquivo utilizando o id do usuário
						$arquivo=	strtolower(get_class($U))."_".$param["id"]."_foto.".$tipo;

						#	Upload foto
						$caminho=	$diretorio."/".$arquivo;
						move_uploaded_file($_FILES['foto_arquivo']['tmp_name'], $caminho);

						#	Miniatura
						$caminho_miniatura=	$diretorio_miniatura."/".$arquivo;
						copy($caminho, $caminho_miniatura);

						#	Redimensiona a imagem proporcionalmente de acordo com a largura informada
						redimensiona_img($caminho, 680);
						redimensiona_img($caminho_miniatura, 120);

						$param[0]["foto"]=	$arquivo;

						//	retorna a imagem
						$retorno= '<img src="'.substr($diretorio_miniatura, 3).'/'.$arquivo.'?nocache='.rand(1,100).'" />';
						$retorno.='<script>document.getElementById("foto").value="'.$arquivo.'";</script>';
						unset($arquivo);

					}//fim arquivo válido

				}//	Fim upload
			
			}//fim tamanho dentro do permitido
			echo $retorno;
			break;
			
			
	}//	Fim switch
	
	
	unset($U);
	
	
}//	Fim Act
?>