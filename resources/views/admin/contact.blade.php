@extends('admin/layoutadmin')

@section('main')

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Phone no.</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $item)
                    <tr>
                        <td>{{$item->name}}</td>    
                        <td>{{$item->type}}</td>    
                        <td>{{$item->email}}</td>    
                        <td>{{$item->phone}}</td>    
                        <td>{{$item->message}}</td>    
                    </tr>                    
                @endforeach

            </tbody>
        </table>
    </div>

@endsection