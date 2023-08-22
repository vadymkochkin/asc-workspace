<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center justify-content-center">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{$confirmTitle}}</h5>
            </div>
            <div class="modal-body text-center">
                <div class='other-character'>
                    <p class='other-character-text'>Search and add character(s) to send this item.(Character level will
                        be added automatically)</p>
                    <div class='other-characters'></div>
                    <input type='text' class='form-control other-character-input' placeholder='Character name'
                           style="width: 84%;float: left;margin-top: -3px;"/>
                    <button class='other-character-add btn btn-asc'><i class='material-icons'>add</i></button>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="">
                    Purchase
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="successModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center justify-content-center">
                <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Failed!</h5>
            </div>
            <div class="modal-body text-center">
                We were unable to complete the purchase for <span class="item-name">Whomper</span>, please try again.
                If this issue persists, please contact us at <span class="item-name">email@example.com</span>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Return
                    to shop
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center justify-content-center">
                <h5 class="modal-title" id="exampleModalCenterTitle">Success!</h5>
            </div>
            <div class="modal-body text-center">
                Your <span class="item-name">{{$item_info->name}}</span> <span id="result"></span>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Return
                    to shop
                </button>
            </div>
        </div>
    </div>
</div>