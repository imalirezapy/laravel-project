@extends("layouts.master")
@section("title", $gateway)
@section("content")
@php
$fa = [
    "online" =>"پرداخت اینترنتی",
    "credit-card" =>"پرداخت در محل (با کارت بانکی)",
    "paypa"=> "پرداخت اعتباری",
]
@endphp
    {{$fa[$gateway]}}
    <p>{{$price}}</p>
    <form action="{{route("factor.store")}}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary" >
            پرداخت
        </button>
    </form>
    <form action="">
    @csrf
        <button type="button" class="btn btn-danger" >
            انصراف
        </button>
    </form>

@endsection
