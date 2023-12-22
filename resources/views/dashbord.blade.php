@extends('index')
@section('content')

<div class="row mb-5">
    <!-- Card Waktu 1 -->
    <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100
            @if($pH < 6.5 || $pH > 8.5)
                bg-danger text-white
            @elseif($temperature < 17)
                bg-danger text-white
            @elseif($temperature > 16 && $temperature < 22)
                bg-success text-white
            @elseif($temperature > 21)
                bg-success text-white
            @endif">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Waktu 1</h6>
                <div class="card-body p-3">
                    <p class="text-sm font-weight-bold mb-0">
                        <!-- Check temperature and pH, apply color -->
                        @if($pH < 6.5 || $pH > 8.5)
                        <span >Non aktiv</span>
                        @elseif($temperature < 17)
                            <span >Non Aktiv</span>
                        @elseif($temperature > 16 && $temperature < 22)
                            <span >Aktiv</span>
                        @elseif($temperature > 22)
                            <span >Aktiv</span>
                        @else
                            {{ $temperature }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Waktu 2 -->
    <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100
            @if($pH < 6.5 || $pH > 8.5)
                bg-danger text-white
            @elseif($temperature < 17)
                bg-danger text-white
            @elseif($temperature > 16 && $temperature < 22)
                bg-success text-white
            @elseif($temperature > 21)
                bg-success text-white
            @endif">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Waktu 2</h6>
                <div class="card-body p-3">
                    <p class="text-sm font-weight-bold mb-0">
                        <!-- Check temperature and pH, apply color -->
                        @if($pH < 6.5 || $pH > 8.5)
                        <span style="color:white;">Non aktiv</span>
                        @elseif($temperature < 17)
                            <span style="color:white;">Aktiv</span>
                        @elseif($temperature > 16 && $temperature < 22)
                            <span style="color:white;">Non Aktiv</span>
                        @elseif($temperature > 22)
                            <span style="color:white;">Aktiv</span>
                        @else
                            {{ $temperature }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Waktu 3 -->
    <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100
            @if($pH < 6.5 || $pH > 8.5)
                bg-danger text-white
            @elseif($temperature < 17)
                bg-danger text-white
            @elseif($temperature > 16 && $temperature < 22)
                bg-success text-white
            @elseif($temperature > 21)
                bg-success text-white
            @endif">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Waktu 3</h6>
                <div class="card-body p-3">
                    <p class="text-sm font-weight-bold mb-0">
                        <!-- Check temperature and pH, apply color -->
                        @if($pH < 6.5 || $pH > 8.5)
                        <span style="color:white;">Non aktiv</span>
                        @elseif($temperature < 17)
                            <span style="color:white;">Non Aktiv</span>
                        @elseif($temperature > 16 && $temperature < 22)
                            <span style="color:white;">Aktiv</span>
                        @elseif($temperature > 22)
                            <span style="color:white;">Aktiv</span>
                        @else
                            {{ $temperature }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>







    <div class="row">
        <!-- grafik -->
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Grafik Temperatur</h6>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="myChart" class="chart-canvas" height="150"></canvas>
              </div>
            </div>
        </div>
        </div>
    </div>



      <!-- table -->
        <div class="col-6">
          <div class="card mb-4 h-100">
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
                  @foreach($recentData as $data)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $data->created_at }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $data->temperature }}</p>
                      </td>
                      <td>
                            <span class="text-xs font-weight-bold">
                                @if($data->temperature < 15)
                                    <span style="color:red; font-size:1.5rem;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </span>
                                @elseif($data->temperature > 29)
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

      <!-- table -->
      <div class="row mt-5">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Grafik Ph</h6>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="phChart" class="chart-canvas" height="150"></canvas>
              </div>
            </div>
</div>
        </div>
    </div>
        <div class="col-6">
          <div class="card mb-4 h-100">
            <div class="card-header pb-0">
              <h6>Data Ph</h6>
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
                  @foreach($recentData as $data)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $data->created_at }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $data->pH }}</p>
                      </td>
                      <td>
                            <span class="text-xs font-weight-bold">
                                @if($data->pH < 4)
                                    <span style="color:red; font-size:1.5rem;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </span>
                                @elseif($data->pH > 9)
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
@endsection
