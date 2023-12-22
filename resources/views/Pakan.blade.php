@extends('index')
@section('content')

<!-- css -->

<style>
        /* Styling untuk popup */
        #popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        #popup-form {
          margin-top:25px;
          background-color: white;
            width: 25%; /* Lebar 40% dari lebar layar */
            height: 50%; /* Tinggi 50% dari tinggi layar */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>


<!-- dashbord -->
<div class="row">
    <div class="col">
    <div class="row">

    <!-- @php
    $count = 0; // Inisialisasi variabel count untuk menghitung item yang telah ditampilkan
@endphp -->


@foreach ($recentData as $recent)
 <!-- Hanya tampilkan 3 item pertama -->
 <div class="col-xl-3 col-sm-6 mb-xl-5 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Waktu pakan ke 1</p>
                                <h3 class="font-weight-bolder">
                                    @if(!empty($recent->jam1) && !empty($recent->menit1))
                                        {{ $recent->jam1 }}:{{ $recent->menit1 }}
                                    @else
                                        Data kosong
                                    @endif
                                </h3>

                                <p class="mb-0">
                                   Waktu akan memberi pakan pada <br> Jam
                                   {{ $recent->jam1 }}:{{ $recent->menit1 }}
                                </p>
                                <form action="{{ route('update-waktu', ['id' => $recent->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="jam1" name="jam1" value="-">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="menit1" name="menit1" value="-">
                                    </div>
                                    <!-- <div class="form-group">
                                        <input type="hidden" class="form-control" id="hari" name="hari" value="-">
                                    </div> -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateWaktu{{ $recent->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <span style="font-size:30px;">
                                <i class="bi bi-alarm-fill text-lg opacity-10" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Waktu pakan ke 2</p>
                                <h3 class="font-weight-bolder">
                                @if($recent->jam2 !== '-' && $recent->menit2 !== '-')
                                    {{ $recent->jam2 }}:{{ $recent->menit2 }}
                                @else
                                    Data kosong
                                @endif

                                </h3>

                                <p class="mb-0">
                                Waktu akan memberi pakan pada <br>
                                Jam {{ $recent->jam2 }}:{{ $recent->menit2 }}
                                </p>

                                <form action="{{ route('update-waktu2', ['id' => $recent->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="jam2" name="jam2" value="-">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="menit2" name="menit2" value="-">
                                    </div>
                                    <!-- <div class="form-group">
                                        <input type="hidden" class="form-control" id="hari2" name="hari2" value="-">
                                    </div> -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateWaktu2{{ $recent->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <span style="font-size:30px;">
                                <i class="bi bi-alarm-fill text-lg opacity-10" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Waktu pakan ke 3</p>
                                <h3 class="font-weight-bolder">
                                    @if(!empty($recent->jam3) && !empty($recent->menit3))
                                        {{ $recent->jam3 }}:{{ $recent->menit3 }}
                                    @else
                                        Data kosong
                                    @endif
                                </h3>

                                <p class="mb-0">
                                Waktu akan memberi pakan pada <br>
                                Jam {{ $recent->jam3 }}:{{ $recent->menit3 }}
                                </p>
                                <form action="{{ route('update-waktu3', ['id' => $recent->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="jam3" name="jam3" value="-">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="menit3" name="menit3" value="-">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="hari3" name="hari3" value="-">
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateWaktu3{{ $recent->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm" ><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <span style="font-size:30px;">
                                <i class="bi bi-alarm-fill text-lg opacity-10" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col">
                            <center>
                                <h5>PAKANIN</h5>
                                <img class="w-50 mx-auto" src="./assets/img/pakanin.png" alt="sidebar_illustration">
                                <h6>Pemberian Pakan Ikan</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach


    <!--  mengupdate waktu -->
    <div class="modal fade" id="updateWaktu{{ $recent->id }}" tabindex="-1" role="dialog" aria-labelledby="updateWaktuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateWaktuLabel">Atur Waktu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengupdate waktu -->
                    <form action="{{ route('update-waktu', ['id' => $recent->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jam1">Jam</label>
                            <input type="text" class="form-control" id="jam1" name="jam1" value="{{ $recent->jam1 }}">
                        </div>
                        <div class="form-group">
                            <label for="menit1">Menit</label>
                            <input type="text" class="form-control" id="menit1" name="menit1" value="{{ $recent->menit1 }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="hari" name="hari" value="setiap hari">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateWaktu2{{ $recent->id }}" tabindex="-1" role="dialog" aria-labelledby="updateWaktuLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateWaktuLabel2">Atur Waktu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengupdate waktu -->
                    <form action="{{ route('update-waktu2', ['id' => $recent->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jam2">Jam</label>
                            <input type="text" class="form-control" id="jam2" name="jam2" value="{{ $recent->jam2 }}">
                        </div>
                        <div class="form-group">
                            <label for="menit2">Menit</label>
                            <input type="text" class="form-control" id="menit2" name="menit2" value="{{ $recent->menit2 }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="hari2" name="hari2" value="setiap hari">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateWaktu3{{ $recent->id }}" tabindex="-1" role="dialog" aria-labelledby="updateWaktuLabel3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateWaktuLabel3">Atur Waktu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengupdate waktu -->
                    <form action="{{ route('update-waktu3', ['id' => $recent->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="jam3">Jam</label>
                            <input type="text" class="form-control" id="jam3" name="jam3" value="{{ $recent->jam3 }}">
                        </div>
                        <div class="form-group">
                            <label for="menit3">Menit</label>
                            <input type="text" class="form-control" id="menit3" name="menit3" value="{{ $recent->menit3 }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="hari3" name="hari3" value="setiap hari">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






      </div>
    </div>
</div>
<!-- end dashbord  -->


        <!-- table -->
        <div class="row mt-5 mb-5">
        <div class="col-11 mb-5">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Waktu Pemberian Pakan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">data waktu ke</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">waktu pakan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Putaran</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($recentData as $recent)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">1</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Data Wakatu Pakan Ke 1</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->jam1 }}:{{ $recent->menit1 }}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->hari }}</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">2</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Data Wakatu Pakan Ke 2</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->jam2 }}:{{ $recent->menit2 }}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->hari2 }}</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">3</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Data Wakatu Pakan Ke 3</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->jam3 }}:{{ $recent->menit3 }}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->hari3 }}</p>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end table -->

      <!-- js -->
    <script>

function showPopup() {
    document.getElementById('popup').style.display = 'block';
  }
    // Fungsi untuk menampilkan pesan sukses
    function showSuccessMessage() {
        document.getElementById('successMessage').style.display = 'block';
    }

    // Fungsi untuk menampilkan pesan kesalahan
    function showErrorMessage() {
        document.getElementById('errorMessage').style.display = 'block';
    }

    // Menambahkan event listener ke tombol "Simpan"
    document.getElementById('submitButton').addEventListener('click', function() {
        // Simulasikan hasil dari formulir (berhasil atau gagal)
        const isSuccess = true; // Ganti dengan logika sesuai hasil permintaan Anda

        if (isSuccess) {
        showSuccessMessage();
        } else {
        showErrorMessage();
        }
    });
    </script>

@endsection
