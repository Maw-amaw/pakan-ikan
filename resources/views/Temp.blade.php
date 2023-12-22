@extends('index')
@section('content')
<div id="notification-area"></div>
      <!-- dashbord -->
      <div class="row">
        <!-- grafik -->
      <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Grafik Temperatur</h6>
              <?php
                    $temperature = $latestData->temperature;

                    if ($temperature > 300) {
                        $status = "Bahaya";
                        $swalTitle = "temperature Berbahaya!";
                        $bgClass = "bg-gradient-danger";
                        $lakukan = "silakan nyalakan aerator pada aquarium";
                        $swalMessage = "temperature melebihi batas aman. Segera lakukan tindakan untuk menurunkan temperature ikan.";
                    } elseif ($temperature < 15) {
                        $status = "Bahaya";
                        $swalTitle = "temperature Berbahaya!";
                        $lakukan = "silakan nyalakan aerator pada aquarium";
                        $bgClass = "bg-gradient-warning";
                        $swalMessage = "temperature terlalu rendah. Segera lakukan tindakan untuk meningkatkan temperature ikan.";
                    } else {
                        $status = "Normal";
                        $swalTitle = "temperature Normal";
                        $bgClass = "bg-gradient-success";
                        $lakukan ="aman";
                        $swalMessage = "temperature ikan berada dalam kondisi aman.";
                    }
                    ?>
              @if ($latestData)
                    @if ($latestData->temperature > 31)
                    <i class="fa fa-arrow-up text-danger"></i>
                        <span class="font-weight-bold">{{ $latestData->temperature }}</span>
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-danger" onclick="Swal.fire(
                                '<?php echo $swalTitle; ?>',
                                '<?php echo $swalMessage;?> nilai Temperaturnya  <?php echo $temperature; ?>',
                                'info'
                            )">
                                <i class="bi bi-thermometer-high opacity-10"></i>
                            </button>
                        </div>
                        <!-- Tambahkan kode yang ingin ditampilkan ketika suhu lebih dari 300 di sini -->
                        @elseif ($latestData->temperature > 20)
                        <i class="fa fa-arrow-down text-warning"></i>
                        <span class="font-weight-bold">{{ $latestData->temperature }}</span>
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-warning" onclick="Swal.fire(
                                '<?php echo $swalTitle; ?>',
                                '<?php echo $swalMessage;?> nilai Temperaturnya  <?php echo $temperature; ?>',
                                'info'
                            )">
                                <i class="bi bi-thermometer-high opacity-10"></i>
                            </button>
                        </div>
                   <!-- Tambahkan kode yang ingin ditampilkan ketika suhu kurang dari 15 di sini -->
                    @else
                        <i class="fa fa-check-circle text-success"></i>
                        <span class="font-weight-bold">{{ $latestData->temperature }}</span>
                        <div class="d-flex justify-content-end align-items-center"> <!-- Add a container div with flex utilities -->
                            <button class="btn btn-success" onclick="Swal.fire(
                                '<?php echo $swalTitle; ?>',
                                '<?php echo $swalMessage;?> nilai Temperaturnya (<?php echo $temperature; ?>)',
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
                <canvas id="myChart" class="chart-canvas" height="120"></canvas>
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
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Temperatur</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nilai Temperwatur</th>
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
                        <p class="text-sm font-weight-bold mb-0">{{ $recent->temperature }}</p>
                      </td>
                      <td>
                            <span class="text-xs font-weight-bold">
                                @if($recent->temperature < 15)
                                    <span style="color:red; font-size:1.5rem;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </span>
                                @elseif($recent->temperature > 27)
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

<!-- notifikasi -->
@if($latestData)
    <script>
        // Ambil data suhu dari PHP
        var temperature = <?php echo $latestData->temperature; ?>;

        // Logika notifikasi
        if (temperature < 15) {
            // Menampilkan notifikasi push
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    showNotification();
                } else if (Notification.permission !== 'denied') {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === 'granted') {
                            showNotification();
                        }
                    });
                }
            }
        }

        function showNotification() {
            var notificationOptions = {
                body: 'Suhu ikan terlalu rendah (' + temperature + ' Celsius). Segera lakukan tindakan untuk meningkatkan suhu ikan.',
                icon: './assets/img/pakanin.png' // Ganti dengan URL gambar ikon notifikasi Anda
            };

            var notification = new Notification('Peringatan Suhu', notificationOptions);
        }
    </script>
@endif
