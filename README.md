<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Sobre o projeto

Para execução do projeto o usuário deverá ter em sua máquina o docker instalado para "subir" os containers
da aplicação seguindo os próximos passos:

- Fazer o clone do projeto 
- Renomei o arquivo .env.example para .env
- Execute o comando
  - docker-composer build
- Execute o comando "levantar" os containers da aplicação
  - docker-compose up -d
- Execute composer para instalar as dependências do projeto
  - docker container exec om_composer composer install
- Execute execute as migrates do projeto para ter os primeiros dados
  - docker container exec om_php php artisan migrate:fresh --seed
- Por fim, execute o comando abaixo para trabalhar os jobs da aplicação
  - docker container exec -d om_php php artisan queue:work

## Observações

- A lista de endpoints foi exportada utilizando o Insomnia e esta dentro da pasta do projeto. Para utilizar basta importa para dentro do Insomnia e verificar os endpoints da aplicação.
- O template da planilha para importação dos dados do paciente estão dentro da pasta do projeto.
- PS: Não consegui realizar todos os passos por conta do tempo. Abraço!
