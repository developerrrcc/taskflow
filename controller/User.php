<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Controller_User {

    static public function ctrSaveUser($datos) {

        if(
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombres"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["email"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $datos["pass_temp"])
        ) {

            $keyApi = bin2hex(random_bytes(16));

            $tokenSeguridad = mt_rand(100000, 999999);

            $passSend = $datos["pass_temp"];

            $tabla = "users";

            $encriptar = crypt($datos["pass_temp"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            // datos del usuario
            $datos = array(
                "keyApiU" => $keyApi,
                "nombres" => $datos["nombres"],
                "email" => $datos["email"],
                "password" => $encriptar,
                "token" => $tokenSeguridad
            );

            // ✅ probamos enviar un correo de confirmación
            $mail = new PHPMailer(true);

            try {
                // Configuración servidor SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';     // servidor SMTP (ej: Gmail)
                $mail->SMTPAuth   = true;
                $mail->Username   = 'rolindeveloper@gmail.com'; // 🔹 tu correo
                $mail->Password   = 'wfvi uduo nvjx jduf'; // 🔹 clave o contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Remitente y destinatario
                $mail->setFrom('rolindeveloper@gmail.com', 'TaskFlow');
                $mail->addAddress($datos["email"], $datos["nombres"]);

                // Contenido
                $mail->isHTML(true);
                $mail->Subject = "Bienvenido a TaskFlow";
                $mail->Body = '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                <meta charset="UTF-8">
                <title>TaskFlow - Registro exitoso</title>
                </head>
                <body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

                <div style="max-width:600px;margin:30px auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <div style="background:#e53935;color:#fff;text-align:center;padding:20px;">
                    <h2 style="margin:0;font-size:22px;">TaskFlow</h2>
                    <p style="margin:5px 0 0;font-size:14px;">Tu productividad, más fuerte que nunca</p>
                    </div>
                    
                    <!-- Body -->
                    <div style="padding:25px;text-align:left;color:#333;">
                    <h3 style="margin-top:0;">Hola <b>'.$datos["nombres"].'</b></h3>
                    <p style="font-size:15px;line-height:1.6;">
                        ¡Tu registro fue <b>exitoso</b>!  
                        Bienvenido a <b>TaskFlow</b>, la plataforma que potencia tu trabajo en equipo 🚀
                    </p>

                    <!-- Clave temporal destacada -->
                    <div style="background:#ffebee;border-left:6px solid #e53935;padding:15px;margin:20px 0;border-radius:8px;">
                        <p style="margin:0;font-size:14px;color:#444;">Tu clave temporal de acceso:</p>
                        <h2 style="margin:8px 0 0;color:#e53935;">'.$passSend.'</h2>
                    </div>

                    <p style="font-size:13px;color:#666;">⚠️ Recuerda: cambia esta clave al iniciar sesión por primera vez.</p>

                    <!-- Botón -->
                    <div style="text-align:center;margin-top:25px;">
                        <a href="http://localhost/TaskFlow/login.php" 
                        style="display:inline-block;background:#1a73e8;color:#fff;text-decoration:none;
                                padding:12px 25px;border-radius:6px;font-size:15px;">
                        Iniciar Sesión
                        </a>
                    </div>
                    </div>
                    
                    <!-- Footer -->
                    <div style="background:#f0f0f0;color:#777;text-align:center;font-size:12px;padding:15px;">
                    © '.date("Y").' <b>TaskFlow</b> — Todos los derechos reservados
                    </div>

                </div>

                </body>
                </html>';


                $mail->send();

                $respuesta = Model_User::mdlSaveUser($tabla, $datos);

                return ["status" => "ok", "msg" => "Usuario creado y correo enviado"];


            } catch (Exception $e) {
                return ["status" => "error", "msg" => "No se pudo enviar el correo. Error: {$mail->ErrorInfo}"];
            }

        } else {
            return ["status" => "error", "msg" => "Datos inválidos"];
        }
    }

    /**
     * Controlador mostrar registros
     */

    static public function ctrListUser($item, $valor) {

        $tabla = "users";

        $respuesta = Model_User::mdlListUser($tabla, $item, $valor);
        return $respuesta;

    }

    /**
     * Login
     */
}
