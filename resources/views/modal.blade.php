<div class="modal fade" id="listModal" tabindex="-1" aria-labelledby="addContent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addContent">
                <div class="modal-header">
                    <h5 class="modal-title">Добавление элемента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="contentName" placeholder="Название">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="contentAuthor" placeholder="Автор"> <!-- TODO НЕ везде -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
