@extends('layouts.app')


@section('content')
<div id="app">
    <div class="row">
        <div class="col-sm-12">
        <h1>Emiten</h1>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script>
    var vm = new Vue({
        el: '#app',
        data: {

        },
        methods: {

        }

    });
</script>

@endsection