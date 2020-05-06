@extends('layouts.app')

@section('content')
<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <h1>Top Gain Loss</h1>
            <table class="table table-sm table-dark" id="tableGL">
                <thead>
                    <tr>
                        <td>Code</td>
                        <td class="text-right">Change Percent</td>
                        <td class="text-right">Change</td>
                        <td class="text-right">Close</td>
                        <td class="text-right">Prev</td>
                        <td class="text-right">High</td>
                        <td class="text-right">Low</td>
                        <td>High Date</td>
                        <td>Low Date</td>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="d in gainloss">
                        <td>
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.emiten.code" target="_blank" class="text-white">
                                @{{ d.emiten.code }}
                            </a>

                            <a :href="pdPath + d.emiten.code" target="_blank" class="text-white">
                                Direct
                            </a>
                        </td>
                        <td class="text-right">@{{ d.change_percent}}</td>
                        <td class="text-right">@{{ d.change | nf}}</td>
                        <td class="text-right">@{{ d.close | nf}}</td>
                        <td class="text-right">@{{ d.prev | nf}}</td>
                        <td class="text-right">@{{ d.high | nf}}</td>
                        <td class="text-right">@{{ d.low | nf}}</td>
                        <td>@{{ d.high_date}}</td>
                        <td>@{{ d.low_date}}</td>
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
<script src="{{ asset('js/numeral.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>

<script>
    var gainloss = @json($gainloss);
    var pdPath = '{{ $pdDirectPath }}';

    var vm = new Vue({
        el: '#app',
        data: {
            gainloss: gainloss
        },
        mounted: function() {
            $('#tableGL').DataTable({
                paging: false
            });
        },
        methods: {

        },
        filters: {
            nf: function(value) {
                return numeral(value).format('0,0.00');
            }
        }

    });
</script>

@endsection