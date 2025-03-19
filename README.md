
# API de Investimentos



## Documentação da API

Esta é uma API de investimentos desenvolvida em PHP 8.3 utilizando o framework Symfony 5, banco de dados MySQL 8 e gerenciada via Docker. A API permite criar, visualizar e retirar investimentos, além de aplicar regras de imposto sobre saque baseadas no tempo do investimento. A autenticação é feita via JWT.
Os testes da API foram realizados utilizando Postman.




## Tecnologias Utilizadas

 - PHP 8.3
 - Symfony 5
 - MySQL 8
 - Docker
 - JWT para autenticação


## Como Utilizar a API

### Subir o Container com Docker
```bash
docker-compose up -d
```
### Criar um Usuário para Autenticação
Depois de subir os containers, crie um usuário para autenticação executando o seguinte comando dentro do container:
```bash
cli/console app:create-user 'seu-email@hotmail.com' 'sua-senha'
```
### Obter o Token de Autenticação
Após criar o usuário, envie uma requisição POST para obter o token JWT:
### EndPoint:
 O token recebido deverá ser utilizado nas demais requisições da API, inserindo-o no cabeçalho Authorization como Bearer Token.
 ```bash
 [POST] http://127.0.0.1/api/login_check
```   
Exemplo: 
 ```bash
 {
    "email": "email-cadastrado@hotmail.com",
    "password": "senha"
}
```
   
## Endpoints Disponíveis
### Endpoint de Criação de um Investimento:
 ```bash
[POST] http://127.0.0.1/api/investment/create
```   
Exemplo: 
 ```bash
{
    "initial_value": "105500.00",
    "created_at": "2025-03-11"
}
```
### Endpoint de Retirada de um Investimento Criado:
 ```bash
[POST] http://127.0.0.1/api/investment/withdraw/{ID}
```   
### Visualizar um Investimento Específico:
 ```bash
[GET] http://127.0.0.1/api/investment/{ID}
```   
### Visualizar Todos os Investimentos Criados:
 ```bash
[GET] http://127.0.0.1/api/investments
```   

## Autenticação
Todos os endpoints (exceto login) exigem autenticação via JWT. Após obter o token, envie-o no cabeçalho da requisição:
 ```bash
 Authorization: Bearer SEU_TOKEN_AQUI
```   
Isso garante que apenas usuários autenticados consigam acessar os serviços da API.




## Testes com Postman

- Utilize o Postman para enviar requisições para os endpoints.
- Após obter o token, adicione-o no cabeçalho Authorization como Bearer Token.
- Execute as operações desejadas na API.


## Licença

[MIT](https://choosealicense.com/licenses/mit/)

