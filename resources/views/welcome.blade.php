<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <style>
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
    .footer {
      background-color: #f8f9fa;
      color: #6c757d;
      padding: 20px 0;
    }

    .footer .social-icons a {
      color: #6c757d;
      margin-right: 10px;
    }

    .footer .social-icons a:hover {
      color: #007bff;
    }
  </style>
  {{-- boostrap 4 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
  {{-- navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark  fixed-top" style="background-color: #00425A">
    <a class="navbar-brand" href="#">PAKANIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <!-- <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li> -->
      </ul>
    </div>
  </nav>

  {{-- grafik --}}
  <center>
  <div style=" width:65%;" class="mt-5">
    <br>
      <canvas id="myChart"></canvas>
      <canvas id="phChart"></canvas>

  </div>
</center>

<div class="container mt-5">
    <div class="row">
      <div class="col-md-4">
        <div class="card bg-primary text-white mb-3">
          <div class="card-body">
            <h5 class="card-title">NIlai PH</h5>
            <p class="card-text">Nilai: {{ $phair }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-success text-white mb-3">
          <div class="card-body">
            <h5 class="card-title">Nilai Suhu</h5>
            <p class="card-text">Nilai: {{ $suhu }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-danger text-white mb-3">
          <div class="card-body">
            <h5 class="card-title">Waktu</h5>
            <p class="card-text">Waktu: {{ $created_at }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-dark text-center text-white">

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright:
    <a class="text-white" href="">Amaw-Projek</a>
  </div>
  <!-- Copyright -->
</footer>



{{-- booostrap 4 --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
<!-- chart -->
    <script>
        var labels = [];
        var suhuData = [];

        var phLabels = [];
        var phData = [];

        // Memasukkan data suhu dan created_at ke dalam array labels dan suhuData
        @foreach ($recentData as $data)
            labels.push('{{ $data->created_at }}');
            suhuData.push('{{ $data->suhu }}');

            phLabels.push('{{ $data->created_at }}');
            phData.push('{{ $data->phair }}');
        @endforeach

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Grafik Suhu',
                    data: suhuData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var phCtx = document.getElementById('phChart').getContext('2d');
        var phChart = new Chart(phCtx, {
            type: 'line',
            data: {
                labels: phLabels,
                datasets: [{
                    label: 'Grafik pH',
                    data: phData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</body>
</html>
