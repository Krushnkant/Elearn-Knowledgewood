@include("header")

<section class="mt-4 mb-4">
  <div class="container">
    <div class="title">
      <h4>Recommended for you</h4>
    </div>
    <div class="text-center m-5">
      <div id="recspin-loader" class="justify-content-center">
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <h5 id="rec-loadtxt" class="text-center loading">Loading...</h5>
    </div>
    <div id="recommended-books-row" class="row mb-4"></div>
    <div class="title">
      <h4>Top Paid eBooks</h4>
    </div>
    <div class="text-center m-5">
      <div id="paidspin-loader" class="justify-content-center">
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <h5 id="paid-loadtxt" class="text-center loading">Loading...</h5>
    </div>
    <div id="toppaid-books-row" class="row mb-4"></div>
    <div class="title">
      <h4>eBooks</h4>
    </div>
    <div class="text-center m-5">
      <div id="spin-loader" class="justify-content-center">
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <h5 id="loadtxt" class="text-center loading">Loading...</h5>
    </div>
    <div id="all-books-row" class="row mb-4"></div>
  </div>
</section>

@include("footer")
<script type="text/javascript">
  var paginate = 1;
  var isNextPageAvailable = 1;
  loadMoreData(paginate);
  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
      paginate++;
      loadMoreData(paginate);
    }
  });
  function loadMoreData(paginate) {

    if(isNextPageAvailable == 1){
      $.ajax({
          url: '?page=' + paginate,
          type: 'get',
          datatype: 'html',
          beforeSend: function() {
            $('#recspin-loader').show();
            $('#paidspin-loader').show();
            $('#spin-loader').show();
            $('#loadtxt').show();
            $('#paid-loadtxt').show();
            $('#rec-loadtxt').show();
          }
      })
      .done(function(data) {
          var data = JSON.parse(data);
          var rechtmlcontent = data.rechtmldata;
          var paidhtmlcontent = data.paidhtmldata;
          var htmlcontent = data.htmldata;
          isNextPageAvailable = data.isNextPageAvailable;
          if(htmlcontent.length == 0) {
            $('.loading').show();
            $('.loading').html('No more data.');
            return;
          } else {
            $('#recspin-loader').hide();
            $('#paidspin-loader').hide();
            $('#spin-loader').hide();
            $('#loadtxt').hide();
            $('#paid-loadtxt').hide();
            $('#rec-loadtxt').hide();
            $('#recommended-books-row').append(rechtmlcontent);
            $('#toppaid-books-row').append(paidhtmlcontent);
            $('#all-books-row').append(htmlcontent);
          }
      })
     .fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('Something went wrong.');
     });
    } else {
      // $('.loading').show();
      $('.loading').html('No more data.');
    }
  }
</script>