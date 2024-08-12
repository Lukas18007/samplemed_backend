# Samplemed Backend

Essa é uma API que recebe, exibe e deleta postagens em um Blog.

## Instalação

1. Clone o repositório
```bash 
git clone https://github.com/Lukas18007/samplemed_backend.git
cd samplemed_backend  
```

2. Instale as Dependências
```bash
composer install
```

3. Configure o banco de Dados

Arquivo `config/app_local.php:`
```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'seu_usuario',
        'password' => 'sua_senha',
        'database' => 'nome_do_banco',
        'port' => '3306',
    ],
],
```

4. Execute as Migrações do Banco de Dados

```bash
bin/cake migrations migrate
```

5. Execute o Servidor de Desenvolvimento

```php
bin/cake server
```

O projeto estará disponível em http://localhost:8765.

## Considerações

- **Resiliência:** O código fornece o uso das Classes de tratamento de erro padrão do CakePHP sendo cada um dessas classes específica para cada tipo de erro.

```php
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\InternalErrorException;
```

- **Performance:** Prezando pela simplicidade, o banco de dados é centralizado em apenas uma tabela excluindo a necessidade de construção de consultas SQL mais complexas que podem ocasionar lentidão na navegação do usuário. No frontend temos o uso de paralelismo, que faz com que as requisições sejam feitas em segundo plano fornecendo uma navegação mais leve para o usuário.

- **Segurança:** O código utiliza a arquitetura MVC, logo as interações com o banco de dados são feitas utilizando as Models, evitando ataques como SQL injection. O no arquivo `config/bootstrap.php` código também fornece um treco para configurar o CORS, ou seja, requisições feitas de origens não confiáveis retornam erro.

```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}
```

- **Simultaneidade:** Nesse momento nenhum método de simultaneidade foi aplicado, porém no futuro, caso necessário poderiamos aplicar técnicas como uso o uso de filas e uso de cache. Também poderiamos separar 2 cópias do bancos de dados, uma exclusiva para consulta e outra para escrita.
