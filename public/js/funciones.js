
//funcion que permite enviar notificaciones en todo el programa
function noty(msg, option = 1) {
    Snackbar.show({
        text: String(msg).toUpperCase(),
        actionText: 'CERRAR',
        actionTextColor: '#fff',
        backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
        pos: 'top-right'
    });
}
