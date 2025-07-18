fetch("../Login/pegar_nome.php")
    .then((response) => response.json())
    .then((data) => {
        if (data.nome) {
            const loginArea = document.getElementById("login-area");
            if (loginArea) {
                loginArea.innerHTML = `
          <a href="../perfil/perfil.php">
            ${data.nome} <i class="bi bi-person-fill"></i>
          </a>
        `;
            }
        }

        const logoLink = document.querySelector(".nav-left a");
        if (logoLink) {
            if (data.tipo === "admin") {
                logoLink.setAttribute("href", "../Administrador/index.html");
            } else if (data.tipo === "cliente") {
                logoLink.setAttribute("href", "../Site/index.html");
            }
        }

        const inicioLink = document.getElementById("link-inicio");
        if (inicioLink) {
            if (data.tipo === "admin") {
                inicioLink.setAttribute("href", "../Administrador/index.html");
            } else if (data.tipo === "cliente") {
                inicioLink.setAttribute("href", "../Site/index.html");
            }
        }
    });
