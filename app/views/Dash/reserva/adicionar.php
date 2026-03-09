<form method="POST" action="<?= BASE_URL ?>reserva/adicionar" enctype="multipart/form-data">
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Imagem do Funcionario -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="image-container" style="width: 100%; max-width: 200px; aspect-ratio: 1/1; overflow: hidden; border-radius: 50%; margin: auto;">
                    <img src="<?= BASE_URL ?>assets/img/hero-bg3.png" alt="exfe Logo" class="img-fluid" id="preview-img" style="cursor:pointer; border-radius:12px;">
                </div>
                <input type="file" name="foto_mesa" id="foto_mesa" style="display: none;" accept="image/*">
            </div>

            <!-- Informações da Reserva -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Adicionar Reserva</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="text-uppercase text-sm">Informações da Reserva</p>

                        <div class="row">

                            <!-- Cliente -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_cliente" class="form-control-label">Cliente</label>
                                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                                        <option value="">Selecione um cliente</option>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <option value="<?= $cliente['id_cliente'] ?>">
                                                <?= $cliente['nome_cliente'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Mesa -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_mesa" class="form-control-label">Mesa</label>
                                    <select class="form-control" id="id_mesa" name="id_mesa" required>
                                        <option value="">Selecione uma mesa</option>
                                        <?php foreach ($mesas as $mesa): ?>
                                            <option value="<?= $mesa['id_mesa'] ?>">
                                                Mesa <?= $mesa['numero_mesa'] ?> - Capacidade <?= $mesa['capacidade'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Funcionário -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_funcionario" class="form-control-label">Funcionário</label>
                                    <select class="form-control" id="id_funcionario" name="id_funcionario">
                                        <option value="">Selecione um funcionário</option>
                                        <?php foreach ($funcionarios as $funcionario): ?>
                                            <option value="<?= $funcionario['id_funcionario'] ?>">
                                                <?= $funcionario['nome_funcionario'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Data -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_reserva" class="form-control-label">Data da Reserva</label>
                                    <input class="form-control" type="date" id="data_reserva" name="data_reserva" required>
                                </div>
                            </div>

                            <!-- Hora início -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hora_inicio" class="form-control-label">Hora de Início</label>
                                    <input class="form-control" type="time" id="hora_inicio" name="hora_inicio" required>
                                </div>
                            </div>

                            <!-- Hora fim -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hora_fim" class="form-control-label">Hora de Término</label>
                                    <input class="form-control" type="time" id="hora_fim" name="hora_fim" required>
                                </div>
                            </div>

                            <!-- Observações -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observacoes" class="form-control-label">Observações</label>
                                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Alguma observação sobre a reserva..."></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success btn-sm">Salvar Alterações</button>
                    <button type="reset" class="btn btn-danger btn-sm">Limpar Campos</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Imagem do funcionário
        const visualizarImg = document.getElementById('preview-img');
        const arquivo = document.getElementById('foto_mesa');

        visualizarImg.addEventListener('click', function() {
            arquivo.click();
        });

        arquivo.addEventListener('change', function() {
            if (arquivo.files && arquivo.files[0]) {
                let render = new FileReader();
                render.onload = function(e) {
                    visualizarImg.src = e.target.result;
                };
                render.readAsDataURL(arquivo.files[0]);
            }
        });
    });
</script>