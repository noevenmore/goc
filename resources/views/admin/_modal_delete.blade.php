<div class="modal fade" id="ModalDeleteWindow" tabindex="-1" role="dialog" aria-labelledby="ModalDeleteWindowLabel" aria-hidden="true">
  <div class="data-url" hidden>url</div>
  <div class="data-id" hidden>id</div>
  <div class="data-filename" hidden>name</div>
  <div class="data-route" hidden></div>
  <div class="data-static" hidden></div>
  
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalDeleteWindowLabel">Удалить</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Действительно хотите удалить?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="showModalWindowDelete();">Подтвердить</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>