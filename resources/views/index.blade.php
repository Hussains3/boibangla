@extends('layouts.master')

@section('content')
    <div class="book-container">
        @include('layouts.partials.bookLeftBar')
        <div class="book-rcontent">
            {{-- book banner --}}
            <div class="book-banner">
                <div class="lftbanner">
                    <script language="javascript" type="text/javascript">
                        var currency = "5";
                    </script>
                    <div class="topBanner">
                        <div class="theme-default">
                            <div class="owl-one owl-carousel owl-theme owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-4830px, 0px, 0px); transition: all 0.25s ease 0s; width: 5635px;">
                                        @forelse ($banners as $banner)
                                            <div class="owl-item" style="width: 805px;">
                                                <div class="item">
                                                    <a href="">
                                                        <img class="owl-lazy"
                                                            data-src="{{ asset('storage/uploads/media/' . $banner->file) }}"
                                                            alt="Boi Bangla"
                                                            src="{{ asset('storage/uploads/media/' . $banner->file) }}"
                                                            style="opacity: 1;" width="803px" height="auto">
                                                    </a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="owl-item" style="width: 805px;">
                                                <div class="item">
                                                    <a href="">
                                                        <img class="owl-lazy"
                                                            data-src="{{ asset('images/bannerthumbnail.jpg') }}"
                                                            alt="Simon &amp; Schuster India 45% off"
                                                            src="{{ asset('images/bannerthumbnail.jpg') }}"
                                                            style="opacity: 1;" width="803px" height="auto">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="owl-nav disabled"><button type="button" role="presentation"
                                        class="owl-prev"><span aria-label="Previous">???</span></button><button type="button"
                                        role="presentation" class="owl-next"><span aria-label="Next">???</span></button></div>
                            </div>
                        </div>
                        <div class="clearfloat"></div>
                    </div>
                </div>
            </div>

            {{-- Ignoring the heading --}}
            <div class="headingnone">
                <h1>Home</h1>
            </div>

            <div class="">
                <!-- First Slider-->
                <div class=" homepagetabs-base book-slide">
                    <div id="tabs-first" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true">
                                <a href="#tabs-1" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                    id="ui-id-1">??????????????????????????????</a>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false"
                                aria-expanded="false">
                                <a href="#tabs-2" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-2">???????????? ?????????????????????</a>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false"
                                aria-expanded="false">
                                <a href="#tabs-3" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-3">????????????-??????????????????</a>
                            </li>
                        </ul>
                        <div class="tabsdetailsfull">

                            {{-- Best selling books --}}
                            <div id="tabs-1" class="tabs_inner_base ui-tabs-panel ui-corner-bottom ui-widget-content"
                                aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                                @if (!empty($bestseller))
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory',$bestseller->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($bestseller->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>


                            {{-- New Collection --}}
                            <div id="tabs-2" class="tabs_inner_base ui-tabs-panel ui-corner-bottom ui-widget-content"
                            aria-labelledby="ui-id-2" role="tabpanel" style="display: none;" aria-hidden="true">
                                @if (!empty($newCollection))
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory',$newCollection->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @forelse ($newCollection->books as $book)
                                                <div class="owl-item">
                                                    @include('layouts.partials.bookItem')
                                                </div>
                                                @empty
                                                <div class="owl-item">
                                                    No book In this category
                                                </div>

                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Pree Order --}}
                            <div id="tabs-3" class="tabs_inner_base ui-tabs-panel ui-corner-bottom ui-widget-content"
                            aria-labelledby="ui-id-3" role="tabpanel" style="display: none;" aria-hidden="true">
                                @if (!empty($preeOrdeer))
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory',$preeOrdeer->category_slug)}}">See
                                            All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @foreach ($preeOrdeer as $book)
                                                    <div class="owl-item">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <div class=" homepagetabs-base book-slide">
                    <div id="tabs-second" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">

                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-5" aria-labelledby="ui-id-4" aria-selected="true"
                                aria-expanded="true">
                                <a href="#tabs-5" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                    id="ui-id-4">????????????????????????????????? ??????</a>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-6" aria-labelledby="ui-id-5" aria-selected="false"
                                aria-expanded="false"><a href="#tabs-6" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-5">????????????-??????????????? ??????</a></li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-7" aria-labelledby="ui-id-6" aria-selected="false"
                                aria-expanded="false"><a href="#tabs-7" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-6">????????????????????? ???????????????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Award Wining Books --}}
                            <div id="tabs-5" aria-labelledby="ui-id-4" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($awardwiner))
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $awardwiner->category)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($awardwiner->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Shishu kishor --}}
                            <div id="tabs-6" aria-labelledby="ui-id-5" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" style="display: none;"
                                aria-hidden="true">
                                @if (!empty($shishuKishor))
                                <div class="books-summary">
                                    <span class="view-more"><a href="/view-books/5/award-winners">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @foreach ($shishuKishor->books as $book)
                                                    <div class="owl-item">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Science Fiction --}}
                            <div id="tabs-7" aria-labelledby="ui-id-6" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" style="display: none;"
                                aria-hidden="true">
                                @if (!empty($sienceFiction))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory',$sienceFiction->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @foreach ($sienceFiction->books as $book)
                                                    <div class="owl-item">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>





                {{-- Category --}}
                <div class="d-flex justify-content-between flex-sm-column" style="padding: 0 5px;">
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">???????????????????????? ?????????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">?????????????????????????????????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">???????????? ???????????????????????? ??????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">?????????????????? ??????????????? ??????</a>
                </div>

                {{-- islamic/other/translation --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="tabs-third" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-9" aria-labelledby="ui-id-9" aria-selected="true"
                                aria-expanded="true">
                                <a href="#tabs-9" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                    id="ui-id-9">????????????????????? ??????</a>
                            </li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-10" aria-labelledby="ui-id-10" aria-selected="false"
                                aria-expanded="false"><a href="#tabs-10" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-10">???????????????????????? ?????????????????? ??????</a></li>
                            <li role="tab" tabindex="-1" class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                aria-controls="tabs-11" aria-labelledby="ui-id-11" aria-selected="false"
                                aria-expanded="false"><a href="#tabs-11" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-11">??????????????????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Islamic Book--}}
                            <div id="tabs-9" aria-labelledby="ui-id-9" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($islamic))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $islamic->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($islamic->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Other religious --}}
                            <div id="tabs-10" aria-labelledby="ui-id-10" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" style="display: none;"
                                aria-hidden="true">
                                @if (!empty($otherreligious))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $otherreligious->categpry_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @foreach ($otherreligious as $book)
                                                    <div class="owl-item">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Translation --}}
                            <div id="tabs-11" aria-labelledby="ui-id-11" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" style="display: none;"
                                aria-hidden="true">
                                @if (!empty($translated))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $translated->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                                                @foreach ($sienceFictionBook as $book)
                                                    <div class="owl-item">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>



                {{-- Series --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-12" aria-labelledby="ui-id-12" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-12" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-12">????????????????????? ??????????????? ??????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-12" aria-labelledby="ui-id-12" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($siries))
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{ route('showCategory', $series->category_slug) }}">See
                                            All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($siries->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                {{-- All categories --}}
                <div class="homepagetabs-base mb-1">
                    <div id="" class="">
                        <div class="squarecatheading">
                            <h3>???????????? ????????? ?????????????????? ??????????????? ??????????</h3>
                        </div>
                        <div class="tabsdetailsfull">
                            <div class="owl-four owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                        @foreach ($categories as $category)
                                            <a href="{{ route('showCategory', $category->category_slug) }}"
                                                class="owl-item">
                                                <div class="cate-square d-flex justify-content-center align-items-center text-center">
                                                    <p class="text-center">{{ $category->category }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                            aria-label="Previous">???</span></button><button type="button"
                                        role="presentation" class="owl-next disabled"><span
                                            aria-label="Next">???</span></button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Category --}}
                <div class="d-flex justify-content-between flex-sm-column" style="padding: 0 5px;">
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">????????????????????????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">????????????-??????????????????,??????????????????????????????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">???????????????????????????????????? ??????</a>
                    <a class="btn-red mt-1 text-center" href="" rel="nofollow">??????????????????????????? ??? ???????????????????????????????????????</a>
                </div>


                {{-- bongobondhu bangladesh muktijuddho --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-12" aria-labelledby="ui-id-12" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-12" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-12">???????????????????????????, ????????????????????????????????? ??? ???????????????????????? ??????????????? ??????</a>
                            </li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-12" aria-labelledby="ui-id-12" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($bmb))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $bmb->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($bmb as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>



                {{-- 30 best selling book last month --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-12" aria-labelledby="ui-id-12" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-12" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-12">?????? ??????????????? ?????????????????????????????? ???????????? ??????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-12" aria-labelledby="ui-id-12" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($lmbsbooks))

                                <div class="books-summary">
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($lmbsbooks as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ?????????????????? ?????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-13" aria-labelledby="ui-id-13" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-13" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-13">?????????????????? ??????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Children books --}}
                            <div id="tabs-13" aria-labelledby="ui-id-13" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($children))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory',$$children->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($children->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ????????????????????? ????????????????????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-14" aria-labelledby="ui-id-14" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-14" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-14">????????????????????? ?????????????????????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-14" aria-labelledby="ui-id-14" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($shomokalin))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $shomokalin->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($shomokalin->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ???????????????????????? ?????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-15" aria-labelledby="ui-id-15" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-15" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-15">???????????????????????? ??????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-15" aria-labelledby="ui-id-15" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($political))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $political->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($political->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ?????????????????? ?????? ???????????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-17" aria-labelledby="ui-id-17" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-17" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-17">?????????????????? ?????? ????????????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-17" aria-labelledby="ui-id-17" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($bcs))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $bcs->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($bcs->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ????????????,????????????????????? ??? ?????????????????????????????? ?????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-18" aria-labelledby="ui-id-18" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-18" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-18">????????????,????????????????????? ??? ?????????????????????????????? ??????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-18" aria-labelledby="ui-id-18" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($mtc))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $mtc->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($mts->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ??????????????? ???????????????????????? ??????????????????????????? --}}
                <div class=" homepagetabs-base book-slide">
                    <div id="" class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-20" aria-labelledby="ui-id-20" aria-selected="true"
                                aria-expanded="true"><a href="#tabs-20" role="presentation" tabindex="-1"
                                    class="ui-tabs-anchor" id="ui-id-20">??????????????? ???????????????????????? ???????????????????????????</a></li>
                        </ul>
                        <div class="tabsdetailsfull">
                            {{-- Series Books --}}
                            <div id="tabs-20" aria-labelledby="ui-id-20" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                @if (!empty($admission))

                                <div class="books-summary">
                                    <span class="view-more"><a href="{{route('showCategory', $admission->category_slug)}}">See All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-two owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-815px, 0px, 0px); transition: all 0.25s ease 0s; width: 1630px;">
                                                @foreach ($admission->books as $book)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        @include('layouts.partials.bookItem')
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>




                {{-- Featured Writer --}}
                <div class=" homepagetabs-base last-sectn ftr-parent book-slide">
                    <div class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                        <ul role="tablist"
                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                            <li role="tab" tabindex="0"
                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                aria-controls="tabs-10" aria-labelledby="ui-id-8" aria-selected="true"
                                aria-expanded="true">
                                <a href="#tabs-10" role="presentation" tabindex="-1" class="ui-tabs-anchor"
                                    id="ui-id-8">????????????</a>
                            </li>
                        </ul>
                        <div class="tabsdetailsfull">
                            <div id="tabs-10" aria-labelledby="ui-id-8" role="tabpanel"
                                class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                <div class="books-summary">
                                    <span class="view-more"><a href="{{ route('cfeaturedAuthors') }}">See
                                            All</a></span>
                                    <div class="clearfloat"></div>
                                    <div class="owl-three owl-carousel owl-theme books-itm-grid owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-1222px, 0px, 0px); transition: all 0.25s ease 0s; width: 2038px;">
                                                @forelse ($authors as $author)
                                                    <div class="owl-item" style="width: 193.75px; margin-right: 10px;">
                                                        <div class="item itm lazy_loader"><a
                                                                href="{{ route('cAuthorBooks', $author->slug) }}"
                                                                title="{{ $author->name }}"><span class="cover"><img
                                                                        data-src="{{ asset('storage/uploads/authorUpload/' . $author->photo) }}"
                                                                        height="150px" width="100px"
                                                                        alt="{{ $author->name }}"
                                                                        class="owl-lazy backup_author_picture"></span><span
                                                                    class="title">{{ $author->name }}</span></a>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="item ">
                                                        <p>????????? ???????????? ????????????</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">???</span></button><button
                                                type="button" role="presentation" class="owl-next disabled"><span
                                                    aria-label="Next">???</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @include('layouts.partials.bbanglaFeatures')



            </div>


            <div class="section p-1">
                <div class="container">
                    <div class="field_form">
                        <p class="text-center leads theme-color"><strong>Track Your Order From Anywhere</strong></p>
                        <form id="track-order-form">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <div class="input-group d-flex justify-content-center">
                                        <input type="text" name="order_no" id="order_no" placeholder="Order No."
                                            class="me-1 new-txt-box w-80" required="required">
                                        <button type="submit" id="trackOrderBtn" class="btn btn-red"> <i
                                                class="fa fa-search"></i> Track</button>
                                    </div>
                                    <div id="order_noError" class="error"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div id="tracking-data">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#tabs-first, #tabs-second, #tabs-third").tabs();

            $(".owl-one").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                navigation: false,
                autoplayHoverPause: true,
                autoplayTimeout: 5000,
                dots: true,
                lazyLoad: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                        margin: 0
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 1,
                        nav: false,
                        loop: true,
                        margin: 0
                    }
                }
            });
            $('.owl-two').owlCarousel({
                items: 4,
                loop: true,
                autoplay: true,
                margin: 10,
                navigation: true,
                lazyLoad: true,
                lazyLoadEager: 0,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        margin: 0
                    },
                    600: {
                        items: 4,
                        nav: true
                    },
                    1000: {
                        items: 4,
                        nav: true
                    }
                },

            });
            $('.owl-three').owlCarousel({
                items: 4,
                loop: true,
                autoplay: true,
                margin: 10,
                navigation: true,
                lazyLoad: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true
                    },
                    600: {
                        items: 4,
                        nav: true
                    },
                    1000: {
                        items: 4,
                        nav: true
                    }
                }
            });
            $('.owl-four').owlCarousel({
                items: 4,
                loop: true,
                autoplay: true,
                dots: false,
                margin: 10,
                navigation: true,
                lazyLoad: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true
                    },
                    600: {
                        items: 4,
                        nav: true
                    },
                    1000: {
                        items: 4,
                        nav: true
                    }
                }
            });

        });



        function handleAuthorInvalidImages(objImage) {
            var imgSrc = '';

            if (objImage.src.indexOf("https://d2g9wbak88g7ch.cloudfront.net/authorimages") != -1) {
                objImage.src = null;
                objImage.src = "https://d2g9wbak88g7ch.cloudfront.net/authorimages/notavailable.jpg";

            }
        }

        function handleInvalidImages(objImage, size) {
            var imgSrc = '';

            if (objImage.src.indexOf("https://d2g9wbak88g7ch.cloudfront.net/productimages/images200") != -1) {
                imgSrc = objImage.src;
                imgSrc = imgSrc.replace("https://d2g9wbak88g7ch.cloudfront.net/productimages/images200",
                    "https://d2g9wbak88g7ch.cloudfront.net/productimages/mainimages");
                setTimeout(function() {
                    objImage.src = imgSrc;
                }, 0)
            } else if (objImage.src.indexOf("https://d2g9wbak88g7ch.cloudfront.net/productimages") != -1 && objImage.src
                .indexOf(".jpg") != -1) {
                imgSrc = objImage.src;
                imgSrc = imgSrc.replace(".jpg", ".JPG");
                setTimeout(function() {
                    objImage.src = imgSrc;
                }, 0)

            } else if (objImage.src.indexOf("https://d2g9wbak88g7ch.cloudfront.net/productimages") != -1) {
                objImage.src = null;
                objImage.src = "https://d2g9wbak88g7ch.cloudfront.net/productimages/" + size + "/notavailable.gif";
                //                imgSrc = objImage.src;
                //                imgSrc = imgSrc.replace("http://images3.uread.com/productimages", "http://images2.uread.com/productimages");
                //                setTimeout(function () { objImage.src = imgSrc; }, 0)

            }

        }
    </script>
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script src="{{ asset('assets/js/customer/order-tracking/order-tracking.js') }}" type="text/javascript"></script>
@endsection
