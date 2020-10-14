<h1>Lista de Funcionarios</h1>
 <ul class="list-group">
 	<?php
 	foreach ($this->Dados['funcionarios'] as $funcs) {
 		extract($funcs);
 		?>
 		<div class="row">
			<li class="list-group-item">
				<div class="col-md-3">
					<label>Nome:&nbsp;</label><?php echo $nome; ?>
				</div>
			</li>
		</div>
 		<?php
 	}
 	?>
  
</ul>