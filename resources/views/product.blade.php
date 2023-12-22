<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Продукты</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    </head>
    <body class="container-fluid">
        <div class="row flex-nowrap">
            <div id="left-panel" class="col-auto col-2 bg-dark">
                <div class="d-flex flex-column align-items-center text-white min-vh-100">
                    <div id="logo">
                        Enterprise Resource Planning
                    </div>
                    <div id="title">
                        Продукты
                    </div>
                </div>
            </div>
            <div id="main" class="col-10">
                <nav id="head-panel" class="navbar bg-body-tertiary">
                    Продукты
                    @auth
                    {{ Auth::user()->name }}
                    @endauth
                    @guest
                    <a href="{{ route('login') }}">Login</a>
                    @endguest
                </nav>
                @if($errors->any())
                <div>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div id="data" class="col-11">
                        <table class="table table-striped">
                            <tr>
                                <th>АРТИКУЛ</th>
                                <th>НАЗВАНИЕ</th>
                                <th>СТАТУС</th>
                                <th>АТРИБУТЫ</th>
                            </tr>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->article }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->status }}</td>
                                <td>
                                    @foreach($product->data as $attr)
                                    {{ $attr }}<br>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div id="control" class="col-1">
                        <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#addProductModal">Добавить</button>
                    </div>
                </div>              
                <div class="modal fade" id="addProductModal" tabindex="-1"
                     aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="addProductModalLabel">Добавить продукт</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('addProduct') }}" id="newProduct">
                                    @csrf
                                    <div class="mb-3">
                                        <lable class="form-label">Артикул<input type="text" name="article" class="form-control"></lable>
                                    </div>
                                    <div class="mb-3">
                                        <lable class="form-label">Название<input type="text" name="name" class="form-control"></lable>
                                    </div>
                                    <div class="mb-3">
                                        <lable class="form-label">Статус
                                            <select name="status" class="form-select">
                                                <option value="available">Доступен</option>
                                                <option value="unavailable">Не доступен</option>
                                            </select>
                                        </lable>
                                    </div>
                                    <h4>Атрибуты</h4>
                                    <div id="attributes">
                                    </div>
                                    <button type="button" id="addAttribute" class="btn btn-link">+Добавить атрибут</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="newProductSubmit">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="http://localhost:5173/resources/js/product.js"></script>
    </body>
</html>