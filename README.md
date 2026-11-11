# 🌐 GUIAR - Sistema Inteligente com IoT

## Contato flutuante

Na página inicial, o botão **Fale com o GUIAR** abre um formulário que envia mensagens para `projGuiar@gmail.com`. Execute o projeto pelo Apache/PHP (por exemplo, `http://localhost/GUIAR/index.html`).

O envio usa PHPMailer, já instalado no projeto, com a mesma configuração SMTP do cadastro e da recuperação de senha. Essa configuração está centralizada em `mvc/Services/EmailService.php` e é reutilizada pelo `EmpresaController` e por `enviarContato.php`; não é necessário configurar novas variáveis de ambiente para o contato. O e-mail informado no formulário é usado como endereço de resposta.

## Testes automatizados

O workflow do GitHub Actions executa os testes ao enviar um `push` ou abrir um `pull request` para `master`. Também pode ser iniciado manualmente em **Actions > Testes do GUIAR > Run workflow**.

Quando os testes de frontend e backend passam, o workflow gera um pacote `guiar-build.zip` e publica-o como artefato para download na página da execução do GitHub Actions.

Para executar os testes localmente, instale Node.js 22, PHP 8.2 com as extensões PDO SQLite e mbstring, e Composer. Depois rode:

```sh
npm ci
npx playwright install chromium
composer install
php tests/backend/model_smoke.php
```

Para o teste do navegador, inicie o servidor PHP em um terminal:

```sh
php -S 127.0.0.1:8080 -t .
```

Em outro terminal, execute:

```sh
npm run test:frontend
```

O **GUIAR** é um sistema web desenvolvido com foco em tecnologia e inovação, integrando **Internet das Coisas (IoT)** para oferecer uma solução moderna, automatizada e eficiente.

O projeto tem como objetivo unir aplicações web com dispositivos inteligentes, proporcionando monitoramento, automação e controle em tempo real.

---
## 🌐 Demonstração
👉 Acesse o site online:
https://guiartccrotas.serv00.net

---

## 🚀 Objetivo do Projeto

Desenvolver uma plataforma capaz de integrar sistemas web com dispositivos IoT, permitindo:

- Monitoramento em tempo real
- Automação de processos
- Comunicação entre dispositivos e sistema
- Interface amigável para o usuário

---

## 🧠 Conceito de IoT no Projeto

A **Internet das Coisas (IoT)** permite que dispositivos físicos se conectem à internet e troquem dados.

No projeto GUIAR, a IoT é utilizada para:

- 📡 Coleta de dados por sensores  
- 🔌 Controle de dispositivos remotamente  
- 📊 Envio de informações para o sistema web  
- ⚙️ Automação de ações baseadas em eventos  

---

## 🛠️ Tecnologias Utilizadas

### 💻 Web
- HTML5  
- CSS3  
- JavaScript  
- PHP  
- MySQL  

### 🔗 IoT
- ESP32  
- Sensores (temperatura, presença, etc.)  
- Comunicação via API / HTTP / JSON  

### ⚙️ Ferramentas
- XAMPP  
- Git e GitHub  

---

## ⚙️ Funcionalidades

- Sistema web completo com interface amigável  
- Integração com dispositivos IoT  
- Monitoramento de dados em tempo real  
- Automação de ações  
- Comunicação entre hardware e software  
- Armazenamento de dados em banco  

---
