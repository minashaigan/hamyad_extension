@extends('subscription::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('subscription.name') !!}
    </p>

    <h3>Subscriptions</h3>
    <table>
        <tr>
            <th>Month</th>
            <th>Price</th>
        </tr>
        @foreach($subscriptions as $subscription)
            <tr>
                <td>{{config('subscription.month.'.$subscription->month)}}</td>
                <td>{{$subscription->price}}</td>
            </tr>
        @endforeach
    </table>
@stop