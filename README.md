##Carteira Back End

-  Desenvolvido com Framework Laravel
```
    Justificativa: Optei por utilizar o Laravel, pois é o framework que tenho mais experiência e gosto muito de utilizalo.
     :)
```
## Desafio

-   [x] Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail.

```
    Foi criado um Model Pessoa que foi extendido para os models Comun e Lojista.
```

-   [x] Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários.
-   [x] Lojistas só recebem transferências, não enviam dinheiro para ninguém.

```
    Validação através do AutorizadorPolicy.
    app/Policies/AutorizadorPolicy.php
```

-   [x] Validar se o usuário tem saldo antes da transferência.

```
    Validação feita através da rule SaldoRule.
    app/Rules/SaldoRule.php
```

-   [x] Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo
-   [x] A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia.

```
    Validação feita através do service AutorizaServices.
    app/Services/AutorizaServices.php
    execução MovimentoRepositoryEloquent.
    app/Repositories/MovimentoRepositoryEloquent.php

```

-   [x] No recebimento de pagamento, o usuário ou lojista precisa receber notificação

```
    Para não impactar no desempenho da aplicação optei por criar uma schedule de envio de notificacoes.
    para executar a schedule basta cadastrar uma cronjob ou apenas executar o comando

    $ docker exec -it carteira_app php artisan schedule:run
    ou
    $ docker exec -it carteira_app php artisan send:notificacoes

    A simulação da rotina é validada com o serviço ChecaServicoService
    app/Services/ChecaServicoService.php

    O comand para enviar as notificações Notifica
    app/Console/Commands/Notifica.php
```

-   [x] Este serviço deve ser RESTFul.

## Diagrama de Classes

![Alt text](docs/diagrama_classes.png?raw=true "Diagrama de Classes")

## DB Schema

![Alt text](docs/schema.bmp?raw=true "DB Schema")

## Models

-   [x] Pessoas
        -> Comuns
        -> Lojistas
-   [x] Criar Carteira após Pessoas
-   [x] Status
-   [x] Movimento

## Instalação

Após fazer o pull request da aplicação rodar os comandos

```
    $ docker-compose up -d
    $ docker exec -it carteira_app composer install
    $ docker exec -it carteira_app php artisan migrate
    $ docker exec -it carteira_app php artisan config:clear
    $ docker exec -it carteira_app php artisan db:seed
```

## Executando testes

-   [x] Validação de migrations
-   [x] Validação models
-   [x] Validação Routes
-   [x] Validação de Requests
-   [x] Validação permissão de transferir
-   [x] Validação de saldo

```
    $ docker exec -it carteira_app vendor/bin/phpunit tests
```

## Executando aplicação

-   Na pasta docs poderá ser encontrado o arquivo que contém uma collection de requisições do insominia para fazer os testes manuais.

```
  Insomnia_2021-05-28
```

## Links da aplicação

```
- Api
      http://localhost:8000/api
- MongoExpress
      http://localhost:8081
```

