(function(){
    
    const formulario = document.querySelector('#formTask');

    formulario.addEventListener('submit', leerDatos);


    function leerDatos(e) {
        e.preventDefault();
        
        const nombreTarea = document.querySelector('#task_name').value.trim();
        const fechaLimite = document.querySelector('#limit_date').value.trim();
        const prioridad = document.querySelector('#selPrioridad').value.trim();
        const descripcion = document.querySelector('#descripcion').value.trim();

        validarDatos(nombreTarea, fechaLimite, prioridad, descripcion);

    }

    function validarDatos(nombreTarea, fechaLimite, prioridad, descripcion) {

        if(nombreTarea === "" || fechaLimite === "" || prioridad === "" || descripcion === "") {

            Swal.fire({
                icon: "warning",
                title: "ALGUNOS CAMPOS SON REQUERIDOS",
                showClass: {
                    popup: `
                    animate__animated
                    animate__jackInTheBox
                    animate__faster
                    `
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                    `
                }
            });

            return false;

        }

        // Validar fecha con formato YYYY-MM-DD
        const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
        if(!regexFecha.test(fechaLimite)) {
            Swal.fire({ icon:"warning", title:"LA FECHA LIMITE NO ES VALIDA" });
            return false;
        }

        // Convertimos ambas fechas a string comparable YYYY-MM-DD
        const hoy = new Date();
        const yyyy = hoy.getFullYear();
        const mm = String(hoy.getMonth()+1).padStart(2,'0');
        const dd = String(hoy.getDate()).padStart(2,'0');
        const hoyStr = `${yyyy}-${mm}-${dd}`;

        if (fechaLimite < hoyStr) {
             Swal.fire({
                icon: "warning",
                title: "LA FECHA LIMITE NO ES VALIDA",
                showClass: {
                    popup: `
                    animate__animated
                    animate__jackInTheBox
                    animate__faster
                    `
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                    `
                }
            });

            return false;
        }

        if(prioridad === "" || prioridad === "0") {

            Swal.fire({
                icon: "warning",
                title: "SELECCIONE UNA PRIORIDAD VALIDA",
                showClass: {
                    popup: `
                    animate__animated
                    animate__jackInTheBox
                    animate__faster
                    `
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                    `
                }
            });

            return false;

        }

        enviarTask(nombreTarea, fechaLimite, prioridad, descripcion);
        
    }

    async function enviarTask(nombreTarea, fechaLimite, prioridad, descripcion) {
        
        const datos = new FormData();
        datos.append('titulo', nombreTarea);
        datos.append('fechaLimite', fechaLimite);
        datos.append('prioridad', prioridad);
        datos.append('descripcion', descripcion);

        try {
            
            const URL = 'services/task.php';
            const respuesta = await fetch(URL, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if(resultado === "error") {
                Swal.fire({
                    icon: "warning",
                    title: "SELECCIONE UNA PRIORIDAD VALIDA",
                    showClass: {
                        popup: `
                        animate__animated
                        animate__jackInTheBox
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                        `
                    }
                });

                return false;

            } else {

                Swal.fire({
                    icon: "success",
                    title: "TAREA REGISTRADA EXITOSAMENTE",
                    showClass: {
                        popup: `
                        animate__animated
                        animate__jackInTheBox
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                        `
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        formulario.reset();
                    }
                });

            return false;

            }
            

        } catch (error) {
            console.log(error);
            
        }
        
    }

})();