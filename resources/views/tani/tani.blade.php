@extends('layouts.guest')

@section('title', 'Manajemen Irigrasi IOT')

@section('content')

<div class="container-fluid">
    <nav class="navbar" style="background-color: #343a40;">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: #ffffff;">Manajemen Irigrasi IOT</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center" style="color: #343a40;">Manajemen Irigrasi IOT</h1>

        <div class="row my-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-title" style="color: #495057;">Status Mesin</h5>
                        <!-- Static status indicator -->
                        <span class="badge bg-success">
                            ON
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-title" style="color: #495057;">Motor</h5>
                        <!-- Static status indicator -->
                        <span class="badge bg-danger">
                            OFF
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="sm-max" class="form-label" style="margin-right: 0.5rem;">SM Max</label>
                        <input type="text" id="sm-max" name="sm_max" class="form-control" placeholder="Enter max soil moisture">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="sm-min" class="form-label" style="margin-right: 0.5rem;">SM Min</label>
                        <input type="text" id="sm-min" name="sm_min" class="form-control" placeholder="Enter min soil moisture">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="air-temp" class="form-label" style="margin-right: 0.5rem;">Air Temperature</label>
                        <input type="text" id="air-temp" name="air_temp" class="form-control" placeholder="--">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="air-humidity" class="form-label" style="margin-right: 0.5rem;">Air Humidity</label>
                        <input type="text" id="air-humidity" name="air_humidity" class="form-control" placeholder="--">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="uv-value" class="form-label" style="margin-right: 0.5rem;">UV Value</label>
                        <input type="text" id="uv-value" name="uv_value" class="form-control" placeholder="--">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="soil-temp" class="form-label" style="margin-right: 0.5rem;">Soil Temperature</label>
                        <input type="text" id="soil-temp" name="soil_temp" class="form-control" placeholder="--">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="soil-moisture" class="form-label" style="margin-right: 0.5rem;">Soil Moisture Value</label>
                        <input type="text" id="soil-moisture" name="soil_moisture" class="form-control" placeholder="--">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-around">
                <button type="submit" class="btn" style="background-color: #343a40; color: #ffffff;" style="padding: 0.5rem;">Membuka Pintu</button>
                <button type="submit" class="btn" style="background-color: #343a40; color: #ffffff;">Menutup Pintu</button>
            </div>
        </form>
    </div>
</div>
@endsection