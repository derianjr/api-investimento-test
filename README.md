# Teste Api de Investimento
Este é um projeto de API para gerenciamento de investimentos. A API permite a criação de investimentos, retiradas e visualização de investimentos existentes. O projeto foi desenvolvido utilizando PHP 8.3, Symfony 7, MySQLi 8 e Docker.

## Tecnologias Utilizadas

- **PHP 8.3**: A linguagem de programação utilizada para desenvolver a API.
- **Symfony 7**: Framework PHP para o desenvolvimento da API.
- **MySQLi 8**: Biblioteca para interação com o banco de dados MySQL.
- **Docker**: Utilizado para containerização da aplicação, garantindo que o ambiente de desenvolvimento e produção seja o mesmo.
- **Postman**: Utilizado para testar os EndPoints da aplicação.

## Endpoints

Abaixo estão os endpoints da API que foram implementados:

### 1. Criação de Investimento

- **Endpoint**: `POST http://127.0.0.1/api/investment/create`
- **Descrição**: Cria um novo investimento.

### 2. Retirada do Investimento 

- **Endpoint**: `POST http://127.0.0.1/api/investment/investment/withdraw/{ID}`
- **Descrição**: Faz a returada de investimento.

### 3. Visualização do Investimento

- **Endpoint**: `GET http://127.0.0.1/api/investment/{ID}`
- **Descrição**: Visualização do investimento 

## Configuração e Execução

- **Clonar Repositório**: (https://github.com/derianjr/api-investimento-test.git)
- **Configuração do Docker**: Para rodar a aplicação utilizar o comando de Subir os containers e acessar o container PHP.
- **Acessar a API**: A API estará disponível em http://127.0.0.1. No projeto foi utilizado o Postman como ferramenta para testar os endpoints.

## Licença
Este projeto está licenciado sob a MIT License.



