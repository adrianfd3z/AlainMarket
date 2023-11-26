#!/bin/bash

# Damos permisos a erroresnuevo.log
chmod 777 /$HOME/docker-lamp/AlainPhone/app/erroresnuevo.log

# Construir la imagen Docker
sudo docker build -t="web" .

# Iniciar los contenedores con Docker Compose en segundo plano
sudo docker-compose up -d

# Esperar un tiempo antes de abrir las URL (ajusta el tiempo según sea necesario)
sleep 5


# Abrir las URL en Firefox
xdg-open http://localhost:8890/
xdg-open http://localhost:81/



