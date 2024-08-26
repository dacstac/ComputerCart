@extends('nav')
@section('content')
    <div class="container-fluid">
        {{-- <table class="table">
            {{-- <caption></caption> --}}
        {{-- @foreach ($images as $item)
                @if ($item->cover_image == 1)
                    @foreach ($products as $value)
                        @if ($value->id == $item->products_id)
                            <td>
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" alt="Card image cap"
                                        src="{{ asset('storage/images/' . $item->image_path) }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $value->name }}</h5>
                                        <p class="card-text">{{ $value->description }}</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </td>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>
        {!! $products->withQueryString()->links() !!} --}}

        <div class="row">
            @foreach ($images as $item)
                @if ($item->cover_image == 1)
                    @foreach ($products as $value)
                        @if ($value->id == $item->products_id)
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" alt="Card image cap"
                                    src="{{ asset('storage/images/' . $item->image_path) }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $value->name }}</h5>
                                    <p class="card-text">{{ $value->description }}</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        {!! $products->withQueryString()->links() !!}

    </div>
@endsection
