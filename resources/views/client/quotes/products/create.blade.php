<div class="modal fade" id="createQuoteProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span type="hidden" name="_token" value="{{{ csrf_token() }}}" id="tokenLoadImages"> </span>
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="idFolio"><span class="fa fa-spinner" aria-hidden="true"></span>&nbsp;&nbsp;<strong class="modal-folio">CREAR NUEVA COTIZACION</strong></h4>
                <button type="button" class="" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="row">
                    <div class="col-md-6">
                        <div class="form-group text-center">
                            <label for="formGroupExampleInput"><strong style="color:red">*</strong><strong>Cliente</strong></label>
                            <select class="custom-select">
                                <option selected>Selecciona un cliente</option>
                                <option value="1">Cliente1</option>
                                <option value="2">Cliente2</option>
                                <option value="3">Cliente3</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <label for="formGroupExampleInput2"><strong style="color:red">*</strong><strong>Contacto</strong></label>
                            <select class="custom-select">
                                <option selected>Selecciona un contacto</option>
                                <option value="1">Contacto1</option>
                                <option value="2">Contacto2</option>
                                <option value="3">Contacto3</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <label for="formGroupExampleInput2"><strong style="color:red">*</strong><strong>Fecha de cotizacion</strong></label>
                            <input type="date" class="form-control" name="quotation_estimateddate" id="quotation_estimateddate" value="" required>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="fileQuotesProduct" multiple>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-center">
                            <label for="formGroupExampleInput"><strong>Descripcion</strong></label>
                            <textarea class="form-control" rows="3" id="quotation_notes" name="quotation_notes"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="formGroupExampleInput2"><strong>Notas</strong></label>
                            <textarea class="form-control" rows="3" id="quotation_notes" name="quotation_notes"></textarea>
                        </div>
                        <div class="form-group text-center custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Licitacion</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer " style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>