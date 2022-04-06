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
        <div class="centered">Selamat datang, <br> <small style="font-size:20px">{{Auth::user()->name}}!</small></div>
    </div>
    <div class="row-card card-position" >
        <div class="col-6">
            <div class="card-head">
                <div class="card-body-head">
                    <div class="row">
                        <div class="col-12">
                            <b>Produk</b><br>
                            <p>Pesanan Pelanggan</p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <p><i class="bi bi-cart-fill" style="color: #4fbe87;"></i>  Total</p>
                                </div>
                                <div class="col-5">
                                    <p id="total-product" class="total-product">{{$product_total}}</p>
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
                                    <p> <i class="bi bi-credit-card-fill" style="color: #435ebe;margin-right: 10px;"></i> Rp. <span id="total-payment">{{number_format($product_pay,0)}}</span></p>
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
                <div class="header-accordion">
                    <p onclick="openAccordion()"><i id="icon-accordion" class="bi bi-caret-down-square-fill"></i> Lihat Pesanan Anda </p>
                </div>
                <div class="body-accordion">
                    @foreach ($transaction as $item)

                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <small>Nama Pelanggan : @foreach ($users as $u)
                                        @if ($u->id == $item->user_id)
                                        {{$u->name}}
                                        @endif
                                        @endforeach</small>
                                </div>
                            </div>
                            <hr>
                            <div class="d-none">{{$total = 0}}</div>
                            @foreach ($carts as $i)
                            @if ($i->transaction_id == $item->transaction_id)
                            <div class="d-none">{{$total += $i->price * $i->product_total}}</div>
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{url($i->image)}}" width="100%">
                                </div>
                                <div class="col-8">
                                    <p><b>Produk : </b>{{$i->name}}</p>
                                    <p><b>Rp. <span id="item-price">{{ number_format($i->price, 0) }} x {{$i->product_total}}</span></b></p>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <small>Total Bayar : </small><br>
                                    <p><b>Rp. <span id="item-price">{{number_format($total, 0)}}</span></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row delete-button">
                                <div class="col-12">
                                    <div id="parent-btn{{$item->id}}" class="col-8 add-to-cart">
                                        <div id="spinner-delete{{$item->id}}" class="d-none">
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            Processing
                                        </div>
                                        <b id="btn-batal{{$item->id}}" onclick="updateTransaction({{$item->transaction_id}},)"><i class="bi bi-cart-fill"></i> Proses</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        window.setInterval(function(){
            getComplete()
            getCompleteCart()
        }, 5000);

        function getCompleteCart(){
            $.ajax({
                url: "{{route('getCompleteCart')}}",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#total-payment').html(number_format(data.product_pay,0))
                    $('#total-product').html(number_format(data.product_total,0))
                }
            });
        }

        function updateTransaction(transaction_id){
            $('#spinner-delete'+transaction_id).removeClass('d-none')
            $('#btn-batal'+transaction_id).addClass('d-none')
            $.ajax({
                url: "{{route('transaksi.update','1')}}",
                type: "PUT",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'transaction_id': transaction_id,
                },
                statusCode: {
                        500: function (response) {
                            Toastify({
                                text: "Response: " + response,
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#f3616d",
                            }).showToast();
                        },
                },
                success:function(data) {
                    Toastify({
                        text: "Produk berhasil diproses",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    getComplete()
                    getCompleteCart()
                    $('#spinner-delete'+transaction_id).addClass('d-none')
                    $('#btn-batal'+transaction_id).removeClass('d-none')
                }
            });
        }

        function getComplete(){
            $.ajax({
                url: "{{route('getComplete')}}",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    var html = ""
                    var user = ""
                    var total = 0
                    data.data.forEach(item => {
                        var detail = ""
                        data.users.forEach(data => {
                            if(item.user_id == data.id){
                                user = data.name
                            }
                        })
                        data.carts.forEach(relation => {
                            if(relation.transaction_id == item.transaction_id){
                                total += relation.price * relation.product_total
                                detail +=
                                    `<div class="row">
                                        <div class="col-4">
                                            <img src="${relation.image}" width="100%">
                                        </div>
                                        <div class="col-8">
                                            <p><b>Produk : </b>${relation.name}</p>
                                            <p><b>Rp. <span id="item-price">${number_format(relation.price, 0)} x ${relation.product_total}</span></b></p>
                                        </div>
                                    </div>`
                            }

                            })
                        html += `
                <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <small>Nama Pelanggan : ${user}</small>
                                </div>
                            </div>
                            <hr>
                            `+detail+`<hr>
                            <div class="row">
                                <div class="col-12">
                                    <small>Total Bayar : </small><br>
                                    <p><b>Rp. <span id="item-price">${number_format(total, 0)}</span></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row delete-button">
                                <div class="col-12">
                                    <div id="parent-btn${item.id}" class="col-8 add-to-cart">
                                        <div id="spinner-delete${item.id}" class="d-none">
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            Processing
                                        </div>
                                        <b id="btn-batal${item.id}" onclick="updateTransaction(${item.transaction_id})"><i class="bi bi-cart-fill"></i> Proses</b>                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                `
                    });
                    $('.body-accordion').html(html)
                }
            });
        }

        function openAccordion(){
            if($('.body-accordion').hasClass('d-none')){
                $('#icon-accordion').removeClass('bi-caret-down-square-fill')
                $('#icon-accordion').addClass('bi-caret-up-square-fill')
                $('.body-accordion').removeClass('d-none')
            }else{
                $('.body-accordion').addClass('d-none')
                $('#icon-accordion').removeClass('bi-caret-up-square-fill')
                $('#icon-accordion').addClass('bi-caret-down-square-fill')
            }
        }
    </script>
@endsection
