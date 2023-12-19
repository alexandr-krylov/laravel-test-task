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
                                data-bs-target="#addProdctModal">Добавить</button>
                    </div>
                </div>
                <div class="modal fade" id="addProductModal" tabindex="-1"
                     aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Добавить продукт</h3>
                            </div>    
                            <form method="post" action="{{ route('addProduct') }}">
                                @csrf

                                <div>
                                    <label>Артикул<input type="text" name="article"></label>
                                </div>
                                <div>
                                    <lable>Название<input type="text" name="name"></lable>
                                </div>
                                <div>
                                    <lable>Статус
                                        <select name="status">
                                            <option value="available">Доступен</option>
                                            <option value="unavailable">Не доступен</option>
                                        </select>
                                    </lable>
                                </div>
                                <h4>Атрибуты</h4>
                                <div>
                                    <div>
                                        <label>Название<input type="text" name="title[]">
                                        </label>
                                        <label>Значение<input type="text" name="value[]">
                                        </label>
                                    </div>
                                    <div>
                                        <label>Название<input type="text" name="title[]">
                                        </label>
                                        <label>Значение<input type="text" name="value[]">
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="button">Добавить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
</html>