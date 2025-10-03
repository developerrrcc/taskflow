(function(){

    let dataTable; // instancia global

    function generarClaveTemp() {
        let clave = "Peru" + Math.floor(1000 + Math.random() * 9000);
        document.querySelector("#pass_temp").value = clave;
    }

    document.addEventListener('DOMContentLoaded', function(){

        mostrarTablaUser();

        const formulario = document.querySelector('#new_user');
        formulario.addEventListener('submit', leerDatos);

        generarClaveTemp();

        function leerDatos(e) {
            e.preventDefault();
            const nameFull = document.querySelector('#nameFull').value.trim();
            const emailUser = document.querySelector('#emailUser').value.trim();
            const passTemp = document.querySelector('#pass_temp').value.trim();

            validarDatos(nameFull, emailUser, passTemp);
        }

        function validarDatos(nameFull, emailUser, passTemp) {
            if(nameFull === "" || emailUser === "" || passTemp === "") {
                Swal.fire({
                    icon: "warning",
                    title: "Uno de los datos está incompleto",
                    text: 'Por favor verifica que los datos estén completos'
                });
                return false;
            }

            enviarDatos(nameFull, emailUser, passTemp);
        }

        async function enviarDatos(nameFull, emailUser, passTemp) {
            const datos = new FormData();
            datos.append('nameFull', nameFull);
            datos.append('emailUser', emailUser);
            datos.append('passTemp', passTemp);

            try {
                Swal.fire({
                    title: 'Registrando usuario...',
                    text: 'Por favor espera un momento',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                const URL = 'services/User.php';
                const respuesta = await fetch(URL, { method: 'POST', body: datos });
                const resultado = await respuesta.json();

                if (resultado.status === "ok") {
                    Swal.fire({ icon: 'success', title: 'Usuario registrado', text: resultado.msg || "Se envió el correo exitosamente" });
                    formulario.reset();
                    generarClaveTemp();
                    await mostrarTablaUser(); // refrescamos la tabla (esperamos que termine)
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: resultado.msg || "No se pudo registrar el usuario" });
                }

            } catch (error) {
                console.log(error);
                Swal.fire({ icon: 'error', title: 'Error de conexión', text: "Intenta nuevamente" });
            }
        }

        async function mostrarTablaUser() {
            try {
                const respuesta = await fetch('services/User.php');
                const json = await respuesta.json();

                const rowsData = Array.isArray(json) ? json : (json.data || []);

                // destruir la instancia si ya existe
                if (dataTable) {
                    dataTable.destroy();
                }

                // limpiar tbody manual
                const tbody = document.querySelector('#tableUser tbody');
                tbody.innerHTML = "";

                rowsData.forEach(user => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.nombres}</td>
                        <td>${user.email}</td>
                        <td>
                            ${user.first_login === 0
                                ? '<span class="w3-tag w3-danger w3-round"><i class="fa-solid fa-key"></i></span>'
                                : '<span class="w3-tag w3-green w3-round"><i class="fa-solid fa-lock-open"></i></span>'}
                        </td>
                        <td>
                            ${user.estado !== 0
                                ? '<span class="w3-tag w3-info w3-round">ACTIVO</span>'
                                : '<span class="w3-tag w3-gray w3-round">INACTIVO</span>'}
                        </td>
                        <td>${user.fecha_ingreso || ''}</td>
                        <td>${user.fecha_registro || ''}</td>
                    `;
                    tbody.appendChild(tr);
                });

                // volver a inicializar
                dataTable = new DataTable("#tableUser", {
                    searchable: true,
                    sortable: true,
                    perPage: 5,
                    perPageSelect: [5, 10, 20, 50],
                    labels: {
                        placeholder: "Buscar...",
                        perPage: "{select} registros",
                        noRows: "No se encontraron usuarios",
                        info: "Mostrando {start} a {end} de {rows} usuarios"
                    }
                });

            } catch (error) {
                console.log("mostrarTablaUser error:", error);
            }
        }

    });

})();
