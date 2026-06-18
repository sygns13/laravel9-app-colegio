const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Ventas",
            subtituloHeader: "Reportes",
            subtitulo2Header: "Ventas",

            subtitle2Header: true,
            pdfUrl: null,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            buscarCodigoItem: '',
            tipoDocumentos: [],
            camerasDisponibles: [],
            selectedCameraId: '',
            camerasQrDisponibles: [],
            selectedCameraQrId: '',
            camarasInicializadas: false,
            arrayItems: [],
            arrayTipoSales: [],
            arraytipoDocumentos: [],
            errors: [],
            renderqr: true,

            fillobject: {
                'type':'C',
                'id': '',
                'fechaIni': '',
                'fechaFin': '',
                'year': '',
                'numero': '',
                'tipo_documento_id': '0',
                'documento': '',
                'tipo_sales_id': '0',
                'observacion': '0',
            },
            fillobjectEdit: {
                'type':'C',
                'id': '',
                'fechaIni': '',
                'fechaFin': '',
                'year': '',
                'numero': '',
                'tipo_documento_id': '0',
                'documento': '',
                'tipo_sales_id': '0',
                'observacion': '0',
            },

            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset: 9,

            buscar: '',
            divFormulario: false,
            divloaderNuevo: false,

            mostrarPalenIni: true,

            thispage: '1',
            divprincipal: false,
            montoTotal: 0,

            labelBtnSave: 'Registrar',
            turnoNombre : '',

        }
    },
    created: function() {
        this.fillobjectEdit.fechaIni = fechaHoy;
        this.fillobjectEdit.fechaFin = fechaHoy;
    },
    mounted: function() {
        // La cámara NO se inicia al cargar el módulo. Solo se enumeran las cámaras
        // y se enciende el stream cuando el usuario abre el modal correspondiente.
        const modalQR = $('#modalQR');

        // 💡 CUANDO EL MODAL SE MUESTRE COMPLETAMENTE
        modalQR.on('shown.bs.modal', async () => {
            console.log("Modal mostrado, iniciando escáner...");
            await this.obtenerYSeleccionarCamara();
            this.iniciarEscaneo();
        });

        // 💡 CUANDO EL MODAL SE OCULTE COMPLETAMENTE
        modalQR.on('hidden.bs.modal', () => {
            console.log("Modal oculto, deteniendo escáner...");
            this.detenerEscaneo();
        });


        $('#modalVoucher').on('shown.bs.modal', async () => {
            await this.obtenerYSeleccionarCamara();
            setTimeout(() => {
                this.iniciarCamaraVoucher();
            }, 300);
        });
        $('#modalVoucher').on('hidden.bs.modal', () => {
            this.cerrarCamaraVoucher();
        });
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset
            var from2 = this.pagination.current_page - this.offset
            if (from < 1) {
                from = 1;
            }

            var to = from2 + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    filters: {
    },
    methods: {
        async obtenerYSeleccionarCamara()  {
            // Idempotente: solo enumera y pide permiso la primera vez por carga de página.
            // Así abrir/cerrar los modales no vuelve a disparar el prompt de permisos.
            if (this.camarasInicializadas) {
                return;
            }
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

                this.camarasInicializadas = true;

            } catch (error) {
                // Esto se ejecuta si el usuario niega el permiso o si ocurre otro error.
                console.error("Error al acceder a los dispositivos de medios:", error);
                alert("No se pudo acceder a la cámara. Por favor, verifica los permisos en tu navegador.");
            }
        },
        openModal(fileName, path) {
            // Generar la URL del archivo PDF
            this.pdfUrl = `${path}/${fileName}`;
            console.log(this.pdfUrl);
            $('#pdfModal').modal('show');
        },
        abrirCamaraVoucher: function () {

            $("#modalVoucher").modal('show');

        },
        calcularMontoTotal() {
            this.montoTotal = this.arrayItems.reduce((total, item) => {
                return total + (item.total || 0);
            }, 0).toFixed(2);
        },
        verDetalle(sales) {
            this.fillobject.id = sales.id;
            this.fillobject.nombres = sales.clientes.nombres;
            this.fillobject.apellidos = sales.clientes.apellidos;
            this.fillobject.celular = sales.clientes.celular;
            this.fillobject.correo = sales.clientes.correo;
            this.fillobject.documento = sales.clientes.documento;
            var url = 'reventas/' + sales.id + '/edit';
            axios.get(url).then(response => {
                this.arrayItems = response.data.registros;
                console.log(this.arrayItems);
                this.calcularMontoTotal();
                $('#modalDetalle').modal('show');
            })
        },
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
            if (this.buscarCodigoItem != null && this.buscarCodigoItem != '') {
                var url = 'item/buscar';

                axios.post(url, {
                    codigo: this.buscarCodigoItem
                }).then(response => {
                    console.log("respuesta añadir item",response.data.item);
                    if (response.data.result === '1' && response.data.resultFound && response.data.item != null) {
                        let item = response.data.item;
                        let indexExistente = this.arrayItems.findIndex(i => i.item.id === item.id);

                        if (indexExistente !== -1) {
                            this.arrayItems[indexExistente].cantidad += 1;
                        } else {
                            let nuevoDetalle = {
                                id: null,
                                sale_id: null,
                                item_id: item.id,
                                cantidad: 1,
                                total: item.precio,
                                item: item
                            };
                            this.arrayItems.push(nuevoDetalle);
                            this.calcularMontoTotal();
                        }
                        this.buscarCodigoItem="";
                    } else {
                        toastr.error("No se encontró Item con el código ingresado", { timeOut: 20000 });
                    }
                });
            }
        },
        imprimirCargo() {
            this.$nextTick(() => {
                const contenidoElement = document.getElementById('contenidoCargo');
                if (!contenidoElement) {
                    this.mensajeError("No se encontró el contenido del cargo para imprimir");
                    return;
                }

                const baseUrl = window.location.origin;
                const contenido = contenidoElement.innerHTML.replaceAll(
                    /src="img\//g,
                    `src="${baseUrl}/img/`
                );

                const ventana = window.open('', '_blank', 'width=800,height=600');
                ventana.document.write(`
                    <html>
                      <head>
                        <title>Cargo de Solicitud</title>
                        <style>
                          body { font-family: Arial, sans-serif; font-size: 13px; padding: 20px; }
                          table { width: 100%; border-collapse: collapse; }
                          td { padding: 5px; vertical-align: top; }
                          .text-center { text-align: center; }
                          .text-right { text-align: right; }
                          .text-left { text-align: left; }
                          .titulo { font-size: 16px; font-weight: bold; margin-bottom: 20px; text-align: center; }
                          img { max-height: 80px; }
                        </style>
                      </head>
                      <body>
                        ${contenido}
                      </body>
                    </html>
                `);
                ventana.document.close();

                // Esperar que todas las imágenes se carguen (incluyendo el QR)
                ventana.onload = () => {
                    const qrImg = ventana.document.querySelector('img[src*="qrserver"]');
                    if (qrImg && !qrImg.complete) {
                        qrImg.onload = () => {
                            ventana.focus();
                            ventana.print();
                            ventana.close();
                        };
                    } else {
                        ventana.focus();
                        ventana.print();
                        ventana.close();
                    }
                };
            });
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
        buscarCliente: function() {
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
                    } else if(response.data.resultFoundExterno && response.data.clienteExterno!=null){
                        // No se encontró en la BD local: se completa con el nombre/razón social de Migo
                        this.fillobject.cliente_id = null;
                        this.fillobject.nombres = response.data.clienteExterno.nombres;
                        this.fillobject.apellidos = null;
                    }
                })
            }
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
        editarSales(idsales) {
            console.log(idsales);
            this.fillobject.id = idsales;
            var url = 'reventas/' + idsales + '/';
            axios.get(url).then(response => {
                this.arrayItems = response.data.registros;
                this.arrayTipoSales = response.data.tipoSales;
                this.arraytipoDocumentos = response.data.tipoDocumentos;

                this.fillobject.tipo_documento_id=response.data.sales.clientes.tipo_documento_id;
                this.fillobject.tipo_sales_id=response.data.sales.tipo_sales_id;
                this.fillobject.voucher=response.data.sales.voucher;
                this.fillobject.observacion=response.data.sales.observacion;
                console.log("voucher",this.fillobject.voucher);
                this.fillobject.documento=response.data.sales.clientes.documento;
                this.fillobject.celular=response.data.sales.clientes.celular;
                this.fillobject.nombres=response.data.sales.clientes.nombres;
                this.fillobject.correo=response.data.sales.clientes.correo;
                console.log("arrayItems", this.arrayItems);
                this.calcularMontoTotal();
                $('#modalEditar').modal('show');
            })
        },
        buscarDatos: function(page) {
            var fechaIni = this.fillobjectEdit.fechaIni;
            var fechaFin = this.fillobjectEdit.fechaFin;
            var tipo_sales = this.fillobjectEdit.tipo_sales_id;
            var tipo_documento_id = this.fillobjectEdit.tipo_documento_id;
            var documento = this.fillobjectEdit.documento;

            var url = 'reventas?page=' + page + '&fechaIni=' + fechaIni + '&fechaFin=' + fechaFin + '&tipoSales=' + tipo_sales + '&tipo_documento_id=' + tipo_documento_id + '&documento=' + documento;

            axios.get(url).then(response => {

                this.registros= response.data.registros.data;
                this.pagination= response.data.pagination;

                //this.mostrarPalenIni=true;

                if(this.registros.length==0 && this.thispage!='1'){
                    var a = parseInt(this.thispage) ;
                    a--;
                    this.thispage=a.toString();
                    this.changePage(this.thispage);
                }
            })
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.buscarDatos(page);
            this.thispage = page;
        },


        imprimirCotización: function(id) {
            url = 'reportepdf/imprimir-cotizacion/' + id;
            //console.log(url);
            //window.open(url, '_blank').focus();
            window.location.href = url;
        },

        exportarExcel: function() {
            var fechaIni = this.fillobjectEdit.fechaIni;
            var fechaFin = this.fillobjectEdit.fechaFin;
            var tipo_sales = this.fillobjectEdit.tipo_sales_id;
            var tipo_documento_id = this.fillobjectEdit.tipo_documento_id;
            var documento = this.fillobjectEdit.documento;

            url = 'reporteventaxls/export?fechaIni=' + fechaIni + '&fechaFin=' + fechaFin + '&tipoSales=' + tipo_sales + '&tipo_documento_id=' + tipo_documento_id + '&documento=' + documento;
            //console.log(url);
            //window.open(url, '_blank').focus();
            window.location.href = url;
        },
        exportarExcelDetalle: function() {
            this.fillobject.id;
            url = 'reporteventadetallexls/export?idsales=' + this.fillobject.id;
            //console.log(url);
            //window.open(url, '_blank').focus();
            window.location.href = url;
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



        nuevo:function () {
            this.cancelForm();
            this.labelBtnSave = 'Registrar';
            this.fillobject.type = 'C';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#cbutipo_documento_id').focus();
            });
        },
        cerrarForm: function () {
            this.divFormulario=false;
            this.cancelForm();
        },
        cancelForm: function () {
            this.fillobject = {
                'type':'C',
                'id': '',
                'fechaIni': fechaHoy,
                'fechaFin': fechaHoy,
                'year': '',
                'numero': '',
                'tipo_documento_id': '0',
                'documento': '',
                'observacion': '',
            };

            this.$nextTick(() => {
                $('#txthoraini').focus();
            });
        },
        procesar: function() {
            const { tipo_sales_id, tipo_documento_id, documento, nombres, celular, correo } = this.fillobject;
            if (tipo_sales_id <= 0) {
                return toastr.error("Debe seleccionar el tipo de proceso", { timeOut: 20000 });
            }
            if (tipo_documento_id <= 0) {
                return toastr.error("Debe seleccionar el tipo de documento del cliente", { timeOut: 20000 });
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

            if (tipo_sales_id === 1) {
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

            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la actualización de la Venta",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {
                if (result.value) {
                    this.update();
                }
            }).catch(swal.noop);
        },
        update: function () {
            const formData = new FormData();
            const esEdicion = !!this.fillobject.id; // true si estamos editando

            if (this.fillobject.voucher && this.fillobject.voucher.startsWith('data:image')) {
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

            for (let key in this.fillobject) {
                if (key !== 'voucher') {
                    formData.append(key, this.fillobject[key]);
                }
            }

            formData.append('items', JSON.stringify(this.arrayItems));

            const url = esEdicion ? `reventas/${this.fillobject.id}` : `reventas`;
            const method = esEdicion ? 'post' : 'post';

            // Agrega el método spoofing para PUT
            if (esEdicion) {
                formData.append('_method', 'PUT');
            }

            axios.post(url, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then(response => {
                if (response.data.result === '1') {
                    toastr.success(response.data.msj, { timeOut: 20000 });
                    $('#modalEditar').modal('hide');
                    this.buscarDatos(this.thispage);
                } else {
                    toastr.error(response.data.msj, { timeOut: 20000 });
                }
            }).catch(error => {
                console.error(error);
                toastr.error("Ocurrió un error al guardar la venta", { timeOut: 20000 });
            });
        },
        edit:function (dato) {

            this.cancelForm();
            this.fillobject.id=dato.id;
            this.fillobject.horaini=dato.horaini;
            this.fillobject.horafin=dato.horafin;
            this.fillobject.tipo=dato.tipo;
            this.labelBtnSave = 'Modificar';
            this.fillobject.type = 'U';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#txthorainiE').focus();
            });

        },
        borrar:function (dato) {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Eliminar el registro de la Hora",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.delete(dato);
                }

            }).catch(swal.noop);
        },
        delete:function (dato) {
            var url = 'rehora/'+dato.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos(this.thispage);//listamos
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },

        updateRegistrado(venta) {
            // payload mínimo
            const payload = {
                registrado:  venta.registrado ? 1 : 0,
                responsable: venta.registrado ? venta.responsable : ''
            };

            axios
                .patch(`reventas/registrado/${venta.id}`, payload)
                .then(() => {
                toastr.success('Actualizado correctamente', { timeOut: 2000 });
                })
                .catch(err => {
                console.error(err);
                toastr.error('Fallo al actualizar', { timeOut: 5000 });
                // opcional: revertir cambios en UI si falla
                });
        },

        updateEntregado(venta) {
            // payload mínimo
            const payload = {
                entregado:  venta.entregado ? 1 : 0,
            };

            axios
                .patch(`reventas/entregado/${venta.id}`, payload)
                .then(() => {
                toastr.success('Actualizado correctamente', { timeOut: 2000 });
                })
                .catch(err => {
                console.error(err);
                toastr.error('Fallo al actualizar', { timeOut: 5000 });
                // opcional: revertir cambios en UI si falla
                });
        }
    }
}).mount('#app')
