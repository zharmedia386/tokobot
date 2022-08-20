@extends('layouts.master-1')
@section('title', 'Form Jangka Pendek')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Tambah Kewajiban Jangka Pendek</h4>
        </div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Nama Kewajiban</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nama kewajiban(utang) anda" />
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputdate">Nominal</label>
                <input type="text" class="form-control" id="exampleInputText1" placeholder="Masukkan nominal kewajiban(utang) anda" />
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
            <button type="button" class="btn btn-danger rounded" href="{{ route('kewajiban') }}">Cancel</button>
            
        </form>
    </div>
</div>


@endsection