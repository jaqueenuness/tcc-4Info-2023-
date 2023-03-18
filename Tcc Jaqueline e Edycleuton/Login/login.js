function login() {
    // Adicione aqui a lógica de login usando a entrada do usuário
    // Redirecione o usuário para a página adequada após o login
    window.location.href = "pagina-de-entrada.html";
}

function loginGoogle() {
    // Adicione aqui a lógica de login usando o Google OAuth
    // Redirecione o usuário para a página adequada após o login
    window.location.href = "pagina-de-entrada.html";
}

function forgotPassword() {
    // Adicione aqui a lógica para redefinir a senha do usuário
    // Redirecione o usuário para a página adequada para redefinir a senha
    window.location.href = "pagina-de-redefinicao-de-senha.html";
}

function register() {
    // Adicione aqui a lógica para registrar um novo usuário
    // Redirecione o usuário para a página adequada após o registro
    window.location.href = "pagina-de-registro.html";
}

document.getElementById("login-btn").addEventListener("click", login);
document.getElementById("google-btn").addEventListener("click", loginGoogle);
document.getElementById("forgot-btn").addEventListener("click", forgotPassword);
document.getElementById("register-btn").addEventListener("click", register);