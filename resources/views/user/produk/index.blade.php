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
                            <p>Pesanan Anda</p>
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
                    @foreach ($cart_users as $item)
                    <div class="row">
                        <div class="col-3"><img src="{{url('img/martabak.jpg')}}" style="width: 90%"/></div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-12">
                                    <small>{{$item->name}}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p><b>Rp. <span id="item-price">{{ number_format($item->price, 0) }} x {{$item->product_total}}</span></b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row delete-button">
                                <div class="col-12">
                                    <div id="parent-btn{{$item->id}}" class="col-8 remove-from-cart">
                                        <div id="spinner-delete{{$item->id}}" class="d-none">
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            Deleting
                                        </div>
                                        <b id="btn-batal{{$item->id}}" onclick="removeStaging({{$item->id}}, '{{$item->name}}')"><i class="bi bi-cart-dash-fill"></i> Batal</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
                <div class="foot-accordion">
                    <span id="text-pesan">Pesan</span>
                    <div id="spinner" class="d-none">
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group position-relative has-icon-right">
    <input id="input-search" type="text" class="form-control" placeholder="Cari Produk ... ">
    <div class="form-control-icon">
        <i class="bi bi-search"></i>
    </div>
</div>

<div id="product-content">
@foreach ($products as $item)

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4"><img src="{{url('img/martabak.jpg')}}" class="img-product"/></div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <small>{{$item->name}}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><b>Rp. <span id="item-price">{{ number_format($item->price, 0) }}</span></b></p>
                            </div>
                        </div>
                        <div class="row">

                            <div id="parent-btn{{$item->id}}" class="col-8 add-to-cart">
                                <div id="spinner{{$item->id}}" class="d-none">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Processing...
                                </div>
                                <b class="d-block" id="btn-pesan{{$item->id}}" onclick="onPesan({{$item->price}}, {{$item->id}}, '{{$item->name}}')"><i class="bi bi-cart-fill"></i> Keranjang</b>
                                {{-- <b class="d-none" id="btn-batal{{$item->id}}" onclick="onPesan({{$item->price}}, {{$item->id}}, '{{$item->name}}')"><i class="bi bi-cart-dash-fill"></i> Batal</b> --}}
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
</div>
@endsection
@section('script')
    <script>
        var temp_val = 0;
        function onPesan(price,id,name){

            var total_product = $('#total-product').html()
            var total_final = 0
            var total_payment = 0

            var total = []

            total_final = +total_product + +$('#total'+id).val();
            total_payment = price * total_final


            addStaging($('#total'+id).val(),id,name)
            $('#total'+id).val('')
            $('#spinner'+id).removeClass('d-none')
            $('#btn-pesan'+id).addClass('d-none')
            getStagingTotal()

        }

        function onClickValue(id){
            temp_val = $('#total'+id).val()
        }

        function getStagingTotal(){
            $.ajax({
                url: "{{route('getStagingCart')}}",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data)
                    $('#total-payment').html(number_format(data.product_pay,0))
                    $('#total-product').html(number_format(data.product_total,0))
                }
            });
        }

        function addStaging(product_total, product_id, name){
            $.ajax({
                url: "{{route('store_cart')}}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'product_total': product_total,
                    'product_id': product_id,
                },
                statusCode: {
                        500: function (response) {
                            Toastify({
                                text: "Gagal menambahkan ke keranjang, isi total produk yang dibeli",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#f3616d",
                            }).showToast();
                            $('#spinner'+product_id).addClass('d-none')
                            $('#btn-pesan'+product_id).removeClass('d-none')
                        },
                },
                success:function(data) {
                    Toastify({
                        text: "Produk "+name+" berhasil ditambahkan",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    getCart()
                    getStagingTotal()
                    $('#spinner'+product_id).addClass('d-none')
                    $('#btn-pesan'+product_id).removeClass('d-none')

                    $('#input-search').val('')
                    searchProduct()
                }
            });
        }

        function removeStaging(product_id, name){
            $('#spinner-delete'+product_id).removeClass('d-none')
            $('#btn-batal'+product_id).addClass('d-none')
            $.ajax({
                url: "{{route('remove_cart')}}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'product_id': product_id,
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
                        text: "Produk "+name+" berhasil dibatalkan",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#f3616d",
                    }).showToast();
                    getCart()
                    getStagingTotal()
                    $('#spinner-delete'+product_id).addClass('d-none')
                    $('#btn-batal'+product_id).removeClass('d-none')
                }
            });
        }

        function getCart(){
            $.ajax({
                url: "{{route('getCart')}}",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    var html = ""
                    data.data.forEach(item => {
                        html += "<div class='row'>"
                        +"<div class='col-3'><img src='{{url('img/martabak.jpg')}}' style='width: 90%'/></div>"
                        +"<div class='col-5'>"
                            +"<div class='row'>"
                                +"<div class='col-12'>"
                                    +"<small>"+item.name+"</small>"
                                +"</div>"
                            +"</div>"
                            +"<div class='row'>"
                                    +"<div class='col-12'>"
                                        +"<p><b>Rp. <span id='item-price'>"+ number_format(item.price, 0) + " x " + item.product_total +"</span></b></p>"
                                    +"</div>"
                                +"</div>"
                            +"</div>"
                        +"<div class='col-4'>"
                            +"<div class='row delete-button'>"
                                +"<div class='col-12'>"
                                    +"<div id='parent-btn"+item.id+"' class='col-8 remove-from-cart'>"
                                    +"<div id='spinner-delete"+item.id+"' class='d-none'>"
                                    +"<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>"
                                    +"Deleting"
                                    +"</div>"
                                    +"<b id='btn-batal"+item.id+"' onclick='removeStaging("+item.id+", \""+item.name+"\")'><i class='bi bi-cart-dash-fill'></i> Batal</b>"
                                    +"</div>"
                               +"</div>"
                            +"</div>"
                        +"</div>"
                    +"</div>"
                    +"<hr>"
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

        function searchProduct(){
            $.ajax({
                url: "{{route('getProductSearch')}}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'keyword': $('#input-search').val(),
                },
                success:function(data) {
                    var html = ""
                    data.data.forEach(item => {
                        html += '<div class="row">'+
                        '    <div class="col-12 col-md-12 col-lg-12">'+
                        '        <div class="card">'+
                        '            <div class="card-body">'+
                        '                <div class="row">'+
                        '                    <div class="col-4"><img src="{{url('img/martabak.jpg')}}" class="img-product"/></div>'+
                        '                    <div class="col-8">'+
                        '                        <div class="row">'+
                        '                            <div class="col-12">'+
                        '                                <small>'+item.name+'</small>'+
                        '                            </div>'+
                        '                        </div>'+
                        '                        <div class="row">'+
                        '                            <div class="col-12">'+
                        '                                <p><b>Rp. <span id="item-price">'+ number_format(item.price, 0) +'</span></b></p>'+
                        '                            </div>'+
                        '                        </div>'+
                        '                        <div class="row">'+
                        ''+
                        '                            <div id="parent-btn'+item.id+'" class="col-8 add-to-cart">'+
                        '                                <div id="spinner'+item.id+'" class="d-none">'+
                        '                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>'+
                        '                                    Processing...'+
                        '                                </div>'+
                        '                                <b class="d-block" id="btn-pesan'+item.id+'" onclick="onPesan('+item.price+', '+item.id+', \''+item.name+'\')"><i class="bi bi-cart-fill"></i> Keranjang</b>'+
                        '                                {{-- <b class="d-none" id="btn-batal'+item.id+'" onclick="onPesan('+item.price+', '+item.id+', \''+item.name+'\')"><i class="bi bi-cart-dash-fill"></i> Batal</b> --}}'+
                        '                            </div>'+
                        '                            <div class="col-4">'+
                        '                                <input type="number" onclick="onClickValue('+item.id+')" class="form-control-total" placeholder="0" id="total'+item.id+'">'+
                        '                            </div>'+
                        '                        </div>'+
                        '                    </div>'+
                        '                </div>'+
                        '            </div>'+
                        '        </div>'+
                        '    </div>'+
                        '</div>'

                    });
                    $('#product-content').html(html)
                }
            });
        }

        function checkoutProduct(){
            $.ajax({
                url: "{{route('checkoutProduct')}}",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    Toastify({
                        text: "Produk berhasil dipesan",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    $('#spinner').addClass('d-none')
                    $('#text-pesan').removeClass('d-none')
                }
            });
        }

        $('#input-search').on('input', function(){
            searchProduct()
        });

        $('.foot-accordion').click(function(){
            if($('#text-pesan').hasClass('d-none')){
                $('#text-pesan').removeClass('d-none')
            }else{
                $('#text-pesan').addClass('d-none')
            }

            if($('#spinner').hasClass('d-none')){
                $('#spinner').removeClass('d-none')
            }else{
                $('#spinner').addClass('d-none')
            }
            checkoutProduct()
            getCart()
            getStagingTotal()
        })
    </script>
@endsection
