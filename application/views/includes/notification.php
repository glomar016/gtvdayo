<script>
    // Notify Alert
    function showNotify(icon, message, type, from, align){
    $.notify({
          icon: icon,
          message: message
      },{
          type: type,
          timer: 4000,
          placement: {
              from: from,
              align: align
          }
      });
    }

    // Show Confirm Swal Alert
    function showSwal(title, text, icon, confirmButtonText){
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText
      }).then((result) => {
        if (result.isConfirmed) {
            return result
        }
      })
    }
  </script>