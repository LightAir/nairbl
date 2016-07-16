@extends('app')

@section('title', $title)

@section('content')
  {{-- Header --}}
  <div class="container">
    <div class="row main-header">
      <div class="col-xs-12 col-sm-2">
        <div class="logo">
          <a href="/">
            <img src="/assets/img/logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="col-xs-12 col-sm-9 col-sm-offset-1 col-md-7 col-md-offset-0">
        <h1>
          <span id="site-name-header">{{ $snHeader }}</span>
        </h1>
        <span id=help-header class="little-help">{{ $littleHelp }}</span>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>
  {{-- Body --}}
  <div class="container blog-body">
    <div class="row">
      {{-- tags --}}
      <div class="hidden-xs col-sm-2">
        <div class="tags-header">
          {{-- TODO add link to tags page --}}
          <a href="#">Tags</a>
        </div>
        <div class="tags-panel">
          {{-- TODO add link to tag --}}
        </div>
      </div>
      {{-- news --}}
      <div class="col-xs-12 col-sm-10">

      </div>
    </div>
  </div>
  {{-- Footer --}}
  <div class="container">
  </div>
@stop

@section('js')
@stop
