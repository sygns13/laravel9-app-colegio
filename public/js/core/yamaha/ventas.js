const {
    createApp
} = Vue

createApp({
    data() {
        return {
            html5QrCode: null,
            videoStream: null,
            tituloHeader: "Registrar Ventas",
            subtituloHeader: "Módulo",
            subtitulo2Header: "Registrar Ventas",
            subtitle2Header: true,
            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            errors: [],

            fillobject: {
                'type':'C',
                'cliente_id': 0,
                'tipo_documento_id': '1',
                'tipo_sales_id': '1',
                'documento': '',
                'nombres': '',
                'apellidos': '',
                'celular': '',
                'correo': '',
                'voucher': '',
                'registrado': 0,
                'responsable': '',
                'observacion': '',
            },
            offset: 9,

            buscarCodigoItem: '',
            arrayItems: [],

            camerasDisponibles: [],
            selectedCameraId: '',
            camerasQrDisponibles: [],
            selectedCameraQrId: '',

            divFormulario: false,
            divloaderNuevo: false,

            mostrarPalenIni: true,

            thispage1: '1',
            thispage2: '1',
            divprincipal: false,

            labelBtnSave: 'Complete el siguiente Formulario para Registrar una nueva Venta',
            maxLengthDocumento: 8,
            archivo : null,
            uploadReady: true,

            renderqr: true,
            montoTotal: 0,

            multiItems: [],

            procesando: false,

        }
    },
    created: function() {
    },
    mounted: function() {
        this.obtenerYSeleccionarCamara();


        const modalQR = $('#modalQR');

        // 💡 CUANDO EL MODAL SE MUESTRE COMPLETAMENTE
        modalQR.on('shown.bs.modal', () => {
            console.log("Modal mostrado, iniciando escáner...");
            this.iniciarEscaneo();
        });

        // 💡 CUANDO EL MODAL SE OCULTE COMPLETAMENTE
        modalQR.on('hidden.bs.modal', () => {
            console.log("Modal oculto, deteniendo escáner...");
            this.detenerEscaneo();
        });


        $('#modalVoucher').on('shown.bs.modal', () => {
            setTimeout(() => {
                this.iniciarCamaraVoucher();
            }, 300);
        });
        $('#modalVoucher').on('hidden.bs.modal', () => {
            this.cerrarCamaraVoucher();
        });
    },
    computed: {

    },
    filters: {

    },
    methods: {
        async obtenerYSeleccionarCamara()  {
            try {
                // 1. Solicita permiso para usar el video. Esto es CRUCIAL.
                // La promesa se resolverá una vez que el usuario acepte el permiso.
                await navigator.mediaDevices.getUserMedia({ video: true });

                // 2. Ahora que tienes permiso, enumera los dispositivos.
                // Los 'labels' de los dispositivos ya no estarán vacíos.
                const devices = await navigator.mediaDevices.enumerateDevices();

                // 3. Filtra solo los dispositivos de video (cámaras).
                const videoDevices = devices.filter(device => device.kind === 'videoinput');

                // Asigna la lista completa para tu uso.
                this.camerasQrDisponibles = videoDevices;

                console.log("Cámaras detectadas:", videoDevices);

                // 4. Tu lógica para encontrar la cámara trasera (ahora sí funcionará).
                const camBack = videoDevices.find(cam => cam.label.toLowerCase().includes('back'));

                // 5. Asigna el ID de la cámara seleccionada.
                if (camBack) {
                    this.selectedCameraQrId = camBack.deviceId;
                    this.selectedCameraId = camBack.deviceId;
                    console.log("Cámara trasera encontrada:", camBack);
                } else if (videoDevices.length > 0) {
                    // Si no hay cámara "back", usa la primera de la lista como respaldo.
                    this.selectedCameraQrId = videoDevices[0].deviceId;
                    this.selectedCameraId = videoDevices[0].deviceId;
                    console.log("No se encontró cámara trasera, usando la primera disponible:", videoDevices[0]);
                } else {
                    // Si no hay ninguna cámara.
                    this.selectedCameraQrId = '';
                    this.selectedCameraId = '';
                    console.warn("No se encontró ninguna cámara.");
                }

            } catch (error) {
                // Esto se ejecuta si el usuario niega el permiso o si ocurre otro error.
                console.error("Error al acceder a los dispositivos de medios:", error);
                alert("No se pudo acceder a la cámara. Por favor, verifica los permisos en tu navegador.");
            }
        },
        buscarCliente: function(event) {
            if (event?.target?.id === 'cbutipo_documento_id') {
                this.fillobject.documento = '';
            }
            const selectedOption = document.querySelector('#cbutipo_documento_id option:checked');
            const digitos = selectedOption ? selectedOption.getAttribute('data-digitos') : null;
            this.maxLengthDocumento = digitos ? parseInt(digitos) : 20;

            if(this.fillobject.tipo_documento_id != null && this.fillobject.tipo_documento_id != "0" && this.fillobject.documento != null && this.fillobject.documento != ''){

                var url = 'reclientebuscar/buscar/' + this.fillobject.tipo_documento_id + '/' + this.fillobject.documento;

                axios.get(url).then(response => {
                    //console.log(response.data);

                    if(response.data.result=='1' && response.data.resultFound && response.data.cliente!=null){
                        this.fillobject.cliente_id = response.data.cliente.id;
                        this.fillobject.nombres = response.data.cliente.nombres;
                        this.fillobject.apellidos = response.data.cliente.apellidos;
                        this.fillobject.celular = response.data.cliente.celular;
                        this.fillobject.correo = response.data.cliente.correo;
                    }
                })
            }
        },

        forzarLargoMaximo() {
            const doc = this.fillobject.documento;
            if (doc && doc.length > this.maxLengthDocumento) {
                this.fillobject.documento = doc.slice(0, this.maxLengthDocumento);
            }
        },
        calcularMontoTotal() {
            this.montoTotal = this.arrayItems.reduce((total, item) => {
                const subtotal = (item.precio || 0) * (item.cantidad || 0);
                return total + subtotal;
            }, 0).toFixed(2);
        },
        iniciarCamaraVoucher() {
            const constraints = {
                video: {
                    deviceId: this.selectedCameraId ? { exact: this.selectedCameraId } : undefined
                }
            };

            navigator.mediaDevices.getUserMedia(constraints)
                .then(stream => {
                    this.videoStream = stream;
                    const video = document.getElementById('videoVoucher');
                    video.srcObject = stream;
                    video.play();
                })
                .catch(err => {
                    console.error("Error al acceder a la cámara", err);
                    toastr.error("No se pudo acceder a la cámara", { timeOut: 20000 });
                });
        },
        cerrarCamaraVoucher() {
            if (this.videoStream) {
                this.videoStream.getTracks().forEach(track => track.stop());
            }
        },
        /*
        mostrarStream:function(idDeDispositivo, renderInit) {
            $video = document.querySelector("#videoVoucher");
            $boton = document.querySelector("#boton");
            $canvas = document.querySelector("#canvasVoucher");

            //Config para Safari
            $video.setAttribute('autoplay', '');
            $video.setAttribute('muted', '');
            $video.setAttribute('playsinline', '');

            // Creamos el stream
            this._getUserMedia({
                    audio: false,
                    video: {
                        // Justo aquí indicamos cuál dispositivo usar
                        deviceId: idDeDispositivo,
                        facingMode: 'user',
                    }
            }).then(function(streamObtenido) {
                    // Aquí ya tenemos permisos, ahora sí llenamos el select,
                    // pues si no, no nos daría el nombre de los dispositivos
                    if(renderInit){
                        this.llenarSelectConDispositivosDisponibles();
                    }
                    this.listaDeDispositiv = idDeDispositivo;

                    // Simple asignación
                    this.stream = streamObtenido;

                    // Mandamos el stream de la cámara al elemento de vídeo
                    $video.srcObject = this.stream;
                    $video.play();

                }, (error) => {
                    console.log("Permiso denegado o error: ", error);
                    $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
                }).catch(function(error) {
                    console.log("Permiso denegado o error: ", error);
                    $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
                });
        },*/
        changeDispositivo2:function () {
            if (this.stream) {
                this.stream.getTracks().forEach(function(track) {
                    track.stop();
                });
            }
            // Mostrar el nuevo stream con el dispositivo seleccionado
            this.iniciarCamaraVoucher();
        },

        capturarVoucher() {
            const video = document.getElementById('videoVoucher');
            const canvas = document.getElementById('canvasVoucher');
            const context = canvas.getContext('2d');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            this.fillobject.voucher = canvas.toDataURL('image/png'); // Guarda la imagen como base64
            $('#modalVoucher').modal('hide');
            this.cerrarCamaraVoucher();
        },
        buscarItem: function() {
            if (this.buscarCodigoItem != null && this.buscarCodigoItem !== '') {
                /*
                var url = 'item/buscar/' + this.buscarCodigoItem;

                axios.get(url).then(response => {
                    if (response.data.result === '1' && response.data.resultFound && response.data.item != null) {
                        let item = response.data.item;
                        let indexExistente = this.arrayItems.findIndex(i => i.id === item.id);

                        if (indexExistente !== -1) {
                            this.arrayItems[indexExistente].cantidad += 1;
                        } else {
                            item.cantidad = 1;
                            this.arrayItems.push(item);
                        }
                        this.buscarCodigoItem="";
                    } else {
                        toastr.error("No se encontró Item con el código ingresado", { timeOut: 20000 });
                    }
                });
                */
               var url = 'item/buscar';

                axios.post(url, {
                    codigo: this.buscarCodigoItem
                })
                .then(response => {
                    if (response.data.result === '1' && response.data.resultFound) {
                        let item = response.data.item;
                        let items = response.data.items;

                        if (response.data.single) {
                            this.procesarItem(item);
                        } else {
                            // múltiples: abrimos modal para seleccionar
                            this.multiItems = items;
                            $('#multiSelectModal').modal('show');
                        }
                    } else {
                        toastr.error("No se encontró Item con el código ingresado", { timeOut: 20000 });
                    }
                })
                .catch(error => {
                    console.error(error);
                    toastr.error("Error al comunicarse con el servidor", { timeOut: 20000 });
                });
            }else{
                toastr.error("Debe ingresar el código del Item", { timeOut: 20000 });
            }
        },

        procesarItem(item) {
            const idx = this.arrayItems.findIndex(i => i.id === item.id);
            if (idx !== -1) {
                this.arrayItems[idx].cantidad += 1;
            } else {
                item.cantidad = 1;
                this.arrayItems.push(item);
            }
            this.calcularMontoTotal();
            this.buscarCodigoItem = '';
        },
        selectItem(item) {
            this.procesarItem(item);
            this.closeModal();
        },
        closeModal() {
            $('#multiSelectModal').modal('hide');
            this.multiItems = [];
        },

        eliminarItem(index) {
            this.arrayItems.splice(index, 1);
            this.calcularMontoTotal();
        },
        recalcularTotal(item) {
            /*
            if (item.cantidad < 0) {
                item.cantidad = 1;
            }*/
            this.calcularMontoTotal();
        },
        iniciarEscaneo() {
            this.html5QrCode = new Html5Qrcode("reader");

            const cameraId = this.selectedCameraQrId;

            if (!cameraId) {
                toastr.error("No se ha seleccionado una cámara", { timeOut: 20000 });
                return;
            }

            this.html5QrCode.start(
                cameraId,
                { fps: 10, qrbox: { width: 250, height: 250 } },
                (decodedText, decodedResult) => {
                    this.html5QrCode.stop().then(() => {
                        document.getElementById('reader').innerHTML = '';
                        this.buscarCodigoItem = decodedText;
                        this.buscarItem();
                        $('#modalQR').modal('hide');
                    });
                },
                errorMessage => {
                    // Puedes ignorar errores de escaneo
                    console.log("Mensaje de error del escáner:", errorMessage);
                }
            ).catch(err => {
                console.error("No se pudo iniciar la cámara", err);
            });
        },
        detenerEscaneo() {
            if (this.html5QrCode) {
                this.html5QrCode.stop().then(() => {
                    this.html5QrCode.clear();
                    document.getElementById('reader').innerHTML = '';
                }).catch(err => {
                    console.error("Error al detener el escaneo", err);
                });
            }
        },
        eliminarVoucher() {
            this.fillobject.voucher = '';
        },
        nuevo:function () {
            this.cancelForm();
            this.labelBtnSave = 'Registrar';
            this.fillobject.type = 'C';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#txttipo').focus();
            });
        },
        abrirCamaraVoucher: function () {

            $("#modalVoucher").modal('show');

        },
        cancelar: function () {

            this.fillobject = {
                'type':'C',
                'cliente_id': 0,
                'tipo_documento_id': '1',
                'tipo_sales_id': '1',
                'documento': '',
                'nombres': '',
                'apellidos': '',
                'celular': '',
                'correo': '',
                'observacion': ''
            };
            this.arrayItems = [];
            this.montoTotal = 0;

        },
        toggleResponsable() {
            if (!this.fillobject.registrado) {
                this.fillobject.responsable = '';
            }
        },
        procesar: function() {
            const { tipo_sales_id, tipo_documento_id, documento, nombres, celular, correo } = this.fillobject;

            if (tipo_sales_id === "1") {
                if (!correo) {
                    return toastr.error("Debe ingresar el correo del cliente", { timeOut: 20000 });
                }
                if (this.arrayItems.length === 0) {
                    return toastr.error("Debe agregar al menos un item", { timeOut: 20000 });
                }
                if (!this.fillobject.voucher) {
                    return toastr.error("Debe capturar una imagen del voucher", { timeOut: 20000 });
                }
            }

            if (tipo_documento_id <= 0) {
                return toastr.error("Debe seleccionar el tipo de documento del cliente", { timeOut: 20000 });
            }
            if (tipo_sales_id <= 0) {
                return toastr.error("Debe seleccionar el tipo de venta", { timeOut: 20000 });
            }
            if (!documento) {
                return toastr.error("Debe ingresar el número de documento del cliente", { timeOut: 20000 });
            }
            if (!nombres) {
                return toastr.error("Debe ingresar el nombre del cliente", { timeOut: 20000 });
            }
            if (!celular) {
                return toastr.error("Debe ingresar el celular del cliente", { timeOut: 20000 });
            }



            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar el Registro de la Venta",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {
                if (result.value) {
                    this.create();
                }
            }).catch(swal.noop);
        },
        create: function () {

            this.procesando = true;
            const formData = new FormData();

            if (this.fillobject.voucher) {
                const byteString = atob(this.fillobject.voucher.split(',')[1]);
                const mimeString = this.fillobject.voucher.split(',')[0].split(':')[1].split(';')[0];
                const ab = new ArrayBuffer(byteString.length);
                const ia = new Uint8Array(ab);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                const blob = new Blob([ab], { type: mimeString });
                formData.append('voucher', blob, `voucher-${this.fillobject.documento}.jpg`);
            }

            // Agregar el resto de datos
            for (let key in this.fillobject) {
                if (key !== 'voucher') {
                    formData.append(key, this.fillobject[key]);
                }
            }

            formData.append('items', JSON.stringify(this.arrayItems));

            axios.post('reventas', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then(response => {
                this.procesando = false;
                this.divloaderNuevo = false;
                if (response.data.result === '1') {
                    toastr.success(response.data.msj, { timeOut: 20000 });
                    this.cancelar();
                } else {
                    toastr.error(response.data.msj, { timeOut: 20000 });
                }
            }).catch(error => {
                this.procesando = false;
                console.error(error);
                toastr.error("Ocurrió un error al registrar la venta", { timeOut: 20000 });
            });
        },
        async changeDispositivo() {
            // Verifica si el escáner está activo antes de intentar detenerlo
            if (this.html5QrCode && this.html5QrCode.isScanning) {
                try {
                    // Espera a que la cámara actual se detenga por completo
                    await this.html5QrCode.stop();
                    console.log("Escáner detenido para cambiar de dispositivo.");
                } catch (err) {
                    console.error("Error al detener el escáner para el cambio:", err);
                }
            }

            const miDivReader = document.getElementById("reader");
            miDivReader.innerHTML = "";
            this.renderqr = false;
            this.renderqr = true;
            this.iniciarEscaneo();
        },
    },
}).mount('#app')
