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
                {{Form::open(['method'=>'POST','id'=>'formulario','enctype'=>'multipart/form-data', 'class'=>'row','onsubmit'=>'save(this); return false;'])}} <!-- 'url'=>'project/create',  -->
                <!-- <form enctype="multipart/form-data" class="row" onsubmit="save(this); return false;"> -->
                <input type="hidden" name="token" value="{{{ csrf_token() }}}" id="token" readonly="true" />
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <label for="clientQuoteProduct"><strong style="color:red">*</strong><strong>Cliente</strong></label>
                        <select class="custom-select" id="clientQuoteProduct" name="clientQuoteProduct" required>
                            <option value="-1" selected>Selecciona un cliente</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="contactQuoteProduct"><strong style="color:red">*</strong><strong>Contacto</strong></label>
                        <select class="custom-select" id="contactQuoteProduct" name="contactQuoteProduct" required disabled>
                            <option value="-1" id="optionContactQuoteProduct" selected> Debes de seleccionar un cliente</option>
                            @foreach($contacts as $contact)
                            <option value="{{$contact->id}}">{{$contact->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="dateQuoteProduct"><strong style="color:red">*</strong><strong>Fecha de cotizacion</strong></label>
                        <input type="date" class="form-control" name="dateQuoteProduct" id="dateQuoteProduct" value="" required>
                    </div>

                    <!-- <div class="custom-file">
                        <input type="file" id="fileQuotesProduct" name="fileQuotesProduct" multiple onchange="validationExtension()" />
                        <span id="errorFileQuotesProduct" style="color:red"></span>
                    </div> -->
                    <!-- <div class="">
                         <input type="file" name="file[]"  class="file" id="file" multiple> 
                        <input id="input-b3" name="input-b3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                    </div> -->

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
                <div class="col-md-12">
                    <!-- <input type="file" class="file" id="file" name="file[]" multiple> -->
                    <!-- <div class="file-loading">
                        <input id="input-44" name="input44[]" type="file" multiple>
                    </div> -->
                    <!-- <input id="file" name="file" type="file" onchange="validationExtension()" multiple required> -->

                    <input type="file" name="file" id="file"  accept="image/*" multiple required>
                    <span id="errorFileQuotesProduct" style="color:red"></span>
                    <!-- <input id="input-b1" name="input-b1" type="file" data-browse-on-zone-click="true" re> -->
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
<!-- 
    <div class="form-row">
                        <div class="col">
                            <div class="sm-form">
                                <input type="file" name="file4" class="file" id="file4" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <div id="errorBlock"></div>
 -->