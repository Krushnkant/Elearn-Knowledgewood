@include("header")
<!-- @include("sidebar") -->
<?php 
    $alldata = $data->data;
    $name = $alldata->name;
    $duration = $alldata->duration;
    $trainnigMode = $alldata->trainnig_mode;
    $overview = $alldata->overview;
    $outLineContent = $alldata->course_outline;
    $chaptersArr = $alldata->chapters;
    $booksArr = $alldata->books;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
<div class="sidemenu">

  <a href="{{url('/')}}" class="back-btn">Back to Dashboard</a>

  <a href="#" class="open-sub-menu"><i class="bi bi-list"></i></a>

    <ul class="nav nav-pills course-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="#" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true" class="active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.679" height="11.927" viewBox="0 0 20.679 11.927">
                    <path id="Icon_material-done-all" data-name="Icon material-done-all" d="M16.26,9.639,15.006,8.385,9.367,14.024l1.254,1.254Zm3.771-1.254-9.41,9.41L6.9,14.086,5.649,15.34l4.972,4.972L21.294,9.639,20.031,8.385ZM.615,15.34l4.972,4.972,1.254-1.254L1.878,14.086Z" transform="translate(-0.615 -8.385)" fill="#a9a9a9"/>
                </svg> Overview
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#" class="" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="21.821" height="14.432" viewBox="0 0 21.821 14.432">
                    <g id="Group_2744" data-name="Group 2744" transform="translate(-18.25 -132.784)">
                        <path id="Path_274" data-name="Path 274" d="M30.466,10.5,24,15.118l6.466,4.618Z" transform="translate(8.855 124.882)" fill="none" stroke="#a9a9a9" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        <path id="Path_275" data-name="Path 275" d="M3.347,7.5H13.508a1.847,1.847,0,0,1,1.847,1.847v9.237a1.847,1.847,0,0,1-1.847,1.847H3.347A1.847,1.847,0,0,1,1.5,18.584V9.347A1.847,1.847,0,0,1,3.347,7.5Z" transform="translate(17.5 126.034)" fill="none" stroke="#a9a9a9" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                    </g>
                </svg> Videos
            </a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a href="#" class="" id="pills-tests-tab" data-bs-toggle="pill" data-bs-target="#pills-tests" role="tab" aria-controls="pills-tests" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.679" height="11.927" viewBox="0 0 20.679 11.927">
                    <path id="Icon_material-done-all" data-name="Icon material-done-all" d="M16.26,9.639,15.006,8.385,9.367,14.024l1.254,1.254Zm3.771-1.254-9.41,9.41L6.9,14.086,5.649,15.34l4.972,4.972L21.294,9.639,20.031,8.385ZM.615,15.34l4.972,4.972,1.254-1.254L1.878,14.086Z" transform="translate(-0.615 -8.385)" fill="#a9a9a9"/>
                </svg> Tests
            </a>
        </li> -->
        <li class="nav-item" role="presentation">
            <a href="#" class="" id="pills-books-tab" data-bs-toggle="pill" data-bs-target="#pills-books" role="tab" aria-controls="pills-books" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="18.945" height="15.057" viewBox="0 0 18.945 15.057">
                    <path id="Icon_awesome-book-open" data-name="Icon awesome-book-open" d="M16.517,2.251c-1.669.095-4.987.44-7.035,1.693a.468.468,0,0,0-.221.4V15.43a.482.482,0,0,0,.709.411,18.579,18.579,0,0,1,6.662-1.429.95.95,0,0,0,.914-.934V3.187a.955.955,0,0,0-1.029-.935ZM8.064,3.945C6.016,2.691,2.7,2.346,1.029,2.251A.955.955,0,0,0,0,3.187V13.478a.95.95,0,0,0,.914.934,18.577,18.577,0,0,1,6.664,1.43.481.481,0,0,0,.707-.41V4.34A.459.459,0,0,0,8.064,3.945Z" transform="translate(0.7 -1.549)" fill="none" stroke="#a9a9a9" stroke-width="1.4"/>
                </svg> eBooks
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#" class="" id="pills-courseOutline-tab" data-bs-toggle="pill" data-bs-target="#pills-courseOutline" role="tab" aria-controls="pills-courseOutline" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="14.319" height="14.319" viewBox="0 0 14.319 14.319">
                    <path id="Icon_awesome-history" data-name="Icon awesome-history" d="M14.881,7.708A7.16,7.16,0,0,1,3.229,13.3a.692.692,0,0,1-.053-1.028l.325-.325a.694.694,0,0,1,.921-.057,5.312,5.312,0,1,0-.339-8.034L5.548,5.317a.462.462,0,0,1-.327.789h-4.2a.462.462,0,0,1-.462-.462v-4.2a.462.462,0,0,1,.789-.327L2.776,2.545A7.159,7.159,0,0,1,14.881,7.708ZM9.659,9.983l.284-.365a.693.693,0,0,0-.122-.972L8.646,7.732V4.72a.693.693,0,0,0-.693-.693H7.491A.693.693,0,0,0,6.8,4.72V8.636L8.686,10.1A.693.693,0,0,0,9.659,9.983Z" transform="translate(-0.563 -0.563)" fill="#a9a9a9"/>
                </svg> Course Outline
            </a>
        </li>
    </ul>
</div>
<div class="content-body flex-body tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
        <h3>{{ $name }}</h3>
        {!! $overview !!}
        <p><b>Training Mode: </b>{{ $trainnigMode }}</p>
        <p><b>Duration: </b>{{ $duration }}</p>
    </div>
    <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
        <div class="sub-sidedrawer">
            <div class="sub-sidedrawer-title">Video Chapters <a href="javascript: void(0)" class="close-sub-sidedrawer"><i class="bi bi-arrow-left"></i></a></div>
            <ul class="nav nav-pills chapter-tabs" id="pills-tab" role="tablist">
                <?php 
                    $ch = 1;
                ?>
                @foreach($chaptersArr as $chaptersMenuItem)
                    <?php
                    $chId = $chaptersMenuItem->id;
                    $activeClass = '';
                    if($ch == 1){
                        $activeClass = 'active';
                    }
                    ?>
                    <li class="nav-item" role="presentation">
                        <a href="#" id="pills-chapter-tab-{{ $chId }}" data-bs-toggle="pill" data-bs-target="#chapter-id-{{ $chId }}" role="tab" aria-controls="chapter-id-{{ $chId }}" aria-selected="true" class="sub-sidedrawer-menu {{ $activeClass }}">
                            <span>{{ $chaptersMenuItem->chapter }}</span>
                            <b>{{ $chaptersMenuItem->name }}</b>
                            <!-- <span>Total Video: 6</span>
                            <span>Watched Video: 2</span> -->
                        </a>
                    </li>
                    <?php $ch++; ?>
                @endforeach
            </ul>
        </div>
        <div class="tab-content" id="pills-child-tabContent">
            <?php 
                $chCont = 1;
                ?>
            @foreach($chaptersArr as $chaptersContentItem)
                <?php
                $chContId = $chaptersContentItem->id;
                $activeClass = '';
                if($chCont == 1){
                    $activeClass = 'show active';
                }
                ?>
                <div class="tab-pane fade {{ $activeClass }}" id="chapter-id-{{ $chContId }}" role="tabpanel" aria-labelledby="pills-chapter-tab-{{ $chContId }}">
                    <div class="video-chapter">
                        <div class="video-chapter-title">
                          Chapter:<b>{{ $chaptersContentItem->name }}</b>
                        </div>
                        <div class="row">
                            <?php
                                $navSlide = 0;
                                $videosArr = $chaptersContentItem->videos;
                            ?>
                            @foreach($videosArr as $videoDetail)
                                <div class="col-md-6">
                                    <div class="video-course">
                                        <div class="video-course-img">
                                            <a href="javascript:void(0);" class="play-btn" onclick="openVideoBox({{ $videoDetail->id }},{{ $navSlide }})">
                                                <img src="{{asset('img/play.svg')}}">
                                            </a>
                                            <img src="{{ $videoDetail->image_thumb }}">
                                        </div>
                                        <div class="video-course-detail">
                                            <div class="course-type">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.821" height="14.432" viewBox="0 0 21.821 14.432">
                                                    <g id="Group_2744" data-name="Group 2744" transform="translate(-18.25 -132.784)">
                                                        <path id="Path_274" data-name="Path 274" d="M30.466,10.5,24,15.118l6.466,4.618Z" transform="translate(8.855 124.882)" fill="none" stroke="#a9a9a9" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                                        <path id="Path_275" data-name="Path 275" d="M3.347,7.5H13.508a1.847,1.847,0,0,1,1.847,1.847v9.237a1.847,1.847,0,0,1-1.847,1.847H3.347A1.847,1.847,0,0,1,1.5,18.584V9.347A1.847,1.847,0,0,1,3.347,7.5Z" transform="translate(17.5 126.034)" fill="none" stroke="#a9a9a9" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                                                    </g>
                                                </svg> COURSE
                                            </div>
                                            <h3>{{ $videoDetail->title }}</h3>
                                            <!-- <p>Watched: No</p> -->
                                            <p>Duration: {{ $videoDetail->video_duration }}</p>
                                        </div>
                                    </div>
                                </div>
                                <?php $navSlide++; ?>
                            @endforeach
                        </div>
                    </div>
                    <?php
                        // $vid = 0;
                    ?>
                    <div class="main-slider video-introduction1" id="main-slider">
                        @foreach($videosArr as $videoBoxDetail)
                            <?php
                                // $vid++;
                                // $NextVideoId = $videoBoxDetail[$vid]->id;
                            ?>
                            <div id="videoBox-{{ $videoBoxDetail->id }}" class="video-introduction">
                                <div class="video-introduction-title">
                                    <h4><div class="back-btn-video"> <i class="bi bi-chevron-left"></i></div> {{ $videoBoxDetail->title }}</h4>
                                    <!-- <div class="right">
                                        <a href="#" class="next"><img src="{{asset('img/next-video-icon.svg')}}"> Previous Video</a>
                                        <a href="#">Next Video <img src="{{asset('img/prev-video-icon.svg')}}"></a>
                                    </div> -->
                                </div>
                                <video controls="">
                                    <source src="{{ $videoBoxDetail->video }}" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                {!! $videoBoxDetail->description !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <?php 
                    $chCont++;
                ?>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="pills-books" role="tabpanel" aria-labelledby="pills-books-tab">
        <div class="sub-sidedrawer">
            <div class="sub-sidedrawer-title">eBooks <a href="javascript: void(0)" class="close-sub-sidedrawer"><i class="bi bi-arrow-left"></i></a></div>
            <ul class="nav nav-pills chapter-tabs" id="pills-tab" role="tablist">
                <?php 
                    $bid = 1;
                ?>
                @foreach($booksArr as $booksMenuItem)
                    <?php
                    $bookId = $booksMenuItem->id;
                    $bMenuActiveCls = '';
                    if($bid == 1){
                        $bMenuActiveCls = 'active';
                    }
                    ?>
                    <li class="nav-item" role="presentation">
                        <a href="#" id="pills-book-tab-{{ $bookId }}" data-bs-toggle="pill" data-bs-target="#book-id-{{ $bookId }}" role="tab" aria-controls="book-id-{{ $bookId }}" aria-selected="true" class="sub-sidedrawer-menu {{ $bMenuActiveCls }}">
                            <b>{{ $booksMenuItem->title }}</b>
                            <!-- <span>Total Video: 6</span>
                            <span>Watched Video: 2</span> -->
                        </a>
                    </li>
                    <?php 
                        $bid++;
                    ?>
                @endforeach
            </ul>
        </div>
        <div class="tab-content" id="pills-childBook-tabContent">
            <?php 
                $bCont = 1;
                ?>
            @foreach($booksArr as $booksContentItem)
                <?php
                $bContId = $booksContentItem->id;
                $bContActiveCls = '';
                if($bCont == 1){
                    $bContActiveCls = 'show active';
                }
                $pdfUrl = 'http://matoresell.com/knowledgeapp/e8e1b48853569ace4ce265405cf546a2.pdf';
                // $pdfUrl = 'https://chatsupport.co.in/public/course_video/'.$booksContentItem->ebook;
                ?>
                <div class="ebooks tab-pane fade {{ $bContActiveCls }}" id="book-id-{{ $bContId }}" role="tabpanel" aria-labelledby="pills-book-tab-{{ $bContId }}">
                    <div class="video-chapter">
                        <h6>Chapter:</h6>
                        <h5 class="orange-title mb-3">{{ $booksContentItem->title }}</h5>
                        <div class="ebooks-content">
                            <?php 
                            $filename = 'test.pdf';
                            $headers = array(
                                'Content-Type: application/pdf',
                            );
                            // response()->file($pdfUrl, $headers); 
                            $pdfRes = Response::make(file_get_contents($pdfUrl), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="'.basename($pdfUrl).'"'
]);
?>
                            <?php /* ?><iframe src="" width="100%" height="500px"></iframe><?php */ ?>
                            <div id="pdf-main-container-{{ $bContId }}">
                                <?php /* ?><div id="pdf-loader-{{ $bContId }}">Loading document ...</div><?php */ ?>
                                <div id="pdf-contents-{{ $bContId }}">
                                    
                                    <canvas id="pdf-canvas-{{ $bContId }}" class="pdf-viewer"></canvas>
                                    <div id="page-loader-{{ $bContId }}">Loading page ...</div>
                                </div>
                            </div>
                            <div id="pdf-buttons-{{ $bContId }}" class="content-bottom">
                                <button id="pdf-prev-{{ $bContId }}" class="button">Previous</button>
                                <div id="page-count-container-{{ $bContId }}" class="page-number">
                                    <span id="pdf-current-page-{{ $bContId }}"></span> of <span id="pdf-total-pages-{{ $bContId }}"></span>
                                </div>
                                <button id="pdf-next-{{ $bContId }}" class="button">Next</button>
                            </div>
                            <!-- <script type="text/javascript">
                                var _PDF_DOC_<?php echo $bContId; ?>,
                                    _CURRENT_PAGE_<?php echo $bContId; ?>,
                                    _TOTAL_PAGES_<?php echo $bContId; ?>,
                                    _PAGE_RENDERING_IN_PROGRESS_<?php echo $bContId; ?> = 0,
                                    _CANVAS_<?php echo $bContId; ?> = document.querySelector('#pdf-canvas-<?php echo $bContId; ?>');

                                // initialize and load the PDF
                                async function showPDF_<?php echo $bContId; ?>(pdf_url_<?php echo $bContId; ?>) {
                                    // document.querySelector("#pdf-loader-<?php echo $bContId; ?>").style.display = 'block';

                                    // get handle of pdf document
                                    try {
                                        _PDF_DOC_<?php echo $bContId; ?> = await <?php echo $pdfRes; ?>; //pdfjsLib.getDocument({ url: pdf_url_<?php echo $bContId; ?> });
                                    }
                                    catch(error) {
                                        alert(error.message);
                                    }

                                    // total pages in pdf
                                    _TOTAL_PAGES_<?php echo $bContId; ?> = _PDF_DOC_<?php echo $bContId; ?>.numPages;
                                    
                                    // Hide the pdf loader and show pdf container
                                    // document.querySelector("#pdf-loader-<?php echo $bContId; ?>").style.display = 'none';
                                    document.querySelector("#pdf-contents-<?php echo $bContId; ?>").style.display = 'block';
                                    document.querySelector("#pdf-total-pages-<?php echo $bContId; ?>").innerHTML = _TOTAL_PAGES_<?php echo $bContId; ?>;

                                    // show the first page
                                    showPage_<?php echo $bContId; ?>(1);
                                }

                                // load and render specific page of the PDF
                                async function showPage_<?php echo $bContId; ?>(page_no_<?php echo $bContId; ?>) {
                                    _PAGE_RENDERING_IN_PROGRESS_<?php echo $bContId; ?> = 1;
                                    _CURRENT_PAGE_<?php echo $bContId; ?> = page_no_<?php echo $bContId; ?>;

                                    // disable Previous & Next buttons while page is being loaded
                                    document.querySelector("#pdf-next-<?php echo $bContId; ?>").disabled = true;
                                    document.querySelector("#pdf-prev-<?php echo $bContId; ?>").disabled = true;

                                    // while page is being rendered hide the canvas and show a loading message
                                    document.querySelector("#pdf-canvas-<?php echo $bContId; ?>").style.display = 'none';
                                    document.querySelector("#page-loader-<?php echo $bContId; ?>").style.display = 'block';

                                    // update current page
                                    document.querySelector("#pdf-current-page-<?php echo $bContId; ?>").innerHTML = page_no_<?php echo $bContId; ?>;
                                    
                                    // get handle of page
                                    try {
                                        var page_<?php echo $bContId; ?> = await _PDF_DOC_<?php echo $bContId; ?>.getPage(page_no_<?php echo $bContId; ?>);
                                    }
                                    catch(error) {
                                        alert(error.message);
                                    }

                                    // original width of the pdf page at scale 1
                                    var pdf_original_width_<?php echo $bContId; ?> = page_<?php echo $bContId; ?>.getViewport(1).width;
                                    
                                    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
                                    var scale_required_<?php echo $bContId; ?> = _CANVAS_<?php echo $bContId; ?>.width / pdf_original_width_<?php echo $bContId; ?>;

                                    // get viewport to render the page at required scale
                                    var viewport_<?php echo $bContId; ?> = page_<?php echo $bContId; ?>.getViewport(scale_required_<?php echo $bContId; ?>);

                                    // set canvas height same as viewport height
                                    _CANVAS_<?php echo $bContId; ?>.height = viewport_<?php echo $bContId; ?>.height;

                                    // setting page loader height for smooth experience
                                    document.querySelector("#page-loader-<?php echo $bContId; ?>").style.height =  _CANVAS_<?php echo $bContId; ?>.height + 'px';
                                    document.querySelector("#page-loader-<?php echo $bContId; ?>").style.lineHeight = _CANVAS_<?php echo $bContId; ?>.height + 'px';

                                    // page is rendered on <canvas> element
                                    var render_context_<?php echo $bContId; ?> = {
                                        canvasContext: _CANVAS_<?php echo $bContId; ?>.getContext('2d'),
                                        viewport: viewport_<?php echo $bContId; ?>
                                    };
                                        
                                    // render the page contents in the canvas
                                    try {
                                        await page_<?php echo $bContId; ?>.render(render_context_<?php echo $bContId; ?>);
                                    }
                                    catch(error) {
                                        alert(error.message);
                                    }

                                    _PAGE_RENDERING_IN_PROGRESS_<?php echo $bContId; ?> = 0;

                                    // re-enable Previous & Next buttons
                                    document.querySelector("#pdf-next-<?php echo $bContId; ?>").disabled = false;
                                    document.querySelector("#pdf-prev-<?php echo $bContId; ?>").disabled = false;

                                    // show the canvas and hide the page loader
                                    document.querySelector("#pdf-canvas-<?php echo $bContId; ?>").style.display = 'block';
                                    document.querySelector("#page-loader-<?php echo $bContId; ?>").style.display = 'none';
                                }

                                // On Window loda Show PDF
                                window.addEventListener("load", function() {
                                    // this.style.display = 'none';
                                    showPDF_<?php echo $bContId; ?>('<?php echo $pdfUrl; ?>');
                                });

                                // click on the "Previous" page button
                                document.querySelector("#pdf-prev-<?php echo $bContId; ?>").addEventListener('click', function() {
                                    if(_CURRENT_PAGE_<?php echo $bContId; ?> != 1)
                                        showPage_<?php echo $bContId; ?>(--_CURRENT_PAGE_<?php echo $bContId; ?>);
                                });

                                // click on the "Next" page button
                                document.querySelector("#pdf-next-<?php echo $bContId; ?>").addEventListener('click', function() {
                                    if(_CURRENT_PAGE_<?php echo $bContId; ?> != _TOTAL_PAGES_<?php echo $bContId; ?>)
                                        showPage_<?php echo $bContId; ?>(++_CURRENT_PAGE_<?php echo $bContId; ?>);
                                });
                            </script> -->
                        </div>
                    </div>
                </div>
                <?php 
                    $bCont++;
                ?>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="pills-courseOutline" role="tabpanel" aria-labelledby="pills-courseOutline-tab">
        {!! $outLineContent !!}
    </div>
    <!-- <div class="content-bottom">
        <button class="button">Start Test</button>
    </div> -->

</div>

@include("footer")

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
<script type="text/javascript">

    var APP_URL = {!! json_encode(url('/')) !!};

    function openVideoBox(videoid, slidenum){

        jQuery(".video-chapter").toggleClass("video-hide");
        // jQuery("#videoBox-"+videoid).toggleClass("video-active");
        jQuery(".video-introduction1").toggleClass("video-active");
        $('#main-slider').slick('slickGoTo', slidenum);
        $('#main-slider').slick("refresh");
    }
    /*$(".play-btn").click(function(){
        $(".video-chapter").toggleClass("video-hide");
        $(".video-introduction").toggleClass("video-active");
    });*/

    $(".chapter-tabs a, .back-btn-video").click(function(){
        $(".video-chapter").removeClass("video-hide");
        $(".video-introduction").removeClass("video-active");
    });
    $('#main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        dots: false,
        infinite: false,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: '<div class="slick-prev right"><a href="#"><img src="'+APP_URL+'/img/next-video-icon.svg"> Previous Video</a><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
        nextArrow: '<div class="slick-next right"><a href="#">Next Video <img src="'+APP_URL+'/img/prev-video-icon.svg"></a><i class="fa fa-angle-right" aria-hidden="true"></i></div>'
    });

    var video = $('#main-slider .slick-active').find('frame').get(0).play();

    $('#main-slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
        $('#main-slider .slick-slide').find('video').get(0).pause();
        var video = $('#main-slider .slick-active').find('video').get(0).play();
    });
</script>