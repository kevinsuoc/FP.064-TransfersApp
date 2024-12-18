

@include('head')

<div class="main-container">
@include('header')
    <div class="container mt-4">
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('calendario.index') }}" class="container mt-4">
            @csrf
            <div class="form-group">
                <label for="vista">Selecciona el tipo de vista:</label>
                <select id="tipo" name="tipo" class="form-control" onchange="this.form.submit()">
                    <option value="diaria" {{ $filtroData['tipo'] == 'diaria' ? 'selected' : '' }}>Vista Diaria</option>
                    <option value="semanal" {{ $filtroData['tipo'] == 'semanal' ? 'selected' : '' }}>Vista Semanal</option>
                    <option value="mensual" {{ $filtroData['tipo'] == 'mensual' ? 'selected' : '' }}>Vista Mensual</option>
                </select>
            </div>

            <div id="opciones">

            @if ($filtroData['tipo'] == 'diaria')
                <div class="form-group">
                    <label for="dia">Selecciona un día:</label>
                    <input type="date" id="dia" name="dia" class="form-control" value="{{ $filtroData['dia']}}">
                </div>
            @elseif($filtroData['tipo'] == 'semanal')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="anyo">Año:</label>
                        <input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="{{ $filtroData['anyo']}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="semana">Semana:</label>
                        <input type="number" id="semana" name="semana" class="form-control" min="1" max="52" value="{{ $filtroData['semana']}}">
                    </div>
                </div>
            @elseif($filtroData['tipo'] == 'mensual')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="anyo">Año:</label>
                        <input type="number" id="anyo" name="anyo" class="form-control" min="2024" max="2030" value="{{ $filtroData['anyo']}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mes">Mes:</label>
                        <input type="number" id="mes" name="mes" class="form-control" min="1" max="12" value="{{ $filtroData['mes']}}">
                    </div>
                </div>
            @endif
                {{-- Adaptar filtros dinámicamente como en el proyecto original --}}
            </div>

            <input type="hidden" name="request" value="filtroTrayectos">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <div class="row mt-4">
            @foreach ($trayectos as $trayecto)
                <div class="col-md-4 mb-4">
                    <div class="card p-3">
                        <h4>Trayecto</h4><hr>
                        <p><strong>Fecha:</strong> {{ $trayecto['dia'] }} {{ $trayecto['hora'] }}</p>
                        <p><strong>Localizador:</strong> {{ $trayecto['localizador'] }}</p>
                        <p><strong>Email viajero:</strong> {{ $trayecto['email'] }}</p>
                        <button class="btn btn-info" onclick="verDetalle({{ json_encode($trayecto) }})">Ver más</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- Modal para ver detalles -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalle del Trayecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tipo de trayecto:</strong> <span id="tipoTrayecto"></span></p>
                <p><strong>Localizador:</strong> <span id="detalleLocalizador"></span></p>
                <p><strong>Email Viajero:</strong> <span id="detalleEmail"></span></p>
                <p><strong>Número de viajeros:</strong> <span id="detalleViajeros"></span></p>
                <p><strong>Vehículo:</strong> <span id="detalleVehiculo"></span></p>
                <p><strong>Email Conductor:</strong> <span id="detalleConductor"></span></p>
                <p><strong>Día de entrada:</strong> <span id="diaEntrada"></span></p>
                <p><strong>Hora de entrada:</strong> <span id="horaEntrada"></span></p>
                <p><strong>Destino:</strong> <span id="detalleDestino"></span></p>
                <p><strong>Número de vuelo de entrada:</strong> <span id="detalleVueloEntrada"></span></p>
                <p><strong>Día de salida:</strong> <span id="diaSalida"></span></p>
                <p><strong>Hora de salida:</strong> <span id="horaSalida"></span></p>
                <p><strong>Origen:</strong> <span id="detalleOrigen"></span></p>
                <p><strong>Número de vuelo de Salida:</strong> <span id="detalleVueloSalida"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function verDetalle(trayecto) {
        //var tray = JSON.parse(trayecto);
        // Rellenar los campos del modal con los datos del trayecto
        document.getElementById('tipoTrayecto').textContent = trayecto.tipo || 'N/A';
        document.getElementById('detalleLocalizador').textContent = trayecto.localizador || 'N/A';
        document.getElementById('detalleEmail').textContent = trayecto.email || 'N/A';
        document.getElementById('detalleViajeros').textContent = trayecto.num_viajeros || 'N/A';
        document.getElementById('detalleVehiculo').textContent = trayecto.vehiculo || 'N/A';
        document.getElementById('detalleConductor').textContent = trayecto.email_conductor || 'N/A';
        document.getElementById('diaEntrada').textContent = trayecto.dia_entrada || 'N/A';
        document.getElementById('horaEntrada').textContent = trayecto.hora_entrada || 'N/A';
        document.getElementById('detalleDestino').textContent = trayecto.destino || 'N/A';
        document.getElementById('detalleVueloEntrada').textContent = trayecto.numero_vuelo_entrada || 'N/A';
        document.getElementById('diaSalida').textContent = trayecto.dia_salida || 'N/A';
        document.getElementById('horaSalida').textContent = trayecto.hora_salida || 'N/A';
        document.getElementById('detalleOrigen').textContent = trayecto.origen || 'N/A';
        document.getElementById('detalleVueloSalida').textContent = trayecto.numero_vuelo_salida || 'N/A';


        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('detalleModal'));
        modal.show();
    }
</script>




