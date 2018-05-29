@extends('main')

@section('content')
    <div class="container h-100">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">filename</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $file)
                <tr>
                    <td>{{$file}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection