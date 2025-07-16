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
    });
