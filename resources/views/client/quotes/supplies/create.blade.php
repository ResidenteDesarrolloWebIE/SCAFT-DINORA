<div class="modal fade" id="createQuoteProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span type="hidden" name="_token" value="{{{ csrf_token() }}}" id="tokenLoadImages"> </span>
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="idFolio"><span class="fa fa-spinner" aria-hidden="true"></span>&nbsp;&nbsp;<strong class="modal-folio">CREAR NUEVA COTIZACION DE SUMINISTROS</strong></h4>
                <button type="button" class="" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <form class="row"> -->
                {{Form::open(['method' => 'POST','id'=>'formulario','files'=>true, 'class'=>'row'])}} <!-- 'url'=>'project/create',  -->
                <input type="hidden" name="token" value="{{{ csrf_token() }}}"   id="token" readonly="true"/>
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <label for="clientQuoteProduct"><strong style="color:red">*</strong><strong>Cliente</strong></label>
                        <select class="custom-select" id="clientQuoteProduct" name="clientQuoteProduct" required>
                            <option value="" selected>Selecciona un cliente</option>
                            <option value="1">Cliente1</option>
                            <option value="2">Cliente2</option>
                            <option value="3">Cliente3</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="contactQuoteProduct"><strong style="color:red">*</strong><strong>Contacto</strong></label>
                        <select class="custom-select" id="contactQuoteProduct" name="contactQuoteProduct" required>
                            <option value="" selected>Selecciona un contacto</option>
                            <option value="1">Contacto1</option>
                            <option value="2">Contacto2</option>
                            <option value="3">Contacto3</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="dateQuoteProduct"><strong style="color:red">*</strong><strong>Fecha de cotizacion</strong></label>
                        <input type="date" class="form-control" name="dateQuoteProduct" id="dateQuoteProduct" value="" required>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control-file" id="fileQuotesProduct" name="fileQuotesProduct" multiple>
                        <span id="errorFileQuotesProduct" style="color:red"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <label for="descriptionQuoteProduct"><strong>Descripcion</strong></label>
                        <textarea class="form-control" rows="3" id="descriptionQuoteProduct" name="descriptionQuoteProduct" pattern="/^[A-Za-z0-9\s]+$/g"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <label for="noteQuoteProduct"><strong>Notas</strong></label>
                        <textarea class="form-control" rows="3" id="noteQuoteProduct" name="noteQuoteProduct"></textarea>
                        <span id="errorNoteQuoteProduct" style="color:red"></span>
                    </div>
                    <div class="form-group text-center custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="biddingQuoteProduct" name="biddingQuoteProduct">
                        <label class="custom-control-label" for="biddingQuoteProduct">Licitacion</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer " style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="save()" class="btn btn-primary">Guardar</button><!-- type="button" onclick="save()" -->
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>
