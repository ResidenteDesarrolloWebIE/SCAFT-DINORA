<div class="modal fade" id="createQuoteProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span type="hidden" name="_token" value="{{{ csrf_token() }}}" id="tokenLoadImages"> </span>
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="idFolio"><span class="fa fa-spinner" aria-hidden="true"></span>&nbsp;&nbsp;<strong class="modal-folio">CREAR NUEVA COTIZACION DE SUMINISTROS</strong></h4>
                <button type="button" class="" data-dismiss="modal">&times;</button>
            </div>

            <div class="alert alert-info alert-dismissible" style="margin: 5px 10px 0px 10px">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Recomendaciones: </strong> <br>&nbsp;&nbsp;Debes evitar espacios al inicio y al final de cada texto ingresado.
            </div>
            <div class="modal-body">
                {{Form::open(['id'=>'formulario','files'=>true, 'class'=>'row','onsubmit'=>'save(this); return false;'])}} <!-- 'url'=>'project/create',  -->
                @method('POST')
                <input type="hidden" name="token" value="{{{ csrf_token() }}}" id="token" readonly="true" />
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <label for="clientQuoteProduct"><strong style="color:red">*</strong><strong>Cliente</strong></label>
                        <select class="custom-select" id="clientQuoteProduct" name="clientQuoteProduct" required>
                            <option value="-1" selected>Selecciona un cliente</option>
                            @foreach($clients as $client)
                            <option value="{{$client->name}}">{{$client->name}}</option>
                            @endforeach
                            <!-- <option value="2">Cliente2</option>
                            <option value="3">Cliente3</option> -->
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="contactQuoteProduct"><strong style="color:red">*</strong><strong>Contacto</strong></label>
                        <select class="custom-select" id="contactQuoteProduct" name="contactQuoteProduct" required disabled>
                            <option value="-1" id="optionContactQuoteProduct" selected> Debes de seleccionar un cliente</option>
                            @foreach($contacts as $contact)
                            <option value="{{$contact->name}}">{{$contact->name}}</option>
                            @endforeach
                            <!-- <option value="2">Contacto2</option>
                            <option value="3">Contacto3</option> -->
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="dateQuoteProduct"><strong style="color:red">*</strong><strong>Fecha de cotizacion</strong></label>
                        <input type="date" class="form-control" name="dateQuoteProduct" id="dateQuoteProduct" value="" required>
                    </div>

                    <div class="custom-file">
                        <!-- <input type="file" class="form-control-file" id="fileQuotesProduct" name="fileQuotesProduct" multiple> -->
                        <!-- File input field -->

                        <input type="file" id="fileQuotesProduct" name="fileQuotesProduct" multiple onchange="validationExtension()" />
                        <span id="errorFileQuotesProduct" style="color:red"></span>
                        <!-- Image preview -->
                        <!-- <div id="imagePreview"></div> -->
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
                    </div>
                    <div class="form-group text-center custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="biddingQuoteProduct" name="biddingQuoteProduct">
                        <label class="custom-control-label" for="biddingQuoteProduct">Licitacion</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer " style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button><!-- type="button" onclick="save()" -->
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>