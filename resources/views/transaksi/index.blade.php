@extends('layouts.template')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Transaksi</h1>
    </div>

    <form action="{{url('transaksi/hitung')}}" method="POST">
        @csrf
        <div class="container-fluid" id="transaksi">
            
        </div>
        <div class="mt-5">
            <a class="btn btn-primary" id="btnTambah" onclick="addNewRow()">Tambah Sampah</a>
            <button class="btn btn-success" type="submit" onclick="addCounter()">Hitung</button>
        </div>
    </form>

    <hr>

    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Total Berat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->total_berat}}</td>
                            <td>{{$item->total_harga}}</td>
                            <td>{{$item->status}}</td>
                            <td><a href="{{route('transaksi.show', $item->id)}}" class="btn btn-primary btn-data" data-id="{{$item->id}}">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<script>
    let transaksi = document.getElementById('transaksi');
    let counter = 1; // Counter for tracking the number of added rows
    window.onload(function(){
    })

    function addCounter(){
        let hidden = document.createElement('div');
        hidden.innerHTML = `<input type="hidden" name="counter" value="${counter-1}">`;
        transaksi.appendChild(hidden);
    }

function addNewRow() {
    // Create a new div element
    let newRow = document.createElement('div');
    newRow.classList.add('row');

    // Add HTML content to the new row
    newRow.innerHTML = `
        <div class="col-sm-1">${counter}</div>
        <div class="col-sm-3">
            <label for="" class="form-label">Jenis Sampah</label>
            <select name="jenis_sampah${counter}" class="form-control">
                @foreach ($jenis as $item)
                    <option value="@php echo $item->id @endphp">@php echo $item->nama_jenis @endphp</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <label for="" class="form-label">Berat Sampah</label>
            <input type="number" class="form-control" name="berat${counter}">
        </div>
    `;

    // Append the new row to the transaksi container
    transaksi.appendChild(newRow);

    // Increment the counter for the next row
    counter++;
}
</script>
@endsection