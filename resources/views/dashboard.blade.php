@extends('layouts.app')

@section('content')
<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <h1>Moo Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h4>Porfolio input</h4>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">JSON PD</span>
                </div>
                <textarea id="jsonPortfolio" class="form-control" aria-label="With textarea" rows="10" v-model="jsonPort"></textarea>
                <button class='btn btn-lg btn-primary' @click="postPort()">Process</button>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-12">
            <h4>Other</h4>
            <a href="parseGainLoss">Parse Gain Loss</a>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/vue.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    var pathParsePort = "{{ action('PortfolioController@parsePortfolio') }}";

    var vm = new Vue({
        el: '#app',
        data: {
            jsonPort: ''
        },
        methods: {
            postPort: function() {
                axios.post(pathParsePort, {
                        data: vm.jsonPort
                    })
                    .then(response => {
                        if (response.data.success) {
                            location.reload();
                        }
                    }).
                catch(err => {

                });
            }
        }
    });
</script>
@endsection