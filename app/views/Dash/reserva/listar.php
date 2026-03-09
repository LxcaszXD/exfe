<div class="container my-5">
    <h2 class="text-center fw-bold py-3" style="background: #5e3c2d; color: white; border-radius: 12px;">
        Lista de Reservas
    </h2>

    <div class="table-responsive rounded-3 shadow-lg p-3 bg-white">
        <table class="table table-hover text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Mesa</th>
                    <th>Funcionário</th>
                    <th>Data</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Observações</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr id="reserva_<?= $reserva['id_reserva'] ?>">
                        <td><?= $reserva['id_reserva'] ?></td>
                        <td><?= htmlspecialchars($reserva['nome_cliente']) ?></td>
                        <td><?= htmlspecialchars($reserva['id_mesa']) ?></td>
                        <td><?= htmlspecialchars($reserva['nome_funcionario']) ?></td>
                        <td><?= date('d/m/Y', strtotime($reserva['data_reserva'])) ?></td>
                        <td><?= substr($reserva['hora_inicio'], 0, 5) ?></td>
                        <td><?= substr($reserva['hora_fim'], 0, 5) ?></td>
                        <td><?= htmlspecialchars($reserva['observacoes']) ?></td>
                        <td>
                            <select onchange="alterarStatusReserva(<?= $reserva['id_reserva'] ?>, this.value)" class="form-select">
                                <option value="Pendente" <?= $reserva['status_reserva'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                                <option value="Confirmada" <?= $reserva['status_reserva'] === 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
                                <option value="Cancelada" <?= $reserva['status_reserva'] === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
                                <option value="Finalizada" <?= $reserva['status_reserva'] === 'Finalizada' ? 'selected' : '' ?>>Finalizada</option>
                            </select>
                        </td>
                        <td>
                            <button
                                onclick="desativarReserva(<?= $reserva['id_reserva'] ?>)"
                                class="btn btn-danger btn-sm">
                                Desativar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <h3 style="color: #9a5c1fad;">Faça uma nova Reserva aqui!</h3>
        <a href="<?= BASE_URL ?>reserva/adicionar" class="btn fw-bold px-4 py-2" style="background:#9a5c1fad; color: #ffffff; border-radius: 8px;">
            Adicionar Reserva
        </a>
    </div>
</div>

<script>
    function alterarStatusReserva(idReserva, novoStatus) {
        fetch(`<?= BASE_URL ?>reserva/alterarStatus`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_reserva: idReserva,
                    status_reserva: novoStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.sucesso) {
                    alert(data.mensagem || 'Erro ao atualizar status.');
                }
            })
            .catch(() => alert('Erro ao enviar requisição.'));
    }
</script>

<script>
function desativarReserva(idReserva) {

    if(!confirm("Deseja realmente desativar esta reserva?")){
        return;
    }

    fetch("<?= BASE_URL ?>reserva/desativar", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id_reserva: idReserva
        })
    })
    .then(response => response.json())
    .then(data => {

        if(data.sucesso){

            let linha = document.getElementById("reserva_"+idReserva);

            if(linha){
                linha.remove();
            }

        }else{
            alert(data.mensagem);
        }

    })
    .catch(() => alert("Erro ao desativar reserva."));
}
</script>