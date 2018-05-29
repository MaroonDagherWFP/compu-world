@extends('main')
@section('content')
    <div class="container h-100">
        @if(isset($error))
            {{$error}}
        @endif
        @if(isset($data))
        <nav aria-label="pagination">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="search?page=1">First</a></li>
                @if($data->currentPage() === 1)
                    <li class="page-item disabled">
                        <a class="page-link" href="{{$data->url($data->currentPage() - 1)}}">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="search?page={{$data->currentPage() - 1}}">Previous</a>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{$data->url($data->currentPage() + 1)}}">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="{{$data->url($data->lastPage())}}">Last</a></li>
            </ul>
        </nav>  
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

