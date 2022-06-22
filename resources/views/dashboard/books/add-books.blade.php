@extends('dashboard.layout.master')
@section('title','Books')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Books</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {{-- action="{{route('createBook')}}" method="POST" --}}
                        <form id="addEditBookForm"  name="addEditBookForm" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="bookName">Name <span id="" class="field-required">*</span></label>
                                    <input type="text" name="bookName" id="bookName" value="{{$bookInfo->book_name??''}}"  class="form-control col-md-7 col-xs-12">
                                    <div  id="bookNameError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="bookSku">SKU</label>

                                    <input type="text" name="bookSku" id="bookSku" value="{{$bookInfo->sku??''}}" class="form-control col-md-7 col-xs-12">
                                    <div  id="bookSkuError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="bookIsbn">ISBN</label>

                                    <input type="text" name="bookIsbn" id="bookIsbn" value="{{$bookInfo->isbn??''}}" class="form-control col-md-7 col-xs-12">
                                    <div  id="bookIsbnError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="edition">Edition</label>

                                    <input type="text" name="edition" id="edition" value="{{$bookInfo->edition??''}}" class="form-control col-md-7 col-xs-12">
                                    <div  id="editionError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="editor">Editor</label>

                                    <input type="text" name="editor" id="editor" value="{{$bookInfo->editor??''}}" class="form-control col-md-7 col-xs-12">
                                    <div  id="editorError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="numberOfPages">Number of Pages</label>

                                    <input type="number" name="numberOfPages" id="numberOfPages" value="{{$bookInfo->number_of_pages??''}}" class="form-control col-md-7 col-xs-12">
                                    <div  id="numberOfPagesError" class="error"></div>
                                </div>
                            </div>

                            {{-- Regular price --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label">Regular Price <span id="" class="field-required">*</span></label>
                                    <input  type="text" name="regularPrice" id="regularPrice" value="{{$bookInfo->regular_price??''}}" class="form-control col-md-7 col-xs-12" >
                                    <div  id="regularPriceError" class="error"></div>
                                </div>
                            </div>

                            {{-- Sale Price --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label">Sale Price <span id="" class="field-required">*</span></label>
                                    <input  type="text" name="salePrice" id="salePrice"  value="{{$bookInfo->sale_price??''}}"  class="form-control col-md-7 col-xs-12" >
                                    <div  id="salePriceError" class="error"></div>
                                </div>
                            </div>



                            {{-- Slug --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="bookSlug">Slug <span id="" class="field-required">*</span></label>
                                    <input type="text" name="bookSlug" id="bookSlug" value="{{$bookInfo->book_slug??''}}"  class="form-control col-md-7 col-xs-12">
                                    <div  id="bookSlugError" class="error"></div>
                                </div>
                            </div>

                            {{-- Stock --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label">Stock <span id="" class="field-required">*</span></label>
                                    <input  type="text" name="bookStock" id="bookStock" value="{{$bookInfo->stock??''}}"  class="form-control col-md-7 col-xs-12" >
                                    <div  id="bookStockError" class="error"></div>
                                </div>
                            </div>



                            {{-- Unit --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label">Unit</label>
                                    <input  type="text" name="bookUnit" id="bookUnit"  value="{{$bookInfo->unit??''}}" class="form-control col-md-7 col-xs-12" >
                                    <div  id="bookUnitError" class="error"></div>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file"  name="bookImage" id="bookImage"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preBookImage" id="preBookImage" value="{{$bookInfo->book_image??''}}" >
                                    <div id="bookImageError" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Other Image-1</label>
                                    <input type="file"  name="otherImage1" id="otherImage1"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preotherImage1" id="preotherImage1" value="{{$bookInfo->book_image_1??''}}" >
                                    <div id="otherImage1Error" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Other Image-2</label>
                                    <input type="file"  name="otherImage2" id="otherImage2"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preotherImage2" id="preotherImage2" value="{{$bookInfo->book_image_2??''}}" >
                                    <div id="otherImage2Error" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Other Image-3</label>
                                    <input type="file"  name="otherImage3" id="otherImage3"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preotherImage3" id="preotherImage3" value="{{$bookInfo->book_image_3??''}}" >
                                    <div id="otherImage3Error" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Other Image-4</label>
                                    <input type="file"  name="otherImage4" id="otherImage4"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preotherImage4" id="preotherImage4" value="{{$bookInfo->book_image_4??''}}" >
                                    <div id="otherImage4Error" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Other Image-5</label>
                                    <input type="file"  name="otherImage5" id="otherImage5"  class="form-control col-md-7 col-xs-12"  >
                                    <input type="hidden" name="preotherImage5" id="preotherImage5" value="{{$bookInfo->book_image_5??''}}" >
                                    <div id="otherImage5Error" class="error"></div>
                                    <div style="color: #21c167;font-size: 12px;">Image size :400x600</div>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Categories</label>
                                    <select name="bookCategory[]" id="bookCategory" multiple class="form-control select2 col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="bookCategoryError" class="error"></div>
                                </div>
                            </div>

                            {{-- Sub Category --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Sub Categories </label>
                                    <select name="bookSubCategory[]" id="bookSubCategory" multiple  class="form-control col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                    </select>
                                    <div id="bookSubCategoryError" class="error"></div>
                                </div>
                            </div>

                            {{-- Quality --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Quality</label>
                                    <select name="bookQuality" id="bookQuality" class="form-control col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        <option value="হার্ড কাভার">হার্ড কাভার</option>
                                        <option value="পেপারব্যাক">পেপারব্যাক</option>
                                    </select>
                                    <div id="bookQualityError" class="error"></div>
                                </div>
                            </div>

                            {{-- Language --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Language</label>
                                    <select name="bookLanguage[]" id="bookLanguage" multiple class="form-control select2 col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($languages)
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="bookLanguageError" class="error"></div>
                                </div>
                            </div>
                            {{-- Country --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select name="bookCountry[]" id="bookCountry" multiple class="form-control select2 col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($countries)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="bookCountryError" class="error"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Author<span id="" class="field-required">*</span></label>
                                    <select name="bookauthor[]" id="bookauthor" multiple  class="form-control col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($authors)
                                            @foreach($authors as $author)
                                                <option value="{{$author->id}}">{{$author->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="bookSubCategoryError" class="error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Publication<span id="" class="field-required">*</span></label>
                                    <select name="bookpublication[]" id="bookpublication" multiple  class="form-control col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($publications)
                                            @foreach($publications as $publication)
                                                <option value="{{$publication->id}}">{{$publication->publication_name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="bookPublicationError" class="error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Tags </label>
                                    <select name="book_tags[]" id="book_tags" multiple class="form-control select2 col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        @if($tags)
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="book_tagsError" class="error"></div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Book Display </label>
                                    <select name="bookDisplay[]" id="bookDisplay" multiple  class="form-control col-md-7 col-xs-12" style="width: 100%;">
                                        <option value="" disabled>Select</option>
                                        <option value="1">New Arrival</option>
                                        <option value="2">Featured</option>
                                    </select>
                                    <div id="bookDisplayError" class="error"></div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Description </label>
                                    <textarea  name="bookDescription" id="bookDescription"  class="form-control col-md-7 col-xs-12">{{$bookInfo->description??''}}</textarea>
                                    <div id="bookDescriptionError" class="error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Summary </label>
                                    <textarea  name="bookSummary" id="bookSummary"  class="form-control col-md-7 col-xs-12">{{$bookInfo->summary??''}}</textarea>
                                    <div id="bookSummaryError" class="error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Additonal Information </label>
                                    <textarea  name="additionalInfo" id="additionalInfo"  class="form-control col-md-7 col-xs-12">{{$bookInfo->additional_info??''}}</textarea>
                                    <div id="additionalInfoError" class="error"></div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <div class="form-group">
                                    <input type="hidden" name="editId" id="editId" value="{{$bookInfo->id??''}}"/>
                                    <button type="submit" name="addEditBookBtn" id="addEditBookBtn" class="btn btn-success">Save Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="editCategoryIds" id="editCategoryIds" value="{{$categoryIds??''}}">
    <input type="hidden" name="editSubCategoryIds" id="editSubCategoryIds" value="{{$subCategoryIds??''}}">
    <input type="hidden" name="publicationIds" id="publicationIds" value="{{$publicationIds??''}}">
    <input type="hidden" name="taggedIds" id="taggedIds" value="{{$taggedIds??''}}">

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
  $('#additionalInfo').summernote();
  $('#bookDescription').summernote();
  $('#bookSummary').summernote();
});
</script>

    <script type="text/javascript" src="{{asset('assets/js/admin/books/books.js')}}"></script>
@endsection
