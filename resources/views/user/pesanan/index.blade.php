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
                                    <p id="total-product" class="total-product">3</p>
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
                                    <p> <i class="bi bi-credit-card-fill" style="color: #435ebe;margin-right: 10px;"></i> Rp. <span id="total-payment">10.000</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4"><img src="{{url('img/martabak.jpg')}}" class="img-product"/></div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <small>Martabak</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><b>Rp. 25.000,0</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 add-to-cart">
                                <b><i class="bi bi-cart-fill"></i> Pesan</b>
                            </div>
                            <div class="col-4">
                                <b>[]</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4"><img src="{{url('img/martabak.jpg')}}" class="img-product"/></div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <small>Martabak</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><b>Rp. 25.000,0</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 add-to-cart">
                                <b><i class="bi bi-cart-fill"></i> Pesan</b>
                            </div>
                            <div class="col-4">
                                <b>[]</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4"><img src="{{url('img/martabak.jpg')}}" class="img-product"/></div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <small>Martabak</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><b>Rp. 25.000,0</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 add-to-cart">
                                <b><i class="bi bi-cart-fill"></i> Pesan</b>
                            </div>
                            <div class="col-4">
                                <b>[]</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
