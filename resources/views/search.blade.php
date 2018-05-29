@extends('main')
@section('content')
    <div class="container h-100">
        @if(isset($error))
            {{$error}}
        @endif
        @if(isset($data))
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">filename</th>
                    <th scope="col">Date Modified</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $file)
                <tr>
                    <td>{{$file->filename}}</td>
                    <td>{{((new \DateTime())->setTimestamp($file->date_modified))->format('Y-m-d H:i:s')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection

