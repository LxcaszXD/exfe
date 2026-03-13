# ☕ EXFE – Sistema de Gerenciamento para Cafeteria

![Status](https://img.shields.io/badge/Status-Em_Desenvolvimento-brightgreen)
![PHP](https://img.shields.io/badge/PHP-MVC_Customizado-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Banco_de_Dados-4479A1?logo=mysql&logoColor=white)

O **EXFE** é uma aplicação web completa (Full-Stack) desenvolvida para gerenciar e otimizar os processos de uma cafeteria. O projeto abrange desde uma interface amigável para os clientes até um painel administrativo (Dashboard) robusto, seguindo rigorosas boas práticas de desenvolvimento, segurança e estruturação.

🌐 **Acesse o projeto em produção:** [exfe.lucaszdev.me](http://exfe.lucaszdev.me)

---

## 🎯 Funcionalidades Principais

* **Gestão de Cardápio e Pedidos:** Catálogo interativo de produtos, categorias e especialidades.
* **Controle de Mesas e Reservas:** Sistema dinâmico para acompanhamento de mesas disponíveis, ocupadas e reservadas.
* **Painel Administrativo (Dashboard):** Visão centralizada para funcionários gerenciarem clientes, pedidos e blogs.
* **Sistema de Avaliações e Contato:** Interação direta com os consumidores e captação de leads (Newsletter).
* **Rotas Amigáveis:** URLs limpas gerenciadas via `.htaccess` e um roteador PHP customizado.

---

## 🛠️ Tecnologias Utilizadas

### Front-end (Interface e Experiência)
- **HTML5 & SCSS:** Estruturação semântica e estilização modular avançada.
- **JavaScript:** Interatividade e dinamismo no lado do cliente.
- **[SwiperJS](https://swiperjs.com/):** Criação de sliders modernos, fluidos e responsivos.
- **[BoxIcons](https://boxicons.com/):** Biblioteca de ícones vetorizados para UI.

### Back-end (Lógica e Regras de Negócio)
- **PHP (Orientado a Objetos):** Código limpo seguindo as boas práticas da documentação oficial.
- **Arquitetura MVC:** Framework próprio estruturado do zero (Models, Views e Controllers) para total escalabilidade.
- **Integração de APIs:** Consumo de serviços externos para agregar dados dinâmicos.

### Banco de Dados e Infraestrutura
- **MySQL:** Modelagem relacional para persistência de dados (Clientes, Pedidos, Funcionários).
- **Servidor LAMP (DigitalOcean):** Deploy manual em servidor Linux (Ubuntu), configurando Apache2, Virtual Hosts e permissões de segurança.

---

## 📲 Próximos Passos (Roadmap)

- [ ] **Painel de Relatórios:** Geração de métricas de vendas e produtos mais acessados.
- [ ] **Otimização de Performance:** Implementação de cache e minificação de assets.

---

## 🚀 Como Executar o Projeto Localmente

Siga os passos abaixo para rodar a aplicação em sua máquina utilizando um servidor local (como XAMPP, WAMP ou Docker).

**1. Clone o repositório:**
```bash
git clone https://github.com/LxcaszXD/exfe.git
```

**2. Configure o Banco de Dados:**
* Acesse o seu gerenciador de banco de dados.
* Crie um banco de dados (sugestão: `db_exfe`).
* Importe o arquivo `.sql` (localizado na raiz ou na pasta de banco de dados do projeto) para criar a estrutura de tabelas.

**3. Ajuste as Variáveis de Configuração:**
* Navegue até o arquivo `app/config/config.php`.
* Atualize as constantes com as credenciais do seu ambiente local:

```php
// Ajuste a BASE_URL conforme o nome da sua pasta no servidor local
define("BASE_URL", "http://localhost/exfe/public/"); 

// Credenciais do Banco de Dados
define("DB_HOST", "localhost");
define("DB_NAME", "nome_do_seu_banco");
define("DB_USER", "seu_usuario");
define("DB_PASS", "sua_senha");
```

**4. Configuração do Servidor Web (Apache):**
* Certifique-se de que o módulo **mod_rewrite** do Apache está ativado (necessário para as rotas amigáveis do MVC funcionarem).
* O projeto utiliza o arquivo `public/.htaccess` para roteamento. Em ambientes de produção, aponte o `DocumentRoot` do servidor diretamente para a pasta `/public`.

**5. Acesse no Navegador:**
* Abra o endereço `http://localhost/exfe/public` no seu navegador e o sistema estará pronto para uso!

---
*Desenvolvido com foco na conexão entre design moderno e lógica bem estruturada.*
