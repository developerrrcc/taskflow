(function(){

    document.addEventListener('DOMContentLoaded', function(){

        //variables
        const formulario = document.querySelector('#new_user');

        formulario.addEventListener('submit', leerDatos);


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
                    Text: 'Por favor verifica que los datos estén completos'
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
                
                const URL = 'services/User.php';
                const respuesta = await fetch(URL, {
                    method: 'POST',
                    body: datos
                });

                const resultado = await respuesta.json();
                console.log(resultado);
                

            } catch (error) {
                console.log(error);
                
            }

        }

    })

})();