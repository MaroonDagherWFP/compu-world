@extends('main')

@section('content')
    <div class="container h-100">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">filename</th>
                    <th scope="col">is shared</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Date Modified</th>
                    <th scope="col">Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $file)
                <tr>
                    <td>{{$file->filename}}</td>
                    <td>{{$file->shared == 1 ? 'YES' : 'NO'}}</td>
                    <td>{{$file->creator == 1 ? 'YES' : 'NO'}}</td>
                    <td>{{((new \DateTime())->setTimestamp($file->date_modified))->format('Y-m-d H:i:s')}}</td>
                    <td>{{$file->volume}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection