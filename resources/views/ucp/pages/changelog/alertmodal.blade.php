<div class="modal fade" id="add_catagory" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle" aria-hidden="true">
     <form  action="{{ route('changelog.add_catagory') }}" method="POST">
           @csrf
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header text-center justify-content-center">
                  <h5 class="modal-title">Create category for Change Log</h5>
              </div>
              <div class="modal-body text-center">
                  <div class='other-character'>
                      <input type='text' name="catagory_name" class='form-control other-character-input' placeholder='Category Name' required/>
                  </div>
              </div>
              <div class="modal-footer justify-content-center">
                  <button type="button" class="btn-asc" data-dismiss="modal" data-toggle="modal"> Cancel </button>
                  <button  type="submit" class="btn-asc"  data-toggle="modal"> Create </button>
              </div>
          </div>
      </div>
    </form>
</div>
<div class="modal fade" id="add_changelog" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle" aria-hidden="true">
    <form  action="{{ route('changelog.add_changelog') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h5 class="modal-title">Create Change Log</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 mb-2">
                              <label for="realm-name text-left mb-4">Changelog Category</label>
                              <select name ="catagory" class ="form-control mb-2">
                                <option value="" selected="selected" disabled="disabled" >Select Category</option>
                                @foreach($changelog_types as $type)
                                  <option value="{{$type->id}}">{{$type->typeName}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-12 mb-2">
                              <label for="realm-name text-left mb-4">Details</label>
                              <textarea  name="changelog" class='form-control other-character-input' placeholder='Changelog details'></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn-asc" data-dismiss="modal" data-toggle="modal"> Cancel </button>
                        <button  type="submit" class="btn-asc"  data-toggle="modal"> Create </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if(session()->has('edit_info'))
<div class="modal fade" id="edit_changelog" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle" aria-hidden="true">
    <form  action="{{ route('changelog.save_changelog') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h5 class="modal-title">Edit Change Log</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 mb-2">
                                <label for="realm-name text-left mb-4">Changelog Category</label>
                                <input type="hidden" name="change_id" value="{{session()->get('edit_info')->change_id}}">
                                <select name ="catagory" class ="form-control mb-2">
                                  @foreach($changelog_types as $type)
                                    @if(session()->get('edit_info')->type == $type->id)
                                      <option value="{{$type->id}}" selected="selected">{{$type->typeName}}</option>
                                    @else
                                      <option value="{{$type->id}}">{{$type->typeName}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="realm-name text-left mb-4">Changelog Details</label>
                                <textarea  name="changelog" class='form-control other-character-input' placeholder='change details'> {{session()->get('edit_info')->changelog}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-asc" data-dismiss="modal" data-toggle="modal"> Cancel </button>
                    <button  type="submit" class="btn-asc"  data-toggle="modal"> Save </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endif

@if(session()->has('show_info'))
<div class="modal fade" id="show_changelog" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header text-center justify-content-center">
                  <h3 class="modal-title">{{session()->get('show_info')->Change_type->typeName}}</h3>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-12">
                          <div class="col-12 mb-2">
                              <div class="text-center">
                                  <h4><i class="fa fa-clock-o"></i> {{date("Y-m-d H:i:s", session()->get('show_info')->time)}}</h4>
                              </div>
                          </div>
                          <div class="col-12 mb-2 border p-2">
                              <div class="text-justify">
                                  <h3>{{session()->get('show_info')->changelog}}</h3>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-center">
                  <button type="button" class="btn-asc" data-dismiss="modal" data-toggle="modal"> Close </button>
              </div>
          </div>
      </div>
</div>
@endif
