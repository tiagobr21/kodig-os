1. Instalação do Docker e Incializar

- Configurações no Debian

* sudo apt update
* sudo apt remove docker docker-engine docker.io containerd runc
* sudo mkdir -p /etc/apt/keyrings
  curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
* echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] \
  https://download.docker.com/linux/debian $(lsb_release -cs) stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
* sudo apt update
* sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
* sudo service docker start

- Configurações no Windows

* Baixar e Instalar o Docker Desktop
* Inicializar o Docker Desktop

3. Levantar os Containers Docker:

- docker-compose up -d --build

4. Instalar as Dependências:

- docker exec -it <id_container> composer install --prefer-dist --no-interaction

5. Rodar as Migrations

- docker exec -it <id_container> php yii migrate
