@extends('templates.app')

@section('additional_headers')
<link rel="stylesheet" href="{{ asset('css/builds.css') }}" type="text/css" />
@endsection

@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_21.png')}}">
</div>
<section id="shop">
  <div class="row justify-content-center align-items-center">
    <div class="shop-intro col-12 d-flex justify-content-center mt-5 table-responsive">
      <div id="main">
        <div id="content_ajax">
          <article>
            <section class="body">
              <div id="root"></div>
            </section>
          </article>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('additional_scripts')
<script src="{{ asset('js/builds.js') }}"></script>
@endsection
