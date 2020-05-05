@extends('layouts.app')


@section('content')
<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <h1>Portfolio</h1>
            <table class="table table-sm table-dark">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th class="text-right">Share Lot</th>
                        <th class="text-right">Avg Price</th>
                        <th class="text-right">Last Price (market)</th>

                        <th class="text-right">Market Max Bull</th>
                        <th class="text-right">Market Max Bear</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="d in portfolio">
                        <td>
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.emiten.code" target="_blank">
                                @{{ d.emiten.code }}
                            </a>
                        </td>
                        <td class="text-right">@{{ d.share_lot }}</td>
                        <td class="text-right">@{{ d.avg_price }}</td>
                        <td class="text-right">@{{ d.last_price }}</td>


                        <td class="text-right text-success">@{{ Number(d.last_price) + Number(d.last_price * 25 / 100) }}</td>
                        <td class="text-right text-danger">@{{ Number(d.last_price) - Number(d.last_price * 7 / 100)}}</td>
                    </tr>
                </tbody>

            </table>

            <table class="table table-sm table-dark">
                <thead>

                </thead>

                <tbody>
                    <tr v-for="d in portfolio">
                        <td>
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.emiten.code" target="_blank">
                                @{{ d.emiten.code }}
                            </a>
                        </td>
                        <td class="text-right">@{{ d.share_lot }}</td>
                        <td class="text-right">@{{ d.last_price }}</td>
                        <td class="text-right">@{{ d.avg_price }}</td>
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
    var portfolio = @json($portfolio);

    var vm = new Vue({
        el: '#app',
        data: {
            portfolio: portfolio
        },
        methods: {

        }

    });
</script>

@endsection