# Testando Novas Funcionalidades do PHP 7.4

Repositório com o código utilizado de exemplo no post publicado no meu blog [Testando Novas Funcionalidades do PHP 7.4](https://whoami.deoliveiralucas.net/blog/testando-novas-funcionalidades-do-php-7-4).
### Requisitos

- [Docker](https://docs.docker.com/install/)

### Executando

1. Clonar o repositório:

   `git clone git@github.com:deoliveiralucas/php74-beta-tests.git`

2. Criar um *alias* para o comando do Docker:
 
   ``alias php74="docker run -it --rm -v `pwd`:/php74 -w /php74 -p 8888:8888 php:7.4.0beta1-cli-alpine"``
 
3. Executar servidor embutido do PHP:

   `php74 -S 0.0.0.0:8888`
 
4. Acesse no navegador: [http://localhost:8888](http://localhost:8888)
