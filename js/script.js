const form = document.getElementById('loginForm');
const mensagemErro = document.getElementById('mensagemErro');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
        const resposta = await fetch('../database/login_process.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await resposta.text();

        if (resultado.trim() === 'ok') {
            window.location.href = '../pages/dashboard.php';
        } else {
            mensagemErro.textContent = resultado;
        }
    } catch (erro) {
        mensagemErro.textContent = 'Erro ao conectar com o servidor.';
        console.error(erro);
    }
});
