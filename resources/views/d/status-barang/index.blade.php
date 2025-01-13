@extends('d.dpartials.layouts')

@section('title')
<title>Denshop | {{ $title }}</title>
@endsection

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Laporan transaksi terbaru</h2>
        <a class="btn btn-outline-danger" style="margin-right: 70px" href="history-barang-status/all">
            Print semua data
        </a>
    </div>
    @if (session()->has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert"> {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>

    @endif

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
              <tr>
                @php $nomer = 1; @endphp
                <th scope="col" width="3%">No</th>
                <th scope="col" width="10%">Waktu</th>
                <th scope="col" width="5%">Status</th>
                <th scope="col" width="8%">Desc</th>
                <th scope="col" width="8%">Oleh</th>
                <th scope="col" width="15%"> Products</th>
                <th scope="col" width="6%">Jumlah</th>
              </tr>
            </thead>

              <tbody>
                  @foreach($statusbarang as $status)
                  <tr>
                <td>{{$nomer++}}</td>
                <td>{{ $status->waktu->isoformat('D/M/YYYY') }}</td>
                <td>{{$status->status}}</td>
                <td>{{$status->desc}}</td>
                <td>{{$status->users->name ?? '-'}}</td>
                <td><a href="/dashboard/product/{{ $status->Products->id }}/detail"> {{$status->Products->nm_products}} </a></td>
                <td>{{$status->jumlah}}</td>
            </tr>
                @endforeach

            </tbody>

            <script>
              $(document).ready( function () {
              $('#mytable').DataTable();
                } );
            </script>
          </table>
        </div>


    </main>
  </div>
</div>

@endsection
