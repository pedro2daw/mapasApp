<script>

$(document).ready(function(){
swal({
                title: "NO TIENE ACCESO A ESTE ÁREA",
                closeOnClickOutside: false,
                closeOnEsc: false,
                text: "",
                icon: "error",
                button: {
                    text: "Volver al menú"
                }
                })
                .then((r) => {
                if (r) {
                    location.href='<?php echo site_url();?>/Maps/index';
                }
});
});


</script>