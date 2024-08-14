<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-primary bg-primary fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand text-white fw-bold" href="#">Shopping</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                        aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="d-flex mt-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex ms-auto justify-content-between p-4">
                    <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                        Product</button>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img src="{{ asset($item->product_image) }}" alt="" width="60px"
                                                height="60px"></td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <a href="{{ $item->id }}" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal2{{ $item->id }}">Edit</a>
                                            <a href="{{ route('delete.product', $item->id) }}" class="btn btn-danger"
                                                id="delete">Delete</a>
                                                <a href="{{route('download.invoice', $item->id)}}" class="btn btn-warning"
                                                    >Download</a>
                                                    <a href="{{ $item->id }}" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3{{ $item->id }}">Buy</a>
                                            <!-- Button trigger modal -->
                                        </td>
                                        <!-- Modal Edit start-->
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal2{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 text-center"
                                                            id="exampleModalLabel">
                                                            Edit Product</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update.product') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}">
                                                            <div class="mb-3">
                                                                <input type="text" name="product_name"
                                                                    class="form-control" id=""
                                                                    placeholder="Product Name"
                                                                    value="{{ $item->product_name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="text" name="category"
                                                                    class="form-control" id=""
                                                                    placeholder="Category"
                                                                    value="{{ $item->category }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="text" name="price" id=""
                                                                    class="form-control" placeholder="Price"
                                                                    value="{{ $item->price }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="file" name="product_image"
                                                                    class="form-control" id="image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <img src="{{ asset($item->product_image) }}"
                                                                    alt="" id="showImage" width="70px"
                                                                    height="70px">
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Product</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!----Modal ends---->
                                        <!-----Modal Edit end-->


                                        <!-- Modal Edit start-->
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal3{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 text-center"
                                                            id="exampleModalLabel">
                                                            Buy Product</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('paypal') }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}">
                                                            <div class="mb-3">
                                                                <input type="text" name="product_name"
                                                                    class="form-control" id=""
                                                                    placeholder="Product Name"
                                                                    value="{{ $item->product_name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="text" name="category"
                                                                    class="form-control" id=""
                                                                    placeholder="Category"
                                                                    value="{{ $item->category }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="text" name="price" id=""
                                                                    class="form-control" placeholder="Price"
                                                                    value="{{ $item->price }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <input type="file" name="product_image"
                                                                    class="form-control" id="image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <img src="{{ asset($item->product_image) }}"
                                                                    alt="" id="showImage" width="70px"
                                                                    height="70px">
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Pay With PayPal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!----Modal ends---->
                                        <!-----Modal Edit end-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <!-----Modal start---->
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Add Product
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('store.product') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="email" value="admin@gmail.com">
                                            <div class="mb-3">
                                                <input type="text" name="product_name" class="form-control"
                                                    id="" placeholder="Product Name">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="category" class="form-control"
                                                    id="" placeholder="Category">
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" name="price" id=""
                                                    class="form-control" placeholder="Price">
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" name="product_image" class="form-control"
                                                    id="">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Add Product</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----Modal ends---->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>


    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            $(document).on("click", "#delete", function(e) {
                e.preventDefault();
                let link = $(this).attr("href");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                    }
                });
            });
        });
    </script>
</body>

</html>
