# Instruções de Instalação e Execução

Este guia explica como instalar, configurar e executar o projeto de forma simples e organizada.

---

## Pré-requisitos

Certifique-se de ter instalado:

-   **Visual Studio Code**
-   **MySQL Workbench 8.0 CE**
-   **PHP 8.4.10** (ou versão compatível)

---

## Passo a Passo da Instalação

### 1. Extrair o projeto

1. Extraia o arquivo `TCC_main.zip`.
2. Dentro dele, localize a pasta **TCC-main**.
3. Abra a pasta **TCC-main** e extraia a pasta **TCC** para a **Área de Trabalho**.

### 2. Abrir o projeto no VS Code

1. Abra o **Visual Studio Code**.
2. Clique em **File > Open Folder**.
3. Selecione a pasta **TCC** que você colocou na Área de Trabalho.

### 3. Importar o Banco de Dados

1. Abra o **MySQL Workbench**.
2. Vá em **File > Open SQL Script**.
3. Abra o arquivo **banco de dados.sql** localizado na pasta **TCC-main**.
4. Clique no ícone de raio (⚡) para executar o script.
5. Certifique-se de usar seu usuário e senha padrão do MySQL (por exemplo: _root_ / sua senha).

---

## ▶Instruções de Execução

### 1. Abrir o projeto pelo CMD

1. Abra o **Prompt de Comando**.
2. Execute:

    ```sh
    cd Desktop/TCC
    ```

    _Obs.: Se estiver usando PowerShell, você pode precisar usar barra invertida:_

    ```sh
    cd Desktop\TCC
    ```

### 2. Iniciar o servidor PHP

Se o PHP não estiver instalado: instale-o antes.

Depois, execute:

```sh
php -S localhost:8080
```

### 3. Acessar o projeto

Abra o navegador e acesse:

-   **Modo usuário:** http://localhost:8080/Site/index.html
-   **Modo administrador:** http://localhost:8080/Administrador/index.html

---

## Suporte

Se encontrar erros ou precisar de ajuda, revise se:

-   O banco de dados foi importado corretamente.
-   O servidor PHP está rodando no caminho correto.
-   As pastas **Site** e **Administrador** estão dentro da pasta TCC.

---

Pronto! Agora você pode instalar e executar o projeto sem complicações.
