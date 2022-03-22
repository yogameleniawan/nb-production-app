@extends('user.layouts.app')
@section('css')
    <style>
        .form-control {
            padding: 1.1rem 0.75rem;
        }
        .form-group[class*=has-icon-].has-icon-right .form-control {
            padding-right: 2.5rem;
            border-radius: 10px;
        }

        .banner-img{
            width:100%;filter: brightness(0.3);
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .img-container {
            position: relative;
            text-align: center;
            color: white;
        }

        .card-position{
            position: relative;
            margin-top: -10%;
            width: 90%;
            margin-left: 5%;
        }

        .row-card {
            display: flex;
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
            margin-right: 10px;
        }

        .card-head .card-body-head {
            /* padding: 1.5rem; */
        }

        .card-body-head {
            flex: 1 1 auto;
            padding: 0.8rem;
            background-color: white;
            border-radius: 15px;
        }

        .total-product{
            background-color: #4fbe87;
            text-align: center;
            border-radius: 10px;
            color: white;
        }

        .total-product-done{
            background-color: #435ebe;
            text-align: center;
            border-radius: 10px;
            color: white;
        }

        .form-control-total{
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #607080;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #dce7f1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

    </style>
@endsection
@section('page-heading')
    <div class="col-12 img-container">
        <img src="{{url('img/banner.jpeg')}}" class="banner-img">
        <div class="centered">Selamat datang, <br> <small style="font-size:20px">User!</small></div>
    </div>

    <div class="row-card card-position" >
        <div class="col-6">
            <div class="card-head">
                <div class="card-body-head">
                    <div class="row">
                        <div class="col-12">
                            <b>Produk</b><br>
                            <p>Pesanan Kamu</p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <p><i class="bi bi-cart-fill" style="color: #4fbe87;"></i>  Total</p>
                                </div>
                                <div class="col-5">
                                    <p id="total-product" class="total-product">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-head">
                <div class="card-body-head">
                    <div class="row">
                        <div class="col-12">
                            <b>Produk</b><br>
                            <p>Total bayar</p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p> <i class="bi bi-credit-card-fill" style="color: #435ebe;margin-right: 10px;"></i> Rp. <span id="total-payment">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="form-group position-relative has-icon-right m-3">
    <input type="text" class="form-control" placeholder="Cari Produk ... ">
    <div class="form-control-icon">
        <i class="bi bi-search"></i>
    </div>
</div>

@endsection
@section('content')
@foreach ($products as $item)

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4"><img src="{{$item->image}}" class="img-product"/></div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <small>{{$item->name}}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><b>Rp. <span id="item-price">{{ number_format($item->price, 2) }}</span></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div id="parent-btn{{$item->id}}" class="col-8 add-to-cart">
                                <b class="d-block" id="btn-pesan{{$item->id}}" onclick="onPesan({{$item->price}}, {{$item->id}}, '{{$item->name}}')"><i class="bi bi-cart-fill"></i> Pesan</b>
                                <b class="d-none" id="btn-batal{{$item->id}}" onclick="onPesan({{$item->price}}, {{$item->id}}, '{{$item->name}}')"><i class="bi bi-cart-dash-fill"></i> Batal</b>
                            </div>
                            <div class="col-4">
                                <input type="number" onclick="onClickValue({{$item->id}})" class="form-control-total" placeholder="0" id="total{{$item->id}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
@section('script')
    <script>
        var temp_val = 0;
        function onPesan(price,id,name){

            var a = $('#total-product').html()
            var total_final = 0


            if($('#btn-pesan'+id).hasClass('d-none')){
                total_final = +a - +$('#total'+id).val();
                $('#total'+id).val(0)
                $('#total'+id).removeClass('form-disabled');
                $('#total'+id).prop('disabled', false);
                $('#btn-batal'+id).addClass('d-none')
                $('#btn-pesan'+id).removeClass('d-none')
                $('#parent-btn'+id).removeClass('remove-from-cart')
                $('#parent-btn'+id).addClass('add-to-cart')

                    Toastify({
                        text: "Produk "+name+" berhasil dibatalkan",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#f3616d",
                    }).showToast();
            }else{
                total_final = +a + +$('#total'+id).val();
                $('#btn-batal'+id).removeClass('d-none')
                $('#btn-pesan'+id).addClass('d-none')
                $('#parent-btn'+id).addClass('remove-from-cart')
                $('#parent-btn'+id).removeClass('add-to-cart')
                $('#total'+id).prop('disabled', true);
                $('#total'+id).addClass('form-disabled');
                Toastify({
                        text: "Produk "+name+" berhasil ditambahkan",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
            }


            $('#total-product').html(total_final)

        }

        function onClickValue(id){
            temp_val = $('#total'+id).val()
        }
    </script>
@endsection