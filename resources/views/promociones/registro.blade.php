<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro de Clientes — Yamaha</title>

    {{--
        Página PÚBLICA y autónoma (sin auth, sin layout). El estilo replica el
        look del formulario base (Vue Formulario2) con CSS embebido para no
        depender del build de Tailwind ni de colores/fuentes personalizados.
    --}}
    <style>
        /* Fuente "Estricta" tomada del proyecto base (Formulario2.vue). */
        @font-face {
            font-family: 'Estricta';
            src: url('{{ asset('fonts/estricta-regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --yamaha-blue: #003087;
            --yamaha-blue-dark: #001f5c;
            --yamaha-red: #E60012;
            --yamaha-red-dark: #b3000e;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Arial, Helvetica, sans-serif;
            color: #1f2937;
            -webkit-text-size-adjust: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background-image: url('{{ asset('images/wallpaper3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .35);
            overflow: hidden;
        }

        .card__header {
            background: var(--yamaha-blue);
            border-bottom: 4px solid var(--yamaha-red);
            padding: 20px 32px 20px;
            text-align: center;
            font-family: 'Estricta', 'Segoe UI', Tahoma, sans-serif;
        }

        .card__header img {
            height: 80px;
            width: auto;
            object-fit: contain;
            margin-bottom: 16px;
            filter: drop-shadow(0 10px 8px rgba(0, 0, 0, .15)) drop-shadow(0 4px 3px rgba(0, 0, 0, .12));
        }

        /* Título: text-white text-xl font-bold */
        .card__header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
        }

        /* Subtítulo novedades: text-blue-200 */
        .card__header .subtitle {
            margin: 4px 0 0;
            color: #bfdbfe;
            font-size: 16px;
        }

        /* Aviso de vigencia: text-red-400 font-semibold */
        .card__header .deadline {
            margin: 4px 0 0;
            color: #f87171;
            font-size: 16px;
            font-weight: 600;
        }

        .card__body { padding: 22px 32px 8px; }

        .form-group { margin-bottom: 14px; }

        label.field-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .req { color: var(--yamaha-red); }

        .input,
        .select {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 11px 13px;
            font-size: 15px;
            color: #1f2937;
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            transition: border-color .15s, box-shadow .15s;
        }

        .input:focus,
        .select:focus {
            outline: none;
            border-color: var(--yamaha-blue);
            box-shadow: 0 0 0 3px rgba(10, 44, 115, .15);
        }

        .input.is-invalid,
        .select.is-invalid {
            border-color: #f87171;
            background: #fef2f2;
        }

        .error-msg {
            margin: 5px 0 0;
            font-size: 12.5px;
            color: #dc2626;
        }

        .global-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13.5px;
            margin-bottom: 16px;
        }

        .consents { margin-top: 6px; }

        .consent {
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 10px;
        }

        .consent.is-invalid {
            border-color: #fca5a5;
            background: #fef2f2;
        }

        .consent label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            font-size: 13.5px;
            line-height: 1.45;
            color: #374151;
        }

        .consent input[type="checkbox"] {
            margin-top: 2px;
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            accent-color: var(--yamaha-blue);
            cursor: pointer;
        }

        .consent a {
            color: var(--yamaha-blue);
            font-weight: 600;
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            margin-top: 8px;
            background: var(--yamaha-red);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .04em;
            text-transform: uppercase;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            cursor: pointer;
            transition: background .15s;
        }

        .btn-submit:hover { background: var(--yamaha-red-dark); }

        .card__footer {
            background: #f9fafb;
            border-top: 1px solid #f1f1f1;
            padding: 14px 32px;
            text-align: center;
            font-size: 12.5px;
            color: #6b7280;
        }

        /* Estado de éxito */
        .success {
            text-align: center;
            padding: 28px 8px 18px;
        }

        .success__icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: #dcfce7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success__icon svg { width: 40px; height: 40px; color: #16a34a; }
        .success h2 { margin: 0 0 8px; font-size: 22px; color: #111827; }
        .success p { margin: 0 0 6px; color: #6b7280; font-size: 15px; }

        .success a.back {
            display: inline-block;
            margin-top: 18px;
            background: var(--yamaha-blue);
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 26px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="card">

        <div class="card__header">
            <img src="{{ asset('images/logoyamaha-fullwhitef.png') }}" alt="Yamaha"
                 onerror="this.style.display='none'">
            <h1>¡Bienvenido a la Familia Yamaha!</h1>
            <p class="subtitle">Completa tus datos para enterarte de nuestras novedades.</p>
            <p class="deadline">*Formulario válido para registro hasta el 31 de Julio del 2026</p>
        </div>

        @if (session('registro_exitoso'))
            {{-- Estado de éxito --}}
            <div class="card__body">
                <div class="success">
                    <div class="success__icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2>¡Registro Exitoso!</h2>
                    <p>Tu información se ha guardado correctamente.</p>
                    <p>¡Pronto tendremos más noticias para contarte!</p>
                    <a href="{{ route('promociones.registro') }}" class="back">Registrar otro</a>
                </div>
            </div>
        @else
            {{-- Formulario --}}
            <div class="card__body">

                @if ($errors->any())
                    <div class="global-error">Por favor corrige los errores indicados.</div>
                @endif

                <form method="POST" action="{{ route('promociones.registro.store') }}" novalidate>
                    @csrf

                    {{-- Tipo de documento --}}
                    <div class="form-group">
                        <label class="field-label" for="tipo_documento">
                            Tipo de Documento de Identidad <span class="req">*</span>
                        </label>
                        <select name="tipo_documento" id="tipo_documento"
                                class="select @error('tipo_documento') is-invalid @enderror">
                            <option value="">— Seleccione un tipo —</option>
                            @foreach ($tiposDocumento as $tipo)
                                <option value="{{ $tipo }}" @selected(old('tipo_documento') === $tipo)>{{ $tipo }}</option>
                            @endforeach
                        </select>
                        @error('tipo_documento') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Número de documento --}}
                    <div class="form-group">
                        <label class="field-label" for="numero_documento">
                            Número de Documento de Identidad <span class="req">*</span>
                        </label>
                        <input type="text" name="numero_documento" id="numero_documento"
                               value="{{ old('numero_documento') }}"
                               placeholder="Ingrese el número de documento" maxlength="20"
                               class="input @error('numero_documento') is-invalid @enderror">
                        @error('numero_documento') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nombres y apellidos --}}
                    <div class="form-group">
                        <label class="field-label" for="nombres_apellidos">
                            Nombres y Apellidos <span class="req">*</span>
                        </label>
                        <input type="text" name="nombres_apellidos" id="nombres_apellidos"
                               value="{{ old('nombres_apellidos') }}"
                               placeholder="Ej: Juan Pérez García"
                               class="input @error('nombres_apellidos') is-invalid @enderror">
                        @error('nombres_apellidos') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Celular --}}
                    <div class="form-group">
                        <label class="field-label" for="celular">
                            Celular <span class="req">*</span>
                        </label>
                        <input type="tel" name="celular" id="celular"
                               value="{{ old('celular') }}" maxlength="9"
                               placeholder="Ej: 987654321"
                               class="input @error('celular') is-invalid @enderror">
                        @error('celular') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Correo --}}
                    <div class="form-group">
                        <label class="field-label" for="correo">
                            Correo electrónico <span class="req">*</span>
                        </label>
                        <input type="email" name="correo" id="correo"
                               value="{{ old('correo') }}"
                               placeholder="correo@ejemplo.com"
                               class="input @error('correo') is-invalid @enderror">
                        @error('correo') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    {{-- Consentimientos --}}
                    <div class="consents">
                        {{-- Política de Privacidad (obligatorio) --}}
                        <div class="consent @error('acepta_privacidad') is-invalid @enderror">
                            <label>
                                <input type="checkbox" name="acepta_privacidad" id="acepta_privacidad"
                                       value="1" @checked(old('acepta_privacidad'))>
                                <span>
                                    He leído y acepto la
                                    <a href="https://www.yamaha-motor.com.pe/politicas-privacidad"
                                       target="_blank" rel="noopener noreferrer">Política de Privacidad</a>
                                    <span class="req">*</span>
                                </span>
                            </label>
                            @error('acepta_privacidad') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>

                        {{-- Fines promocionales (opcional) --}}
                        <div class="consent">
                            <label>
                                <input type="checkbox" name="acepta_promociones" id="acepta_promociones"
                                       value="1" @checked(old('acepta_promociones'))>
                                <span>
                                    Autorizo el tratamiento de mis datos personales para fines promocionales, lo que
                                    incluye el envío de información comercial, novedades, beneficios y la participación
                                    en futuras campañas promocionales y sorteos organizados por Yamaha Motor del Perú.
                                </span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Registrarme</button>
                </form>
            </div>
        @endif

        <div class="card__footer">
            © {{ date('Y') }} Yamaha Motor del Perú S.A.
        </div>
    </div>

    <script>
        // UX: el número de documento se limita según el tipo. DNI/RUC solo dígitos.
        (function () {
            var tipo = document.getElementById('tipo_documento');
            var numero = document.getElementById('numero_documento');
            if (!tipo || !numero) return;

            function aplicarReglas() {
                var t = tipo.value;
                var max = (t === 'DNI') ? 8 : (t === 'RUC') ? 11 : 20;
                numero.setAttribute('maxlength', max);

                if (t === 'DNI' || t === 'RUC') {
                    numero.value = numero.value.replace(/\D/g, '').slice(0, max);
                    numero.setAttribute('inputmode', 'numeric');
                } else {
                    numero.value = numero.value.slice(0, max);
                    numero.setAttribute('inputmode', 'text');
                }
            }

            tipo.addEventListener('change', aplicarReglas);
            numero.addEventListener('input', aplicarReglas);
            aplicarReglas();
        })();
    </script>
</body>
</html>
