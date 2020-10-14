<h1>Lista de Funcionarios</h1>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<ul class="list-group">
    <?php
    foreach ($this->Dados['funcionarios'] as $funcs) {
        extract($funcs);
        ?>
        <div class="row">
            <div class="col-md-12">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo URL . 'assets/imagens/funcionario/' . $id . '/' . $foto ?>" alt="..." class="img-thumbnail" style="border-radius: 50%; height: 80px;width: 100px;">
                        </div>
                        <div class="col-md-2">
                            <p><label><strong>Nome: </strong></label><?php echo $nome; ?></p>
                        </div>
                        <div class="col-md-2">
                            <p><label><strong>CPF: </strong></label><?php echo $cpf; ?></p>
                            <p><label><strong>RG: </strong></label><?php echo $rg; ?></p>
                        </div>
                        <div class="col-md-2">
                            <p><label><strong>Nascimento: </strong></label><?php echo date("d/m/Y", strtotime($data_nascimento)); ?></p>
                            <p><label><strong>Cargo: </strong></label><?php echo $cargo; ?></p>
                        </div>
                        <div class="col-md-3">
                            <p><label><strong>Email: </strong></label><?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($status == 1) {
                                echo '<span class="badge badge-success">Ativo</span>';
                            } else {
                                echo '<span class="badge badge-danger">Inativo</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="page-header"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo URL; ?>view-funcionario/<?php echo $id; ?>" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Visualisar
                            </a>
                            <a href="<?php echo URL; ?>edit-funcionario/<?php echo $id; ?>" class="btn btn-outline-warning">
                                <i class="fa fa-pencil"></i> editar
                            </a>
                            <a href="<?php echo URL; ?>delete-funcionario/<?php echo $id; ?>" class="btn btn-outline-danger" onclick="if (!confirm('tem certeza que deseja excluir este item?')) {
                                        return false
                                    }">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </div>
                    </div>
                </li>
            </div>
        </div>
        <?php
    }
    ?>

</ul>