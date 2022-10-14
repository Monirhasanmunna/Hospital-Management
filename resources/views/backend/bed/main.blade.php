@extends('layouts.backend.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-lg-2">
            <div class="card">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action text-primary">Bed</a>
                        <a href="{{route('app.bed.type.index')}}" class="list-group-item list-group-item-action text-primary {{Request::is('app/setting/bed/type/index')?'activate':''}}">Bed Type</a>
                        <a href="{{route('app.bed.group.index')}}" class="list-group-item list-group-item-action text-primary {{Request::is('app/setting/bed/group/index')?'activate':''}}">Bed Group</a>
                        <a href="{{route('app.floor.index')}}" class="list-group-item list-group-item-action text-primary {{Request::is('app/setting/floor/index')?'activate':''}}">Floor</a>
                      </div>
            </div>
        </div>
        <div class="col-lg-10">
            @yield('bed_content')
        </div>
    </div>
</div>
@endsection
