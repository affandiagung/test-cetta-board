@extends('index')
@section('content')

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .loading {
                pointer-events: none;
                opacity: 0.5;
            }
        </style>
    </head>
    <nav>
        <i class='bx bx-menu'></i>
        <h3>AIR QUALITY</h3>
    </nav>
    <main>

        @if (session('success') || session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var title = '{{ session('success') ? 'Success' : session('error') }}';
                    var icon = '{{ session('success') ? 'success' : 'error' }}';
                    Swal.fire({
                        title: title,
                        icon: icon,
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif
        {{-- modal upload Create Sensor --}}
        <div class="modal fade" id="storeSensor" tabindex="-1" role="dialog" aria-labelledby="storeSensorLabel"
            aria-hidden="true"
            style=" max-width: 350px; margin: 0 auto;top: 50%; transform: translateY(-50%); position: absolute; left: 0; right: 0;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="storeSensorLabel">Add Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="{{ route('sensors.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="tanggal" class="col-sm-6 col-form-label">Tanggal
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="date" class="form-control" id="tanggal"
                                                name="tanggal" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorPM25" class="col-sm-6 col-form-label"> Sensor PM2.5
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorPM25"
                                                name="sensorPM25">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorPM10" class="col-sm-6 col-form-label"> Sensor PM10
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorPM10"
                                                name="sensorPM10">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorO3" class="col-sm-6 col-form-label"> Sensor 03
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorO3"
                                                name="sensorO3">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorUVI" class="col-sm-6 col-form-label"> Sensor UVI
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="text" class="form-control" id="sensorUVI"
                                                name="sensorUVI">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal edit Sensor-->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
            style="position: absolute;left:10px;right:10px;padding-left:10px;padding-right:10px;">
            <div class="modal-dialog modal-sm" style="max-width: 400px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Sensor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorPM25" class="col-sm-6 col-form-label"> Sensor PM2.5
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorPM25"
                                                name="sensorPM25">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorPM10" class="col-sm-6 col-form-label"> Sensor PM10
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorPM10"
                                                name="sensorPM10">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorO3" class="col-sm-6 col-form-label"> Sensor 03
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="number" class="form-control" id="sensorO3"
                                                name="sensorO3">
                                        </div>
                                    </div>
                                    <div class="mb-1 mt-1 row align-items-center">
                                        <label for="sensorUVI" class="col-sm-6 col-form-label"> Sensor UVI
                                            <span style="color: red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input required type="text" class="form-control" id="sensorUVI"
                                                name="sensorUVI">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="head-title">
            <div class="left">
                <h3>JAKARTA PUSAT </h3>
            </div>
            <div class="section">
                <div style="display:flex;justify-content:flex-end">
                    <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#storeSensor">
                        <span class="text">ADD DATA</span>
                    </a>
                    &nbsp;

                    <td style="display: flex; justify-content: space-between !important;">
                        <form action="{{ route('sensors.sync') }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <span class="text">SYNC DATA</span>
                            </button>
                        </form>
                    </td>

                </div>
            </div>
        </div>
        <div class="row"
            style="border-radius: 20px;background: var(--light);padding: 24px;overflow-x: auto;margin-top:22px;margin-left:2px">
            <div class="table-data">
                <div class="order">
                    <table class="table-ticket" id ="tableTicket">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>PM2.5</th>
                                <th>PM10</th>
                                <th>O3</th>
                                <th>UVI</th>
                                <th>
                                    <center>ACTION</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @if (isset($sensors['data']) && count($sensors['data']) > 0)
                                @foreach ($sensors['data'] as $sensor)
                                    <tr>
                                        <td>{{ $sensor['tanggal'] ? \Carbon\Carbon::parse($sensor['tanggal'])->format('Y-m-d') : '-' }}
                                        </td>
                                        <td>{{ $sensor['sensorPM25'] }}</td>
                                        <td>{{ $sensor['sensorPM10'] }}</td>
                                        <td>{{ $sensor['sensorO3'] }}</td>
                                        <td>{{ $sensor['sensorUVI'] }}</td>
                                        <td style="display: flex;justify-content: space-between !important">
                                            <button class="btn" data-bs-toggle="tooltip" data-toggle="modal"
                                                onclick='editSensor(@json($sensor))' data-bs-placement="top"
                                                title="Edit Sensor">
                                                <i class="fas fa-edit text-primary text-sm"></i>
                                            </button>
                                            <form action="{{ route('sensors.destroy', $sensor['id']) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn p-0" type="submit">
                                                    <i class="fa-solid fa-trash text-primary text-sm"></i>
                                                </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No DATA</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <script>
        const apiToken = "{{ session('api_token') }}";


        function editSensor(data) {
            const dataStatus = data.status === 'Closed' ? 'Closed' : 'Open';
            $('#editModal #sensorO3').val(data.sensorO3);
            $('#editModal #sensorPM10').val(data.sensorPM10);
            $('#editModal #sensorPM25').val(data.sensorPM25);
            $('#editModal #sensorUVI').val(data.sensorUVI);
            var updateSensorURl = "{{ route('sensors.update', ['sensor' => 'SENSOR_ID']) }}";
            var actionUrl = updateSensorURl.replace('SENSOR_ID', data.id);
            $('#editForm').attr('action', actionUrl);
            $('#editModal').modal('show');
        }
    </script>

@endsection
