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
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="form-store" action="{{route('produk-toko.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Produk</label>
                                <input id="price" type="number" class="form-control" name="price">
                            </div>

                            <div class="form-group">
                                <label for="helpInputTop">Gambar Produk</label>
                                <input id="image" type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <div id="spinner-tambah" class="d-none btn btn-primary">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Processing..
                                </div>
                                {{-- <a id="btn-tambah" onclick="doStore()" class="btn btn-primary">Tambah Produk</a> --}}
                                <button type="submit" id="btn-tambah" class="btn btn-primary">Tambah Produk</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="header-accordion">
                    <p onclick="openAccordion()"><i id="icon-accordion" class="bi bi-caret-down-square-fill"></i> Lihat Data Produk </p>
                </div>
                <div class="body-accordion">
                    @foreach ($products as $item)

                    <div id="show-item{{$item->id}}">
                        <div class="row">
                            <div class="col-3"><img src="{{$item->image}}" style="width: 90%"/></div>
                            <div class="col-5">
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
                            </div>
                            <div class="col-4">
                                <div class="row delete-button">
                                    <div class="col-12">
                                        <div id="parent-btn-edit" class="col-8 mb-2 add-to-cart">
                                            <div id="spinner-edit" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Updating
                                            </div>
                                            <b id="btn-edit{{$item->id}}" onclick="doEdit({{$item->id}})"><i class="bi bi-pencil-fill"></i> Edit</b>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="parent-btn-delete" class="col-8 mb-2 remove-from-cart">
                                            <div id="spinner-delete{{$item->id}}" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Deleting
                                            </div>
                                            <b id="btn-delete{{$item->id}}" onclick="doRemove({{$item->id}})">Hapus</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div id="edit-form{{$item->id}}" class="d-none">
                        <div class="row" style="align-items: center;">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="nama_form">Nama Produk</label>
                                        <input type="email" class="form-control" id="nama_form{{$item->id}}" value="{{$item->name}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="harga_form">Harga</label>
                                        <input type="number" class="form-control" id="harga_form{{$item->id}}" value="{{$item->price}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col-12">
                                <div class="row delete-button">
                                    <div class="col-12">
                                        <div id="parent-btn-update" class="col-8 mb-2 add-to-cart">
                                            <div id="spinner-update{{$item->id}}" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Updating
                                            </div>
                                            <b id="btn-update{{$item->id}}" onclick="doUpdate({{$item->id}})"><i class="bi bi-pencil-fill"></i> Update</b>
                                        </div>

                                        <div id="parent-btn-cancel" class="col-8 remove-from-cart">
                                            <b id="btn-batal" onclick="doCancel({{$item->id}})"><i class="bi bi-x-square-fill"></i> Batal</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>

        function doEdit(id){
            $('#edit-form'+id).removeClass('d-none')
            $('#show-item'+id).addClass('d-none')
        }

        function doUpdate(id){

            $('#spinner-update'+id).removeClass('d-none')
            $('#btn-update'+id).addClass('d-none')
            $.ajax({
                url: "{{route('produk-toko.update', 1)}}",
                type: "PUT",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': id,
                    'name': $('#nama_form'+id).val(),
                    'price': $('#harga_form'+id).val(),
                },
                statusCode: {
                        500: function (response) {
                            Toastify({
                                text: "Gagal mengubah informasi toko",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#f3616d",
                            }).showToast();
                            $('#spinner-update'+id).addClass('d-none')
                            $('#btn-update'+id).removeClass('d-none')
                        },
                },
                success:function(data) {
                    Toastify({
                        text: "Berhasil mengubah informasi toko",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    $('#spinner-update'+id).addClass('d-none')
                    $('#btn-update'+id).removeClass('d-none')

                    $('#edit-form'+id).addClass('d-none')
                    $('#show-item'+id).removeClass('d-none')
                    fetchProduct()
                }
            });
        }

        function doRemove(id)
        {
            $('#spinner-delete'+id).removeClass('d-none')
            $('#btn-delete'+id).addClass('d-none')
            $.ajax({
                url: "{{route('produk-toko.destroy', 1)}}",
                type: "DELETE",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': id,
                },
                statusCode: {
                        500: function (response) {
                            console.log(response)
                            Toastify({
                                text: "Gagal menghapus toko",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#f3616d",
                            }).showToast();
                            $('#spinner-update'+id).addClass('d-none')
                            $('#btn-update'+id).removeClass('d-none')
                        },
                },
                success:function(data) {
                    Toastify({
                        text: "Berhasil menghapus toko",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    $('#spinner-delete'+id).addClass('d-none')
                    $('#btn-delete'+id).removeClass('d-none')

                    $('#edit-form'+id).addClass('d-none')
                    $('#show-item'+id).removeClass('d-none')
                    fetchProduct()
                }
            });
        }

        function doCancel(id){
            $('#edit-form'+id).addClass('d-none')
            $('#show-item'+id).removeClass('d-none')
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

        function Product(id,name,image,price){
            return (
                `
                <div id="show-item${id}">
                        <div class="row">
                            <div class="col-3"><img src="${image}" style="width: 90%"/></div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-12">
                                        <small>${name}</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><b>Rp. <span id="item-price">${number_format(price, 0)}</span></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row delete-button">
                                    <div class="col-12">
                                        <div id="parent-btn-edit" class="col-8 mb-2 add-to-cart">
                                            <div id="spinner-edit" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Updating
                                            </div>
                                            <b id="btn-edit${id}" onclick="doEdit(${id})"><i class="bi bi-pencil-fill"></i> Edit</b>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="parent-btn-delete" class="col-8 mb-2 remove-from-cart">
                                            <div id="spinner-delete${id}" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Deleting
                                            </div>
                                            <b id="btn-delete${id}" onclick="doRemove(${id})">Hapus</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div id="edit-form${id}" class="d-none">
                        <div class="row" style="align-items: center;">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="nama_form">Nama Produk</label>
                                        <input type="email" class="form-control" id="nama_form${id}" value="${name}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="harga_form">Harga</label>
                                        <input type="number" class="form-control" id="harga_form${id}" value="${price}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col-12">
                                <div class="row delete-button">
                                    <div class="col-12">
                                        <div id="parent-btn-update" class="col-8 mb-2 add-to-cart">
                                            <div id="spinner-update${id}" class="d-none">
                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                Updating
                                            </div>
                                            <b id="btn-update${id}" onclick="doUpdate(${id})"><i class="bi bi-pencil-fill"></i> Update</b>
                                        </div>

                                        <div id="parent-btn-cancel" class="col-8 remove-from-cart">
                                            <b id="btn-batal" onclick="doCancel(${id})"><i class="bi bi-x-square-fill"></i> Batal</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                `
            )
        }

        function fetchProduct(){
            $.ajax({
                url: "{{route('fetchProduct')}}",
                type: "GET",
                dataType: "json",

                success: function(data) {
                    var html = ""
                    data.data.forEach(item => {
                        html += Product(item.id, item.name, item.image, item.price)
                    });
                    $('.body-accordion').html(html)
                }
            });
        }
    </script>
@endsection
