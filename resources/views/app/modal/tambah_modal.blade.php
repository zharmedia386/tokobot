@extends('layouts.master-1')
@section('title', 'Tambah Modal')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Modal</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Modal</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama modal anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Saldo Awal (Harga Modal)</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal harga modal anda" />
            </div>
            <!--<div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select mb-3 shadow-none" disabled="">
                    <option selected="">Tunai</option>
                    <option value="1">Kredit</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Diskon Pembelian</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Diskon Pembelian.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Produk yang dibeli</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Produk yang dibeli.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Pajak</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Pajak.." />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Total Pembelian</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Total Pembelian.." />
            </div>-->
            <button type="submit" class="btn btn-primary rounded">Submit</button>
            <button type="button" class="btn btn-danger rounded" href="{{ route('modal') }}">Cancel</button>
            
        </form>
    </div>
</div>


@endsection