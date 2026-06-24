<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tu compra se ha realizado correctamente</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; -webkit-text-size-adjust:100%; font-family: Arial, Helvetica, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f4f4; padding:24px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px; max-width:600px; background-color:#ffffff; border-radius:8px; overflow:hidden;">

                    {{-- Cabecera: logo Yamaha sobre fondo negro --}}
                    <tr>
                        <td align="center" style="background-color:#000000; padding:28px 20px;">
                            <img src="{{ $message->embed(public_path('images/logo-yamaha--white.png')) }}"
                                 alt="Yamaha"
                                 width="170"
                                 style="display:block; width:170px; max-width:70%; height:auto; border:0; outline:none; text-decoration:none;">
                        </td>
                    </tr>

                    {{-- Título --}}
                    <tr>
                        <td align="center" style="padding:32px 32px 8px 32px;">
                            <h1 style="margin:0; font-size:22px; line-height:1.3; color:#111111; font-weight:bold;">
                                Tu compra se ha realizado correctamente
                            </h1>
                        </td>
                    </tr>

                    {{-- Cuerpo parte 1 --}}
                    <tr>
                        <td align="center" style="padding:8px 32px 24px 32px;">
                            <p style="margin:0; font-size:16px; color:#333333; line-height:1.5;">
                                ¡Gracias por rodar con nuestros productos de alta calidad!🏍️
                            </p>
                        </td>
                    </tr>

                    {{-- Cuerpo parte 2 --}}
                    <tr>
                        <td style="padding:6px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top" width="28" style="font-size:18px; line-height:1.5;">✅</td>
                                    <td style="font-size:15px; color:#333333; line-height:1.5;">
                                        Te enviaremos en breve tu boleta o factura al celular indicado.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Cuerpo parte 3 --}}
                    <tr>
                        <td style="padding:6px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top" width="28" style="font-size:18px; line-height:1.5;">✅</td>
                                    <td style="font-size:15px; color:#333333; line-height:1.5;">
                                        ¿Necesitas más repuestos, aceites o accesorios? 🔩<br>
                                        Comunícate con nuestro asesor digital
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Cuerpo parte 4: WhatsApp (número dinámico del asesor) --}}
                    <tr>
                        <td align="center" style="padding:24px 32px 8px 32px;">
                            <a href="{{ $whatsappUrl }}" target="_blank"
                               style="display:inline-block; background-color:#25D366; color:#ffffff; text-decoration:none; font-size:16px; font-weight:bold; padding:14px 28px; border-radius:6px;">
                                Escríbenos por WhatsApp
                            </a>
                        </td>
                    </tr>

                    {{-- Bloque promocional: invitación a registrarse en el formulario público --}}
                    <tr>
                        <td style="padding:8px 32px 0 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="background-color:#f4f7fb; border:1px solid #e2e8f0; border-radius:8px;">
                                <tr>
                                    <td style="padding:22px 24px;">
                                        <p style="margin:0 0 10px 0; font-size:17px; color:#0a2c73; font-weight:bold; line-height:1.4;">
                                            🏍️ ¡Motero, no te quedes fuera de la ruta!
                                        </p>
                                        <p style="margin:0 0 16px 0; font-size:15px; color:#333333; line-height:1.5;">
                                            Entérate de nuestras novedades, lanzamientos y
                                            <strong>PROMOCIONES EXCLUSIVAS</strong> para la comunidad.
                                        </p>
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td align="left">
                                                    <a href="{{ route('promociones.registro') }}" target="_blank"
                                                       style="display:inline-block; background-color:#e4002b; color:#ffffff; text-decoration:none; font-size:15px; font-weight:bold; padding:13px 26px; border-radius:6px;">
                                                        REGÍSTRATE AQUÍ
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin:16px 0 0 0; font-size:15px; color:#333333; line-height:1.5;">
                                            La aventura continúa y queremos que formes parte de ella. ¡No te la pierdas!
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Pie --}}
                    <tr>
                        <td align="center" style="padding:28px 32px;">
                            <p style="margin:0; font-size:12px; color:#999999; line-height:1.5;">
                                Este es un correo automático, por favor no respondas a este mensaje.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
