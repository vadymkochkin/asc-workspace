@extends('templates.app')
@section('content')
<div id="page-img-container">
    <img id="page-background" src="{{ asset('media/image/backgrounds/background_8.png')}}">
</div>
  <div class="modal fade" id="realm-editor" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Realm Editor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="realm-editor-body">
        </div>
        <div class="modal-footer" id="realm-editor-footer">
          <button type="button" class="btn btn-asc p-fix" data-dismiss="modal">Cancel</button>
          <button type="button" id="realm-save" class="btn btn-asc p-fix">Save</button>
        </div>
      </div>
    </div>
  </div>

  <section id="realmlist" class="panel" data-section-name="realmlist">
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center mb-5">
        <!--Admin Area-->
        @if (Auth::user()->canModerateRealms())
          <div class="col-12 mb-4">
            <button class="realm-add btn admin-btn float-right">Add New Realm</button>
          </div>
        @endif
        <div class="col-12 card-container justify-content-center d-flex">
        @foreach($realms as $realm)
          @if(App\Models\StoreItem::RealmHasTotalItem($realm->id)||Auth::user()->canModerateRealms())
            <div class="asc-card js-tilt col-3 p-0" id="test">
              <!--admin section-->
              @if (Auth::user()->canModerateRealms())
                <div class="edit-section" u-id="{{$realm->id}}">
                  <button class="btn admin-btn float-right m-1 realm-delete"><i class="material-icons">delete</i></button>
                  <button class="btn admin-btn float-right m-1 realm-edit"><i class="material-icons">edit</i></button>
                </div>
              @endif
                <a href="{{ route('store.realm', [ $realm->slug ]) }}">
                  <div class="card-front text-center">
                    <img src="{{ asset($realm->image) }}" class="fc__thumb"/>
                    <div class="card-desc text-center">
                      <h4>{{$realm->realm_name}}</h4>
                      <h5>Total Active Groups : {{App\Models\StoreItem::RealmHasTotalGroup($realm->id)}} </h5>
                      <h5>Total Active Items : {{App\Models\StoreItem::RealmHasTotalItem($realm->id)}} </h5>
                    </div>
                  </div>
                </a>
            </div>
          @endif
        @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
@section('additional_scripts')
  <script src="{{ asset('js/shop/shop-anim.js') }}"></script>
  <script src="{{ secure_asset('js/shop/realm-admin.js') }}"></script>
@endsection
