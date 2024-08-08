@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="{{ asset('/image/image2.png') }}" alt="" width="350px" height="130px">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Pelanggan</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $invoice->customer->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Perusahaan</td>
                                        <td>:</td>
                                        <td>CV Refcool Mitra Teknik</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Jl. Pojok Utara 2 No. 226</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>0853-2148-0170</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>support@daengweb.id</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12 mt-3 x_content">
                                <form action="{{ route('invoice.update', ['id' => $invoice->id]) }}" method="post">
                                    @csrf
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Produk</td>
                                                <td>Qty</td>
                                                <td>Harga</td>
                                                <td>Subtotal</td>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach ($invoice->detail as $detail)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $detail->product->title }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    <td>Rp {{ number_format($detail->price) }}</td>
                                                    <td>Rp {{ $detail->subtotal }}</td>
                                                    <td>
                                                        <form action="{{ route('invoice.destroy', $detail->id) }}"
                                                            method="POST" align="center">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE"
                                                                class="form-control">
                                                            <button class="btn btn-danger btn-xs"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->

                                        <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="hidden" name="_method" value="PUT"
                                                        class="form-control">
                                                    <select name="product_id" class="form-control">
                                                        <option value="">Pilih Produk</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" min="1" value="1" name="qty"
                                                        class="form-control" required>
                                                </td>
                                                <td colspan="3" align="center">
                                                    <button class="btn btn-success btn-sm"><i
                                                            class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                    </table>
                                </form>
                            </div>
                            <!-- MENAMPILKAN TOTAL & TAX -->
                            <div class="col-md-4 offset-md-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoice->total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak 11%</td>
                                        <td>:</td>
                                        <td>(Rp {{ number_format($invoice->tax) }})</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>Rp {{ number_format($invoice->total_price) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- MENAMPILKAN TOTAL & TAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
