@extends('layouts.app')

@section('content')
<div class="container">
        <h3 class="mb-3">Курсы валют на сегодня  {{ date('Y-m-d') }}</h3>

        <exchange-component class="mt-3"
                            v-bind:currencies='@json($currencies)'
                            >
        </exchange-component>

</div>
@endsection
