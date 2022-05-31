function controlBorrado(path,reserva) {
    Swal.fire({
        title: 'Estas seguro?',
        text: "Vas a borrar la reserva de la fecha "+reserva,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK!'
      }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace(path)
        }
      });
    return false;
}