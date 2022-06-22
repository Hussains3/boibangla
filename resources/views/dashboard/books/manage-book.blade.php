@extends('dashboard.layout.master')
@section('title','Manage Books2')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Books</h2>
                        <div class="clearfix"></div>
                    </div>
                    <form  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Book Type <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="bookType" id="bookType"  class="form-control col-md-7 col-xs-12">
                                    <option value="">Select</option>
                                    <option value="1">Simple</option>
                                    <option value="2">Varible</option>
                                </select>
                                <div id="attributesOptionError" class="error"></div>
                            </div>
                        </div>
                        <div class="x_content">
                            <div class="col-xs-3">
                                <ul class="nav nav-tabs tabs-left">
                                    <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                                    <li><a href="#inventory" data-toggle="tab">Inventory</a></li>
                                    <li><a href="#attributes" data-toggle="tab">Attributes</a></li>
                                    <li><a href="#variations" data-toggle="tab">Variations</a></li>
                                </ul>
                            </div>

                            <div class="col-xs-9 pull-left">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="form-group"  id="regularPriceInput">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="regularPrice">Regular Price <span id="field-required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="regularPrice" id="regularPrice"  class="form-control col-md-7 col-xs-12">
                                                <div  id="regularPriceError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="salePriceInput">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salePrice">Sale Price <span id="field-required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="salePrice" id="salePrice"  class="form-control col-md-7 col-xs-12">
                                                <div  id="salePriceError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="taxStatusInput">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Status <span id="field-required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="taxStatus" id="taxStatus"  class="form-control col-md-7 col-xs-12">
                                                    <option value="">Select</option>
                                                    <option value="Taxable">Taxable</option>
                                                    <option value="No">No</option>
                                                    <option value="Shipping Only">Shipping Only</option>
                                                </select>
                                                <div id="attributesOptionError" class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="inventory">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="regularPrice">SKU <span id="field-required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="bookSKU" id="bookSKU"  class="form-control col-md-7 col-xs-12">
                                                <div  id="bookSKUError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Stock Status <span id="field-required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="stockStatus" id="stockStatus"  class="form-control col-md-7 col-xs-12">
                                                    <option value="">Select</option>
                                                    <option value="instock">In-Stock</option>
                                                    <option value="outofstock">Out Of Stock</option>
                                                </select>
                                                <div id="attributesOptionError" class="error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="attributes">
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="bookAttributes" id="bookAttributes"  class="form-control col-md-7 col-xs-12">
                                                    <option value="">Select</option>
                                                   @if($attributes)
                                                       @foreach($attributes as $attribute)
                                                            <option value="{{$attribute->id}}">{{$attribute->attribute_name}}</option>
                                                       @endforeach
                                                   @endif
                                                </select>
                                                <div id="attributesError" class="error"></div>
                                            </div>
                                            <span class="control-label">
                                                <button type="button" id="addAttributeOptionsBtn"  class="btn btn-success btn-md">Add</button>
                                            </span>
                                        </div>
                                        <!-- start accordion -->
                                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel">
                                                <a class="panel-heading" role="tab"  href="#attribute_color" data-toggle="collapse" data-parent="#accordion"  aria-expanded="true">
                                                    <h4 class="panel-title">Color #1</h4>
                                                </a>
                                                <div id="attribute_color" class="panel-collapse collapse" role="tabpanel">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <p>Color</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="attributes" id="attributes2"  class="form-control col-md-7 col-xs-12">
                                                                    <option value="">Select</option>
                                                                    <option value="color">Color</option>
                                                                    <option value="size">Size</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel">
                                                <a class="panel-heading" role="tab"  href="#attribute_size" data-toggle="collapse" data-parent="#accordion"  aria-expanded="true">
                                                    <h4 class="panel-title">Size #2</h4>
                                                </a>
                                                <div id="attribute_size" class="panel-collapse collapse" role="tabpanel">
                                                    <div class="panel-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of accordion -->
                                    </div>
                                    <div class="tab-pane" id="variations">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                       <select name="attributes" id="attributes4"  class="form-control col-md-7 col-xs-12">
                                                           <option value="">Select</option>
                                                           <option value="color">Color</option>
                                                           <option value="size">Size</option>
                                                       </select>
                                                       <div id="attributesError" class="error"></div>
                                                   </div>
                                                   <span class="control-label">
                                                        <button type="button" class="btn btn-success btn-md">Add</button>
                                                    </span>
                                               </div>

                                           </div>
                                       </div>
                                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel">
                                                <a class="panel-heading" role="tab"  href="#book_variations" data-toggle="collapse" data-parent="#accordion"  aria-expanded="true">
                                                    <div class="panel-title">
                                                      <div class="row">
                                                         <div class="col-md-3" >
                                                             <div class="form-group">
                                                                 <select name="color" class="form-control" style="width: 200px;">
                                                                     <option>Any Color</option>
                                                                 </select>
                                                             </div>
                                                         </div>
                                                           <div class="col-md-3" style="margin-left: 10px;">
                                                               <div class="form-group">
                                                                   <select name="color" class="form-control" style="width: 200px;">
                                                                       <option>Any Color</option>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                      </div>
                                                    </div>
                                                </a>
                                                <div id="book_variations" class="panel-collapse collapse" role="tabpanel">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <p>Color</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/js/admin/books/manage-books.js')}}"></script>
@endsection
