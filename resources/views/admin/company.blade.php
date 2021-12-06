@extends('admin/layoutadmin')

@section('main')
<style>
    tr{
        font-size: 13px;
    }
</style>
<div>
    <div class="center">
            <div class="center-align">
                <h3>Companies List</h3>
            </div>
            <div style="overflow-x: scroll;">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Comapny Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone number</th>
                            <th>Pan number</th>
                            <th>Pan Certificate</th>
                            <th>Email Verification</th>
                            <th>Verify Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($company as $item)
                            <tr>
                                <td>{{$item->firstname}} {{$item->lastname}}</td>
                                <td>{{$item->cmpyname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->phonenumber}}</td>
                                <td>{{$item->pannumber}}</td>
                                <td><img class="materialboxed" src="{{asset('company/pancertificates/'.$item->pancertificate)}}" height="50" alt=""></td>
                                <td>@if ($item->emailverification == 'verified')
                                    <i class="material-icons">check</i>
                                @endif</td>
                                <td>
                                    <label>
                                        <input type="checkbox" />
                                        <span>Verify</span>
                                      </label>
                                </td>
                                <td><i class="material-icons">more_vert</i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
     $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
</script>
@endsection