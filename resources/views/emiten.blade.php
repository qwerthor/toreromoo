@extends('layouts.app')

@section('content')
<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <h1>Emiten</h1>
            <table class="table table-sm table-dark">
                <thead>

                </thead>

                <tbody>
                    <tr v-for="d in emiten">
                        <td>
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.code" target="_blank">
                                @{{ d.code }}
                            </a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script>
    var emiten = @json($emiten);

    var vm = new Vue({
        el: '#app',
        data: {
            emiten: emiten
        },
        methods: {

        }

    });
</script>

@endsection