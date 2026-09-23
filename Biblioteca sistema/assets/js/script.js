function confirmarExclusao(titulo) {
    return confirm('Tem certeza que deseja excluir o livro "' + titulo + '"?');
}

document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const sucesso = params.get('sucesso');

    const mensagens = {
        cadastrado: 'Livro cadastrado com sucesso!',
        editado: 'Livro atualizado com sucesso!',
        excluido: 'Livro excluído com sucesso!'
    };

    if (sucesso && mensagens[sucesso]) {
        const alerta = document.createElement('div');
        alerta.className = 'alert alert-success alert-dismissible fade show';
        alerta.setAttribute('role', 'alert');
        alerta.innerHTML = mensagens[sucesso] + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

        const main = document.querySelector('main');
        if (main) main.prepend(alerta);

        setTimeout(() => {
            alerta.classList.remove('show');
            alerta.remove();
        }, 4000);
    }
});