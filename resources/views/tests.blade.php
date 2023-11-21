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
    <div id="recommended-test-row" class="row mb-4"></div>
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
            $('#rec-loadtxt').show();
          }
      })
      .done(function(data) {
        var data = JSON.parse(data);
        var dataArr = data.responseJson;
        var dataArrSize = dataArr.length
        // console.log(dataArrSize);
        if(dataArrSize < 10){
          isNextPageAvailable = 0;
        }
        if(data.length == 0) {
          $('.loading').show();
          $('.loading').html('No more data.');
          return;
        } else {
          $('#recspin-loader').hide();
          $('#rec-loadtxt').hide();

          var timeDelay = 1000;
          var newi = 1;
          for (i = 0; i < dataArr.length; i++) {
            // timeDelay = newi * timeDelay;
            // $('#recommended-test-row').append(dataArr[i]);
            $(dataArr[i]).hide().appendTo("#recommended-test-row").fadeIn(timeDelay);
            newi++;
          }
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