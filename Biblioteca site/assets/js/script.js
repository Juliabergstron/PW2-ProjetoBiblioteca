function confirmarExclusao(titulo) {
    return confirm('Deseja realmente excluir "' + titulo + '"? Esta ação não pode ser desfeita.');
}

document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert-success');
    alerts.forEach((alert) => {
        setTimeout(() => {
            if (window.bootstrap) {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            }
        }, 4000);
    });
});