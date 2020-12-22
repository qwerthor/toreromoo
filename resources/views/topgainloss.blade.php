@extends('layouts.app')

@section('content')
<div id="app">
    <div class="row-fluid">
        <div class="col">
            <h1>Top Gain Loss</h1>
            <table class="table table-sm table-dark table-hover nowrap" id="tableGL">
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
                        <td class="text-right">Max Down (6.9%) *2</td>
                        <td class="text-right">Low - Change</td>
                        <td class="text-right">Close - Change</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="d in gainloss">
                        <td v-bind:class="{ 'bg-info' : d.checked == 1}">
                            <a :href="'https://www.google.com/search?q=IDX%3A' + d.emiten.code" target="_blank" class="text-white" @click="changeRowColor(d)">
                                @{{ d.emiten.code }} @{{ d.emiten.name }}
                            </a>

                            <a :href="pdPath + d.emiten.code" target="_blank" class="text-white">
                                , Direct
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
                        <td class="text-right">@{{ d.close - (d.close * 13.8 / 100) | nf}}</td>
                        <td class="text-right">@{{ d.low - d.change | nf}}</td>
                        <td class="text-right">@{{ d.close - d.change | nf}}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="inDateStart"></div>
            <input type="hidden" id="inputDateStart">
        </div>

        <div class="col">
            <div id="inDateEnd"></div>
            <input type="hidden" id="inputDateEnd">
        </div>

        <div class="col">
            <button type="button" class="btn btn-danger" @click="processParse('loss')">Get Loss</button>
            <button type="button" class="btn btn-success" @click="processParse('gain')">Get Gainers</button>
            <button type="button" class="btn btn-primary" @click="processParse('all')">All</button>
        </div>
        <div class="col">
            
        </div>
    </div>
</div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/numeral.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var gainloss = @json($gainloss);
    var pdPath = '{{ $pdDirectPath }}';

    var vm = new Vue({
        el: '#app',
        data: {
            gainloss: gainloss,
            dpStart: null,
            dpEnd: null,
        },
        mounted: function() {
            $('#tableGL').DataTable({
                paging: false,
                responsive: true,
            });

            dpStart = $('#inDateStart').datepicker({
                todayHighlight: true,
            });

            dpStart.datepicker('setDate', 'now');

            dpEnd = $('#inDateEnd').datepicker({
                todayHighlight: true,
            });

            dpEnd.datepicker('setDate', 'now');
        },
        methods: {
            processParse: function(mode) {
                var pStartDate = self.dpStart.datepicker('getFormattedDate');
                var pEndDate = self.dpEnd.datepicker('getFormattedDate');

                var ProcessURL = 'pd/gettoploss?start=' + pStartDate + '&end=' + pEndDate + '&mode=' + mode;
                window.location.href = ProcessURL;
            }, 
            changeRowColor: function(par){
                par.checked = 1;
            }
        },
        filters: {
            nf: function(value) {
                return numeral(value).format('0,0');
            }
        }

    });
</script>

@endsection

@section('css')
<link href="{{ asset('css/bootstrap-datepicker3.standalone.min.css') }}" rel="stylesheet">
@endsection