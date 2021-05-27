<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("../model/".$class.".class.php"); }
#	Controle
include_once("../control/comom.php");

//sleep(1);
#	Objeto
$U= new Usuario();


#	Parâmetros
$param["qtd"]= 0;
$param["empresa_id"]= 1;
//show($_REQUEST);
$lista= $U->getUsuarios($param);
//show($lista);
//die();
$param["qtd"]= isset($lista) ? count($lista) : 0;
?>



<!--	Panel	-->
<div class="panel panel-info text-left">
	<div class="panel-heading">
		<h3 class="panel-title">Lista <?php echo get_class($U); ?>s</h3>
	</div>
	
	<!--	Msg	-->
	<div id="retorno" class="text-center">
		<?php 
		if(isset($_REQUEST["retorno"]) ) {//	Se há retorno

			switch($_REQUEST["retorno"]) {//	escolhe o tipo de retorno

				case "ok" :
					$msg=	'<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>'.$_REQUEST["msg"].'</strong>
								</div>';
					echo $msg;
					break;

				case "erro" :
					$msg=	'<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<strong>'.$_REQUEST["msg"].'</strong>
								</div>';
					echo $msg;
					break;

			}//fim escolhe o retorno

		}//fim há retorno
		?>
	</div>
	
	
	<table class="table table-hover table-striped">
		
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefones</th>
				<th>Qtd acessos</th>
				<th>Data último acesso</th>
				<th>Ativo</th>
				<th class="col-md-1">
					<button type="button" class="btn btn-default btn-block" onclick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=add', '');">Add</button>
				</th>
			</tr>
		</thead>
		
		<tfoot>
			<tr class="text-center">
				<td colspan="8"><span class="badge badge-default"><?php echo $param["qtd"]." ".get_class($U)."s"; ?></span></td>
			</tr>
		</tfoot>
		
		<tbody>
			<?php for($i=0; $i<$param["qtd"]; $i++){#	Loop ?>
				<tr>
					<td>
						<?php echo $lista[$i]->get("id"); ?>
						<br>(<?php echo $lista[$i]->get("empresa_id"); ?>)
					</td>
					<td><?php echo $lista[$i]->get("nome"); ?></td>
					<td><?php echo $lista[$i]->get("email"); ?></td>
					<td>
						<?php echo $lista[$i]->get("telefone"); ?>
						<br><?php echo $lista[$i]->get("telefone2"); ?>
						<br><?php echo $lista[$i]->get("celular"); ?>
					</td>
					<td class="text-center"><?php echo $lista[$i]->get("qtd_acessos"); ?></td>
					<td><?php echo formataData($lista[$i]->get("data_ultimo_acesso"), "dd/mm/aaaa hh:mm" ); ?></td>
					<td><?php echo ($lista[$i]->get("flag_ativo") == 1) ? "Ativo" : "Inativo"; ?></td>
					<td>
						
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ações<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
							
								<li><a href="#" onclick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_detalhes.php?id=<?php echo $lista[$i]->get("id"); ?>', '');">Exibir detalhes</a></li>
								
                                <li><a href="#" onclick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=update&id=<?php echo $lista[$i]->get("id"); ?>', '');">Editar</a></li>
								
                                <li class="divider"></li>
								
								<li><a href="#" onclick="postPage('control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=passwordReset&id=<?php echo $lista[$i]->get("id"); ?>', '');">Resetar Senha</a></li>
								
                                <li><a href="#" onclick="postPage('control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=clone&id=<?php echo $lista[$i]->get("id"); ?>', '');">Duplicar</a></li>
								
                                <?php if($lista[$i]->get("flag_ativo") == 1) {#	Se cliente está Ativo, permite Inativar ?>
								
									<li><a href="#" onclick="postPage('control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=activate&activate=OFF&id=<?php echo $lista[$i]->get("id"); ?>', '');">Inativar</a></li>
									
								<?php } else {//	Senão, permite re-ativar ?>
									
									<li><a href="#" onclick="postPage('control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=activate&activate=ON&id=<?php echo $lista[$i]->get("id"); ?>', '');">Ativar</a></li>
									
								<?php }//fim reativar ?>
								<li class="divider"></li>
								
								<li><a href="#" onclick="postPage('control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=delete&id=<?php echo $lista[$i]->get("id"); ?>', '');">Excluir</a></li>
								
							</ul>
						</div>
						
					</td>
				</tr>
			<?php }//fim loop ?>
		</tbody>
		
	</table>
	
</div><!--	fim Panel	-->