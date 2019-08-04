<div class="modal modal-info fade" id="modal-pdf-view">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">
          {{$modalTitle}}
        </h4>
      </div>
      <div class="modal-body">
        {{$slot}}
      </div>
      <div class="modal-footer">

        {{$modalBtn}}
        {{--<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline">Save changes</button> --}}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>