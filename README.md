<img src="https://www.exata.it/wp-content/uploads/2023/02/logo-Exata-white1-1.png" width="400" alt="Laravel Logo">

# Desafio técnico Exata Tech

Este projeto é um sistema de gerenciamento de tarefas desenvolvido como parte de um desafio técnico para uma vaga de desenvolvedor júnior na Exata Tech. A aplicação foi construída utilizando Vue.js no frontend e Laravel no backend.
## Design do banco de dados
<img src="https://i.ibb.co/7b0s5kG/image.png">

[DrawDB](https://drawdb.vercel.app/editor)


# Requisitos
## Requisitos funcionais

| RF    | Requisito                                                                                  |
|-------|--------------------------------------------------------------------------------------------|
| RF001 | **CRUD Tarefas**: Usuários autenticados podem criar, editar, visualizar e excluir tarefas. |
| RF002 | **CRUD Tarefas:** Cada tarefa deve ter um título, descrição e status (ex: "pendente", "em andamento", "concluída"). |
| RF003 | **Filtros e ordenação:** Permitir que as tarefas sejam filtradas por status e ordenadas por data de criação ou atualização. |
| RF004 | **Validações:** Implementar validações básicas para garantir que os campos obrigatórios sejam preenchidos e que os dados estejam no formato adequado. |
| RF005 | **Perfil de usuário: Adicionar uma distinção entre** usuários comuns e um perfil “admin” |
| RF006 | **Perfil de usuário:** Usuários comuns devem visualizar apenas as tarefas que eles mesmos criaram |
| RF007 | **Perfil de Usuário:** O usuário com perfil "admin" deve ter acesso a todas as tarefas criadas no sistema. |

## Requisitos não funcionais

| RNF    | Requisito                             |
|--------|---------------------------------------|
| RNF001 | Framework Laravel                     |
| RNF002 | Front-end em VueJs                    |
| RNF003 | Migrações para criação de tabelas     |
| RNF004 | Seeders para popular o banco de dados |
| RNF005 | Arquitetura MVC                       |
| RNF006 | Teste unitários (diferencial)         |

---

# Ferramentas utilizadas:
* Front-end: [VueJs](https://vuejs.org)
* UI: [ElementPlus](https://element-plus.org/en-US/)
* Requisições: [Axios](https://axios-http.com/ptbr/docs/intro)
* Store: [Pinia](https://pinia.vuejs.org)
* Banco do Dados: [MySQL](https://www.mysql.com) + [Docker](https://docs.docker.com/compose/)
* Back-end: [Laravel](https://laravel.com)
* Testes: [Postman](https://www.postman.com)

# [Video de demonstração](https://www.youtube.com/watch?v=auv2PeXZCi0)


## Seeders
Conforme especificado nos requisitos, utilizei seeders com factories para gerar dados de teste de forma aleatória.

O seeder de usuários primeiro cria um usuário administrador com a senha variando entre 1 e 8 caracteres. Em seguida, ele gera 10 usuários aleatórios utilizando o factory.

Exemplo de factory para tarefas:
```php
<?php

namespace Database\Factories;

use App\Enums\StatusTarefa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefas>
 */
class TarefasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(StatusTarefa::values()),
            'data_criacao' => now(),
            'data_modificacao' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
```

## Admin
O usuário admin possui uma sessão especial onde pode visualizar, editar ou excluir todos os usuários da aplicação.

<img src="https://i.ibb.co/yBBbcW6/imagem-2024-11-20-024434035.png">


No painel de tarefas, implementei uma funcionalidade adicional para administradores, permitindo filtrar as tarefas com base nos usuários.
<img src="https://i.ibb.co/t2dvd8w/imagem-2024-11-20-024614514.png" alt="imagem-2024-11-20-024614514" border="0">

---

## Testes
Com o objetivo de verificar algumas funcionalidades e também garantir uma cobertura básica na aplicação, implementei testes unitários para os principais controllers.

### UserController
Os testes para o UserController foram focados nas rotas confidenciais, que são liberadas apenas para administradores. Os testes incluem cenários de acesso permitido e negado para essas rotas.

### TarefasController
Nos testes do TarefasController, o objetivo foi validar todas as funções do CRUD. Com mais tempo, eu também adicionaria testes para verificar a validação dos dados de entrada. 😅

### AuthController
Nos testes do AuthController, foquei principalmente nas validações dos dados. Testei a validação da senha, dos campos nome e nome de usuário, além de verificar se credenciais inválidas realmente rejeitavam o login.

<img src="https://i.ibb.co/KWf6Fyc/imagem-2024-11-20-025600373.png" alt="imagem-2024-11-20-025600373" border="0">

# Considerações finais
Desenvolver esse projeto foi desafiador, especialmente com o prazo apertado de apenas 6 dias. No entanto, eu já havia aplicado conceitos semelhantes em um projeto pessoal com amigos, no qual desenvolvemos um sistema de tarefas utilizando Vue.js + FastAPI. Isso fez com que muitos aspectos do desenvolvimento fossem familiares, o que facilitou a execução.

Além disso, muitos conceitos do desenvolvimento web se mantêm consistentes, independentemente da tecnologia utilizada. Por exemplo, tanto no FastAPI quanto no Laravel, o processo de migração de banco de dados é muito parecido, e eu consegui aproveitar esses conhecimentos para acelerar o desenvolvimento deste projeto.

Estou satisfeito com o resultado e espero que ele atenda às expectativas.
