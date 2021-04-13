@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-end m-2">
                <h2>LARAVEL 8 Roles & Permission - User: {{ auth()->user()->name  . '(' . auth()->user()->getRoleNames()[0] . ')' . ' - ' . (isset(auth()->user()->getPermissionNames()[0]) ? auth()->user()->getPermissionNames()[0] : '') }}</h2>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-warning pull-right m-2 d-flex" type="submit">Log Out</button>
            </form>
            @role('writer|admin')
                <div class="pull-right m-2 d-flex">
                    <a class="btn btn-success" href="{{ route('post.create') }}"> پست جدید </a>
                </div>
            @endrole
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success d-flex justify-content-end">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>شناسه</th>
            <th>عنوان</th>
            <th>متن</th>
            <th> عملیات</th>
        </tr>

        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @role('editor|admin')
                            <a class="btn btn-info" href="{{ route('post.show', $post->id) }}">نمایش</a>
                            <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">ویرایش</a>
                        @endrole
                        @can('publish post')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
