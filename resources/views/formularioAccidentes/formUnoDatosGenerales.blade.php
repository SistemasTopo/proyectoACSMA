<style>
    .headingcontainer {
        margin-top: 10px;
        width: auto;
    }

    /* HEADING 3*/

    .heading3 h3 {
        overflow: hidden;
        text-align: center;
        /* text-transform: uppercase; */
        letter-spacing: 3px;
        font-size: 26px;
    }

    .heading3 h3:before,
    .heading3 h3:after {
        content: '';
        display: inline-block;
        height: 2px;
        position: relative;
        top: -2px;
        vertical-align: middle;
    }

    .heading3 h3:before {
        background-color: #ff781f;
        left: -.5em;
        margin-left: -100%;
        width: 100%;
    }

    .heading3 h3:after {
        background-color: #ff781f;
        left: .5em;
        margin-right: -100%;
        width: 100%;
    }
</style>

<!--  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- AUTO ACOMPLETAR INFOMACION DE LOS EMPLEADOS >VISTA HEALTH SECTION< -->
<script>
    function limit(element) {
        var max_chars = 3;
        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
    }

    $(document).ready(function() {
        fetchEmployee();
        // don´t allow user to submit if they´re
        // focused on any input field
        $(".form-control").keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });

        function fetchEmployee(query = '') {
            $.ajax({
                    url: "/call",
                    context: this,
                    method: 'GET',
                    cache: false,
                    data: {
                        query: query
                    },
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.employeeName == undefined) {

                        Swal.fire({
                            position: 'center',
                            title: 'Usuario no registrado',
                            text: 'El empleado aun no ha sido registrado, por lo cual debera llenar todos los datos con la informacion de dicho empleado ' +
                                'posteriormente se guardara en la base de datos y en futuros registros ya cumplira con el autollenado ' +
                                'Gracias',
                            imageUrl: '/img/logo.png',
                            imageWidth: 250,
                            imageHeight: 100,
                            showConfirmButton: true,
                        });

                        document.getElementById('involvedName1').value = '';
                        document.getElementById('involvedSurname1').value = '';
                        document.getElementById('involvedSurnameM1').value = '';
                        document.getElementById('involvedRFC1').value = '';
                        document.getElementById('involvedCurp1').value = '';
                        document.getElementById('involvedNumber1').value = '';
                        document.getElementById('involvedSeniorityCompany1').value = '';
                        document.getElementById('involvedHabitualOccupation1').value = '';
                        document.getElementById('involvedOccupationPerformed1').value = '';
                        // 
                        document.getElementById('involvedCode1').value = '';
                        document.getElementById('form1Numero').value = '';
                        document.getElementById('form1Calle').value = '';
                        document.getElementById('form1Colonia').value = '';
                        document.getElementById('form1Municipio').value = '';
                        document.getElementById('form1MunicipioEntidadFederativa').value = '';
                    } else {
                        document.getElementById('involvedName1').value = data.employeeName;
                        document.getElementById('involvedSurname1').value = data.employeeLastNameP;
                        document.getElementById('involvedSurnameM1').value = data.employeeLastNameM;
                        document.getElementById('involvedRFC1').value = data.employeeRfc;
                        document.getElementById('involvedCurp1').value = data.employeeCurp;
                        document.getElementById('involvedNumber1').value = data.employeeNss;
                        document.getElementById('involvedSeniorityCompany1').value = data.employeeAdmissionDate;
                        document.getElementById('involvedHabitualOccupation1').value = data.employeePosition;
                        document.getElementById('involvedOccupationPerformed1').value = data.employeePosition;
                        // 
                        document.getElementById('involvedCode1').value = data.employeeCP;
                        document.getElementById('form1Numero').value = data.employeeNumberHouse;
                        document.getElementById('form1Calle').value = data.employeeStreet;
                        document.getElementById('form1Colonia').value = data.employeeColoni;
                        document.getElementById('form1Municipio').value = data.employeeMunicipio;
                        document.getElementById('form1MunicipioEntidadFederativa').value = data.employeeEstado;
                    }
                });

            function callback() {
                $('#health-Name').val(data.employeeName);
            }
        }

        $(document).on('keyup', '#health-EmployeeNumber', function() {
            var query = $(this).val();
            fetchEmployee(query);
        });
    });
</script>


<div class="card-header header">
    <h2 style="text-align:center;"> <strong> Datos generales del personal involucrado </strong> </h2>
</div>


<!--  -->
<div class="headingcontainer">
    <div class="heading3">
        <h3 id="colorSup">Supervisor</h3>
    </div>
</div>

<div class="divForm form-group">
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1EncargadoArea">Encargado del área: </label>
                <input class="form-control" id="form1EncargadoArea" name="form1EncargadoArea" type="text" value="{{isset($registroAccidente->form1EncargadoArea)?$registroAccidente->form1EncargadoArea:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1HoraAviso">Hora del aviso: </label>
                <input class="form-control" id="form1HoraAviso" name="form1HoraAviso" type="time" value="{{isset($registroAccidente->form1HoraAviso)?$registroAccidente->form1HoraAviso:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Lugar">Lugar: </label>
                <select name="form1Lugar" id="form1Lugar" class="form-control">
                    <option {{ isset($registroAccidente->form1Lugar) == 'Centro de servicios TOPO' ? 'selected' : '' }} value="Centro de servicios TOPO">Centro de servicios TOPO</option>
                    <option {{ isset($registroAccidente->form1Lugar) == 'Proyecto MDM 5000' ? 'selected' : '' }} value="Proyecto MDM 5000">Proyecto MDM 5000</option>
                    <option {{ isset($registroAccidente->form1Lugar) == 'Servicio de transporte de personal' ? 'selected' : '' }} value="Servicio de transporte de personal">Servicio de transporte de personal</option>
                    <option {{ isset($registroAccidente->form1Lugar) == 'Servicio de translado de personal por ascensor' ? 'selected' : '' }} value="Servicio de translado de personal por ascensor">Servicio de translado de personal por ascensor</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1Departamento"> Departamento: </label>
                <input class="form-control" name="form1Departamento" id="form1Departamento" type="text" value="{{isset($registroAccidente->form1Departamento)?$registroAccidente->form1Departamento:''}}">
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Ubicacion"> Ubicación: </label>
                <input class="form-control" name="form1Ubicacion" id="form1Ubicacion" type="text" value="{{isset($registroAccidente->form1Ubicacion)?$registroAccidente->form1Ubicacion:''}}">
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Area"> Área: </label>
                <input class="form-control" name="form1Area" id="form1Area" type="text" value="{{isset($registroAccidente->form1Area)?$registroAccidente->form1Area:''}}">
            </div>
        </div>
    </div>
</div>


<!--  -->

<div class="headingcontainer">
    <div class="heading3">
        <h3 id="colorInformacion1">Información</h3>
    </div>
</div>

<div class="divForm form-group">
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1NumeroEmpleado"> Número empleado </label>
                <input type="number" placeholder="Ej: 833" name="form1NumeroEmpleado" id="form1NumeroEmpleado" class="form-control" onkeydown="limit(this);" onkeyup="limit(this);" value="{{isset($registroAccidente->form1NumeroEmpleado)?$registroAccidente->form1NumeroEmpleado:''}}">
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Nombre"> Nombre(s): </label>
                <input name="form1Nombre" id="form1Nombre" class="form-control" type="text" value="{{isset($registroAccidente->form1Nombre)?$registroAccidente->form1Nombre:''}}">
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1PrimerApellido"> Primer apellido: </label>
                <input name="form1PrimerApellido" id="form1PrimerApellido" class="form-control" type="text" value="{{isset($registroAccidente->form1PrimerApellido)?$registroAccidente->form1PrimerApellido:''}}">
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1SegundoApellido"> Segundo apellido: </label>
                <input name="form1SegundoApellido" id="form1SegundoApellido" class="form-control" type="text" value="{{isset($registroAccidente->form1SegundoApellido)?$registroAccidente->form1SegundoApellido:''}}">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1Genero">Genero: </label>
                <select name="form1Genero" id="form1Genero" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1Genero) == 'Mujer' ? 'selected' : '' }} value="Mujer">Mujer</option>
                    <option {{ isset($registroAccidente->form1Genero) == 'Hombre' ? 'selected' : '' }} value="Hombre">Hombre</option>
                </select>
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Telefono">Teléfono: </label>
                <input class="form-control" id="form1Telefono" name="form1Telefono" type="number" value="{{isset($registroAccidente->form1Telefono)?$registroAccidente->form1Telefono:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1EstadoCivil">Estado Civil</label>
                <select name="form1EstadoCivil" id="form1EstadoCivil" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Casado' ? 'selected' : '' }} value="Casado">Casado</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Soltero' ? 'selected' : '' }} value="Soltero">Soltero</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Divorciado' ? 'selected' : '' }} value="Divorciado">Divorciado</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Viudo' ? 'selected' : '' }} value="Viudo">Viudo</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Unión libre' ? 'selected' : '' }} value="Unión libre">Unión libre</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'Sociedad de convivencia' ? 'selected' : '' }} value="Sociedad de convivencia">Sociedad de convivencia</option>
                    <option {{ isset($registroAccidente->form1EstadoCivil) == 'No especificado' ? 'selected' : '' }} value="No especificado">No especificado</option>
                </select>
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Edad">Edad: </label>
                <input class="form-control" class="uppercase" id="form1Edad" name="form1Edad" type="number" value="{{isset($registroAccidente->form1Edad)?$registroAccidente->form1Edad:''}}" />
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1Curp">CURP: </label>
                <input class="form-control" type="text" id="form1Curp" name="form1Curp" value="{{isset($registroAccidente->form1Curp)?$registroAccidente->form1Curp:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Rfc">RFC: </label>
                <input class="form-control" class="uppercase" id="form1Rfc" name="form1Rfc" type="text" value="{{isset($registroAccidente->form1Rfc)?$registroAccidente->form1Rfc:''}}" />
            </div>
        </div>
    </div>
</div>



<div class="headingcontainer">
    <div class="heading3">
        <h3 id="colorAreadeTrabajo1">Área de trabajo</h3>
    </div>
</div>

<div class="divForm form-group">
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1NivelEstudios">Nivel máximo de estudios: </label>
                <select name="form1NivelEstudios" id="form1NivelEstudios" class="form-control">
                    <option {{ isset($registroAccidente->form1NivelEstudios) == '' ? 'selected' : '' }} value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Primaria' ? 'selected' : '' }} value="Primaria">Primaria</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Secundaria' ? 'selected' : '' }} value="Secundaria">Secundaria</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Preparatoria' ? 'selected' : '' }} value="Preparatoria">Preparatoria</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Universidad' ? 'selected' : '' }} value="Universidad">Universidad</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Licenciatura' ? 'selected' : '' }} value="Licenciatura">Licenciatura</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Maestria' ? 'selected' : '' }} value="Maestria">Maestria</option>
                    <option {{ isset($registroAccidente->form1NivelEstudios) == 'Doctorado' ? 'selected' : '' }} value="Doctorado">Doctorado</option>
                </select>
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1PersonasDependen"> Personas que dependen del trabajador</label>
                <input name="form1PersonasDependen" id="form1PersonasDependen" class="form-control" type="text" value="{{isset($registroAccidente->form1PersonasDependen)?$registroAccidente->form1PersonasDependen:''}}" />
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1AntiguedadEmpresa">Antigüedad en la empresa: </label>
                <select name="form1AntiguedadEmpresa" id="form1AntiguedadEmpresa" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1AntiguedadEmpresa) == '0 - 1 año' ? 'selected' : '' }} value="0 - 1 año">0 - 1 año</option>
                    <option {{ isset($registroAccidente->form1AntiguedadEmpresa) == '1 - 2 años' ? 'selected' : '' }} value="1 - 2 años">1 - 2 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadEmpresa) == '2 - 3 años' ? 'selected' : '' }} value="2 - 3 años">2 - 3 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadEmpresa) == '3 - 5 años' ? 'selected' : '' }} value="3 - 5 años">3 - 5 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadEmpresa) == '5 o mas años' ? 'selected' : '' }} value="5 o mas años">5 o mas años</option>
                </select>
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1AntiguedadPuesto">Antigüedad en el puesto: </label>
                <select name="form1AntiguedadPuesto" id="form1AntiguedadPuesto" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1AntiguedadPuesto) == '0 - 1 año' ? 'selected' : '' }} value="0 - 1 año">0 - 1 año</option>
                    <option {{ isset($registroAccidente->form1AntiguedadPuesto) == '1 - 2 años' ? 'selected' : '' }} value="1 - 2 años">1 - 2 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadPuesto) == '2 - 3 años' ? 'selected' : '' }} value="2 - 3 años">2 - 3 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadPuesto) == '3 - 5 años' ? 'selected' : '' }} value="3 - 5 años">3 - 5 años</option>
                    <option {{ isset($registroAccidente->form1AntiguedadPuesto) == '5 o mas años' ? 'selected' : '' }} value="5 o mas años">5 o mas años</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1OcupacionHabitual">Ocupación o puesto habitual: </label>
                <input name="form1OcupacionHabitual" id="form1OcupacionHabitual" type="text" class="form-control" value="{{isset($registroAccidente->form1OcupacionHabitual)?$registroAccidente->form1OcupacionHabitual:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1OcupacionDesempeñaba">Ocupación o puesto que desempeñaba: </label>
                <input name="form1OcupacionDesempeñaba" id="form1OcupacionDesempeñaba" type="text" class="form-control" value="{{isset($registroAccidente->form1OcupacionDesempeñaba)?$registroAccidente->form1OcupacionDesempeñaba:''}}" />
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1ClaseTrabajador">Clase de trabajador:</label>
                <select name="form1ClaseTrabajador" id="form1ClaseTrabajador" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'Planta' ? 'selected' : '' }} value="Planta">Planta</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'Eventual' ? 'selected' : '' }} value="Eventual">Eventual</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'Confianza' ? 'selected' : '' }} value="Confianza">Confianza</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'Honorarios' ? 'selected' : '' }} value="Honorarios">Honorarios</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'Subcontrato' ? 'selected' : '' }} value="Subcontrato">Subcontrato</option>
                    <option {{ isset($registroAccidente->form1ClaseTrabajador) == 'No especificado' ? 'selected' : '' }} value="No especificado">No especificado</option>
                </select>
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1NumeroSeguro">Institución de seguridad social: </label>
                <select name="form1NumeroSeguro" id="form1NumeroSeguro" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1NumeroSeguro) == 'Seguro Social' ? 'selected' : '' }} value="Seguro Social">Seguro Social</option>
                    <option {{ isset($registroAccidente->form1NumeroSeguro) == 'IMSS' ? 'selected' : '' }} value="IMSS">IMSS</option>
                    <option {{ isset($registroAccidente->form1NumeroSeguro) == 'ISSSTE' ? 'selected' : '' }} value="ISSSTE">ISSSTE</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1NumeroAfiliacion">Número de afiliación: </label>
                <input name="form1NumeroAfiliacion" id="form1NumeroAfiliacion" type="text" class="form-control" value="{{isset($registroAccidente->form1NumeroAfiliacion)?$registroAccidente->form1NumeroAfiliacion:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1SalarioMensual">Salario mensual: </label>
                <select name="form1SalarioMensual" id="form1SalarioMensual" class="form-control">
                    <option value="" disabled selected>Seleccionar...</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == '$10000 - $20000' ? 'selected' : '' }} value="$10000 - $20000">$10000 - $20000</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == '$20000 - $30000' ? 'selected' : '' }} value="$20000 - $30000">$20000 - $30000</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == '$30000 - $40000' ? 'selected' : '' }} value="$30000 - $40000">$30000 - $40000</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == '$40000 - $50000' ? 'selected' : '' }} value="$40000 - $50000">$40000 - $50000</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == '$50000 - $60000' ? 'selected' : '' }} value="$50000 - $60000">$50000 - $60000</option>
                    <option {{ isset($registroAccidente->form1SalarioMensual) == 'No especificado' ? 'selected' : '' }} value="No especificado">No especificado</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="headingcontainer">
    <div class="heading3">
        <h3 id="colorDireccion1">Dirección</h3>
    </div>
</div>

<div class="divForm form-group">
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1CodigoPostal"> Código postal </label>
                <input name="form1CodigoPostal" id="form1CodigoPostal" class="form-control" type="number" value="{{isset($registroAccidente->form1CodigoPostal)?$registroAccidente->form1CodigoPostal:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Numero"> Numero </label>
                <input name="form1Numero" id="form1Numero" class="form-control" type="text" value="{{isset($registroAccidente->form1Numero)?$registroAccidente->form1Numero:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Calle"> Calle </label>
                <input name="form1Calle" id="form1Calle" class="form-control" type="text" value="{{isset($registroAccidente->form1Calle)?$registroAccidente->form1Calle:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1Colonia"> Colonia </label>
                <input name="form1Colonia" id="form1Colonia" class="form-control" type="text" value="{{isset($registroAccidente->form1Colonia)?$registroAccidente->form1Colonia:''}}" />
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-group col">
            <div class="col">
                <label for="form1Municipio"> Municipio o Alcaldía </label>
                <input name="form1Municipio" id="form1Municipio" class="form-control" type="text" value="{{isset($registroAccidente->form1Municipio)?$registroAccidente->form1Municipio:''}}" />
            </div>
        </div>
        <div class="form-group col">
            <div class="col">
                <label for="form1MunicipioEntidadFederativa"> Entidad Federativa </label>
                <input name="form1MunicipioEntidadFederativa" id="form1MunicipioEntidadFederativa" class="form-control" type="text" value="{{isset($registroAccidente->form1MunicipioEntidadFederativa)?$registroAccidente->form1MunicipioEntidadFederativa:''}}" />
            </div>
        </div>
    </div>
</div>