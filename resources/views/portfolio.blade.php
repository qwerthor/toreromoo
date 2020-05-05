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
                        <th class="text-right">1%=</th>
                        <th class="text-right">5% Up</th>
                        <th class="text-right">Market Max Bull</th>
                        <th class="text-right">Market Max Bear</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="d in portfolio">
                        <td>
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.emiten.code" target="_blank" class="text-white">
                                @{{ d.emiten.code }}
                            </a>
                        </td>
                        <td class="text-right">@{{ d.share_lot | nf }}</td>
                        <td class="text-right">@{{ d.avg_price | nf }}</td>
                        <td class="text-right">@{{ d.last_price | nf }}</td>
                        <td class="text-right text-success">@{{ Number(d.last_price * 1 / 100) | nf }}</td>
                        <td class="text-right text-success">@{{ Number(d.last_price) + Number(d.last_price * 5 / 100) | nf }}</td>
                        <td class="text-right text-success">@{{ Number(d.last_price) + Number(d.last_price * 25 / 100) | nf }}</td>
                        <td class="text-right text-danger">@{{ Number(d.last_price) - Number(d.last_price * 7 / 100) | nf }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            Calculate sell commision @{{ sellCommision }}.
            <div class="form-group">
                <input type="number" class="form-control" v-model="input_sell">
                @{{ sellWithCommision | nf }}
            </div>

        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/numeral.min.js') }}"></script>

<script>
    var portfolio = @json($portfolio);

    var vm = new Vue({
        el: '#app',
        data: {
            portfolio: portfolio,
            sellCommision: 0.29,
            buyCommision: 0.19,
            input_sell: 0
        },
        methods: {

        },
        computed: {
            sellWithCommision: function() {
                let v = this.input_sell - (this.sellCommision * this.input_sell / 100);
                return v;
            }
        },
        filters: {
            nf: function(value) {
                return numeral(value).format('0,0.00');
            }
        }

    });
</script>

@endsection