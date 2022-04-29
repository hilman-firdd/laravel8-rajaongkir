<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Ongkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">APLIKASI CEK ONGKIR API RAJAONGKIR LARAVEL 8</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
              <a class="nav-link" href="#">Features</a>
              <a class="nav-link" href="#">Pricing</a>
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </div>
          </div>
        </div>
      </nav>

<div class="container mt-5">
    <div class="card">

        <form action="{{ url('/') }}" method="get">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <h6>Nama Anda</h6>
                            <input type="text" name="nama" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <h6>Kirim Dari</h6>
                            <select name="province_from" id=""  class="form-control">
                                <option value="" holder>Pilih Provinsi</option>
                                @foreach ($provinces as $result)
                                    <option value="{{ $result->id}}">{{ $result->province}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <select name="origin" id="" class="form-control">
                                <option value="" holder>Pilih Kota</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <h6>Kirim ke</h6>
                            <select name="province_to" id=""  class="form-control">
                                <option value="" holder>Pilih Provinsi</option>
                                @foreach ($provinces as $result)
                                    <option value="{{ $result->id}}">{{ $result->province}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <select name="destination" id="" class="form-control">
                                <option value="" holder>Pilih Kota</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <h6>Berat Paket</h6>
                                <input type="text" name="berat_paket" class="form-control">
                                <small>Dalam gram contoh 1700/1,7Kg</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <h6>Pilih Kurir</h6>
                                <select name="kurir" id="" class="form-control">
                                    <option value="" holder>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">Pos Indonesia</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-blok">Hitung Ongkir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </form>
        
        @if($result_cost != null)
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered table-hovered" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Tuan</th>
                            <th>Service</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Estimasi</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result_cost as $result)
                        <tr>
                            <td>{{ $nama }}</td>
                            <td>{{ $result['service'] }}</td>
                            <td>{{ $result['description'] }}</td>
                            <td>{{ $result['cost'][0]['value'] }}</td>
                            <td>{{ $result['cost'][0]['etd'] }}</td>
                            <td>{{ $result['cost'][0]['note'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
            @endif
        </div>
    </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="province_from"]').on('change', function () {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: 'getCity/ajax/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="origin"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="origin"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="origin"]').empty();
            }
        });
        $('select[name="province_to"]').on('change', function () {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: 'getCity/ajax/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="destination"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="destination"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="destination"]').empty();
            }
        });
    });
</script>
</body>
</html>