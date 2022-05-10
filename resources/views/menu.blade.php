@extends('main')

@section('content')
    <section>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light rounded pt-3 pb-4">
                <div class="navbar-brand">
                    <h4 >{{ $title }}</h4>
                </div>

                <div class="collapse navbar-collapse">

{{--                    <form class="form-inline my-2 my-md-0 ml-auto">--}}
{{--                        <input class="form-control" type="text" placeholder="Search" aria-label="Search">--}}
{{--                    </form>--}}
                </div>
            </nav>
            @include('product.list')
        </div>
    </section>
@endsection
