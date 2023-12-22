@extends('index')
@section('content')
      <!-- dashbord -->
      <div class="row">
        <!-- grafik -->
      <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Grafik PH</h6>
                    <?php
                        $ph = $latestData->pH;
                    if ($ph > 8) {
                        $status = "Bahaya";
                        $swalTitle = "ph Berbahaya!";
                        $bgClass = "bg-gradient-danger";
                        $lakukan = "silakan nyalakan aerator pada aquarium";
                        $swalMessage = "ph melebihi batas aman. Segera lakukan tindakan untuk menurunkan ph ikan.";
                    } elseif ($ph < 5) {
                        $status = "Bahaya";
                        $swalTitle = "ph Berbahaya!";
                        $lakukan = "silakan nyalakan aerator pada aquarium";
                        $bgClass = "bg-gradient-warning";
                        $swalMessage = "ph terlalu rendah. Segera lakukan tindakan untuk meningkatkan ph ikan.";
                    } else {
                        $status = "Normal";
                        $swalTitle = "ph Normal";
                        $bgClass = "bg-gradient-success";
                        $lakukan ="aman";
                        $swalMessage = "ph ikan berada dalam kondisi aman.";
                    }
                    ?>
                @if ($latestData)
                @if ($latestData->pH < 5)
                    <i class="fa fa-arrow-down text-danger"></i>
                    <span class="font-weight-bold">{{ $latestData->pH }}</span>
                    <div class="d-flex justify-content-end align-items-center">
                        <button class="btn btn-warning" onclick="Swal.fire(
                            '<?php echo $swalTitle; ?>',
                            '<?php echo $swalMessage;?> nilai phnya  <?php echo $ph; ?>',
                            'info'
                        )">
                            <i class="bi bi-thermometer-high opacity-10"></i>
                        </button>
                    </div>
                        <!-- Tambahkan kode yang ingin ditampilkan ketika suhu lebih dari 300 di sini -->
                    @elseif ($latestData->pH > 8)
                        <i class="fa fa-arrow-up text-danger"></i>
                        <span class="font-weight-bold">{{ $latestData->pH }}</span>
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-warning" onclick="Swal.fire(
                                '<?php echo $swalTitle; ?>',
                                '<?php echo $swalMessage;?> nilai phnya  <?php echo $ph; ?>',
                                'info'
                            )">
                                <i class="bi bi-thermometer-high opacity-10"></i>
                            </button>
                        </div>
                    @else
                    <i class="fa fa-check-circle text-success"></i>
                    <span class="font-weight-bold">{{ $latestData->pH }}</span>
                    <div class="d-flex justify-content-end align-items-center"> <!-- Add a container div with flex utilities -->
                        <button class="btn btn-success" onclick="Swal.fire(
                            '<?php echo $swalTitle; ?>',
                            '<?php echo $swalMessage;?> nilai phnya  <?php echo $ph; ?>',
                            'info'
                        )">
                            <i class="bi bi-thermometer-high opacity-10"></i>
                        </button>
                    </div>

                        <!-- Tambahkan kode yang ingin ditampilkan ketika suhu berada dalam kondisi normal di sini -->
                    @endif
                @else
                    <!-- Tampilkan pesan jika $latestData tidak ada -->
                    <p>Data tidak ditemukan.</p>
                @endif

            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="phChart" class="chart-canvas" height="120"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- status -->
        <div class="col-lg-3">


        </div>
        <!-- end hader -->
        <!-- table -->
        <div class="row mt-5">
        <div class="col">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data PH</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai Ph</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($recentData as $recent)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $recent->created_at }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->pH }}</p>
                      </td>
                      <td>
                            <span class="text-xs font-weight-bold">
                                @if($recent->pH < 5)
                                    <span style="color:red; font-size:1.5rem;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </span>
                                @elseif($recent->pH > 9)
                                    <span style="color:#F86F03; font-size:1.5rem;">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                    </span>
                                @else
                                    <span style="color:green; font-size:1.5rem;">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </span>
                                @endif
                            </span>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
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
      <!-- end dashbord -->
@endsection


@if ($latestData)
    <script>
        // Ambil data pH dari PHP
        var pH = <?php echo $latestData->pH; ?>;

        // Logika notifikasi
        if (pH > 4) {
            // Notifikasi push jika pH lebih besar dari 9
            showNotification('pH Tinggi', 'pH ikan terlalu tinggi (' + pH + '). Segera lakukan tindakan untuk menurunkan pH ikan.', 'danger');
        } else if (pH < 4) {
            // Notifikasi push jika pH kurang dari 4
            showNotification('pH Rendah', 'pH ikan terlalu rendah (' + pH + '). Segera lakukan tindakan untuk meningkatkan pH ikan.', 'warning');
        }

        function showNotification(title, message, type) {
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    displayNotification(title, message, type);
                } else if (Notification.permission !== 'denied') {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === 'granted') {
                            displayNotification(title, message, type);
                        }
                    });
                }
            }
        }

        function displayNotification(title, message, type) {
            var notificationOptions = {
                body: message,
                icon: './assets/img/pakanin.png' // Ganti dengan URL gambar ikon notifikasi Anda
            };

            var notification = new Notification(title, notificationOptions);
        }
    </script>
@else
    <p>Tidak ada data terbaru.</p>
@endif
