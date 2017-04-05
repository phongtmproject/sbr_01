@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/bower_components/metisMenu/dist/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/sweetalert/sweetalert.css') }}">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/book-list.css') }}" rel="stylesheet">
@endsection

@section('content')
    <hr>
    <div class="container row content-custom">
        <div class="col-md-3 col-xs-6 col-sm-3 back-gr">
            {{--sidebar--}}
            @include ('layouts.sidebar-left')
        </div>
        <div class="col-md-9 col-xs-6 col-sm-9 back-gr">
            <div class="row">
                <div class="col-md-8 col-xs-12 col-sm-8">
                    @if (count($books) == 0)
                        <h2 class="title text-center">{{ trans('book.not-found') }}</h2>
                    @endif
                    <h2 class="title text-center">{{ $title }}</h2>
                </div>
                {{--search box--}}
                {!! Form::open(['method' => 'GET', 'url' => 'books']) !!}
                <div class="col-md-4 col-xs-12 col-sm-4 margin-top">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="{{ trans('sidebar.search') }}"
                        value="{{ $search }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default-sm" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @foreach ($books as $book)
                @include('layouts.book-item')
            @endforeach
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12 back-gr">
            <div class="pull-right pagination-sm">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src='{{ asset('/bower_components/metisMenu/dist/metisMenu.min.js') }}'></script>
    <script src='{{ asset('/js/book-show.js') }}'></script>
@endsection
