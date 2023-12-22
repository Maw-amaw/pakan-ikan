@extends('admin.index')
@section('content')

@if(session('success'))
    <div id="custom-alert" class="custom-alert">
        {{ session('success') }}
        <span class="close-btn" onclick="closeAlert()">x</span>
    </div>
@endif

<style>
    .custom-alert {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 15px;
        background-color: #28a745; /* Warna hijau untuk alert sukses */
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.5s ease-out forwards; /* Animasi tampil */
    }

    .close-btn {
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<script>
    function closeAlert() {
        var alert = document.getElementById('custom-alert');
        alert.style.animation = 'fadeOutDown 0.5s ease-out forwards'; /* Animasi hilang */
        setTimeout(function() {
            alert.style.display = 'none';
        }, 500); /* Waktu animasi */
    }
</script>


<style>
    .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
        }

.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
}

.modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 60%; /* Lebar modal 60% dari lebar layar */
  max-width: 350px;
  background-color: #f1f1f1;
  padding: 20px;
  border: 1px solid #ccc;
  z-index: 1;
}

.close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
}

form {
  display: grid;
  gap: 10px;
}

button {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}


</style>

<div class="row">
    <div class="col-4">

    </div>
    <div class="col-4"></div>
    <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end"><button type="button" class="btn btn-success" onclick="openModal()">Tambah Data</button></div>
</div>
<div class="row">

<!-- tambah data -->
<div class="modal" id="myModal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Form Tambah Data</h2>
    <form action="{{ route('addalat') }}" method="POST">
      <!-- Isi formulir di sini -->
      @csrf
      <label for="alat">Kode Alat :</label>
      <input type="text" id="alat" name="alat" required>

      <button type="submit">Tambah</button>
    </form>
  </div>
</div>


<div class="text-center" style="max-height: 600px; overflow: auto;">
    <table class="table overflow-auto table-dark table-striped mt-5" >
        <thead>
            <tr>
                <!-- <th scope="col">ssid</th>
                <th scope="col">password</th> -->
                <th scope="col">alat</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->alat }}</td>
                    <td>
                        <label for="status{{ $item->id }}"></label>
                            @if ($item->status == 'aktiv')
                            <a href="{{ route('detail', ['alat' => $item->alat]) }}" class="btn btn-success">{{ $item->status }}</a>
                            @elseif($item->status == 'belum')
                                <button type="button" class="btn btn-danger">{{ $item->status }}</button>
                            @else
                                <p>belum di seting</p>
                            @endif
                    </td>
                    <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                        Edit
                    </button>
                    <form id="deleteForm{{ $item->id }}" action="{{ route('admin.delete', $item->id) }}" method="post" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $item->id }}')">Hapus</button>

                    <script>
                        function confirmDelete(itemId) {
                            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                                // Submit formulir yang sesuai dengan item yang ingin dihapus
                                document.getElementById('deleteForm' + itemId).submit();
                            }
                        }
                    </script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>


    @foreach($data as $item)
    <!-- Modal Edit untuk setiap item -->
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 60%;" role="document">
            <div class="modal-content">
                <!-- Konten modal edit -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulir edit -->
                    <form method="POST" action="{{ route('admin.editdata', $item->id) }}">
                        @csrf
                        @method('PUT')



                        <div class="form-group">
                            <label for="alat{{ $item->id }}">Nama Alat:</label>
                            <input type="text" name="alat" value="{{ $item->alat }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status{{ $item->id }}">Status:</label>
                            <input type="text" name="status" value="{{ $item->status }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


<script>
    // Menampilkan modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

// Menutup modal
function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

// Menutup modal jika di luar area modal di klik
window.onclick = function(event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
</script>




</div>
@endsection
