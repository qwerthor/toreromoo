@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1>Moo Dashboard</h1>
    </div>
</div>

<div class="row">

    <div class="col-sm-12">
        <h4>Porfolio input</h4>
        <form>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">With textarea</span>
                </div>
                <textarea class="form-control" aria-label="With textarea" rows="10"></textarea>
            </div>
        </form>
    </div>
</div>

<div class="row mt-3">

    <div class="col-sm-12">
        <h4>Other</h4>
        <a href="parseGainLoss">Parse Gain Loss</a>
    </div>
</div>

@endsection

@section('js')

@endsection