<?php

class ReservaController extends Controller
{

    private $reservaModel;

    public function __construct()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Instaciar o modelo acompanhamentos
        $this->reservaModel = new Reserva();
    }

    public function listar()
    {
        $dados = array();

        $reservaModel = new Reserva();

        // AGORA FILTRA SOMENTE CONFIRMADAS E PENDENTES
        $dados['reservas'] = $reservaModel->getListarReservas();

        $dados['conteudo'] = 'dash/reserva/listar';

        $this->carregarViews('dash/dashboard', $dados);
    }
    public function adicionar()
    {
        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_cliente      = filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_NUMBER_INT);
            $id_mesa         = filter_input(INPUT_POST, 'id_mesa', FILTER_SANITIZE_NUMBER_INT);
            $id_funcionario  = filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT);
            $data_reserva    = filter_input(INPUT_POST, 'data_reserva', FILTER_SANITIZE_STRING);
            $hora_inicio     = filter_input(INPUT_POST, 'hora_inicio', FILTER_SANITIZE_STRING);
            $hora_fim        = filter_input(INPUT_POST, 'hora_fim', FILTER_SANITIZE_STRING);
            $observacoes     = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_SPECIAL_CHARS);

            $status_reserva = 'Pendente';

            // Validação básica
            if ($id_cliente && $id_mesa && $data_reserva && $hora_inicio && $hora_fim) {

                if ($hora_inicio >= $hora_fim) {
                    $dados['mensagem'] = "O horário final deve ser maior que o inicial.";
                    $dados['tipo-msg'] = "erro";
                    $this->carregarViews('dash/dashboard', $dados);
                    return;
                }

                // Preparar dados da reserva
                $dadosReserva = array(
                    'id_cliente'      => $id_cliente,
                    'id_mesa'         => $id_mesa,
                    'id_funcionario'  => $id_funcionario,
                    'data_reserva'    => $data_reserva,
                    'hora_inicio'     => $hora_inicio,
                    'hora_fim'        => $hora_fim,
                    'observacoes'     => $observacoes,
                    'status_reserva'  => $status_reserva
                );

                // Inserir reserva
                $id_reserva = $this->reservaModel->addReserva($dadosReserva);

                if ($id_reserva) {

                    $_SESSION['mensagem'] = "Reserva adicionada com sucesso!";
                    $_SESSION['tipo-msg'] = "sucesso";

                    header('Location: ' . BASE_URL . 'reserva/listar');
                    exit;
                } else {

                    $dados['mensagem'] = "Erro ao adicionar a reserva.";
                    $dados['tipo-msg'] = "erro";
                }
            } else {

                $dados['mensagem'] = "Preencha todos os campos obrigatórios.";
                $dados['tipo-msg'] = "erro";
            }
        }

        // Carregar dados para selects
        $clientes = new Cliente();
        $mesas = new Mesa();
        $funcionarios = new Funcionario();

        $dados['clientes'] = $clientes->getListarCliente();
        $dados['mesas'] = $mesas->listarMesa();
        $dados['funcionarios'] = $funcionarios->getListarFuncionario();

        $dados['conteudo'] = 'dash/reserva/adicionar';

        $this->carregarViews('dash/dashboard', $dados);
    }

    public function alterarStatus()
    {
        $json = json_decode(file_get_contents('php://input'), true);

        // DEBUG temporário
        file_put_contents('log_status_debug.txt', print_r($json, true));

        if (!isset($json['id_reserva'], $json['status_reserva'])) {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Dados incompletos.']);
            return;
        }

        $model = new Reserva();
        $atualizado = $model->atualizarStatus($json['id_reserva'], $json['status_reserva']);

        echo json_encode([
            'sucesso' => $atualizado,
            'mensagem' => $atualizado ? 'Status atualizado com sucesso.' : 'Erro ao atualizar o status.'
        ]);
    }

    public function desativar()
    {
        header('Content-Type: application/json');

        $dados = json_decode(file_get_contents("php://input"), true);

        $id_reserva = $dados['id_reserva'] ?? null;

        if (!$id_reserva) {
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Reserva inválida'
            ]);
            return;
        }

        $reservaModel = new Reserva();

        $resultado = $reservaModel->atualizarStatus($id_reserva, 'Inativa');

        if ($resultado) {
            echo json_encode([
                'sucesso' => true
            ]);
        } else {
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Erro ao desativar'
            ]);
        }
    }
}
