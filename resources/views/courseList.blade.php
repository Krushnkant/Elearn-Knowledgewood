@include("header")
<?php 
  // $alldata = $data->data;
  // $CourcesArr = $alldata->data;
?>

<section class="mt-4 mb-4">
  <div class="container">
    <div class="title">
      <h4>Recommended for you</h4>
    </div>
    <div id="courses-row" class="row"></div>
    <div class="text-center m-5">
      <div id="spin-loader" class="justify-content-center">
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <h5 class="text-center loading">Loading...</h5>
    </div>
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
            $('#spin-loader').show();
            $('.loading').show();
          }
      })
      .done(function(data) {
          var data = JSON.parse(data);
          var htmlcontent = data.htmldata;
          isNextPageAvailable = data.isNextPageAvailable;
          if(htmlcontent.length == 0) {
            $('.loading').show();
            $('.loading').html('No more data.');
            return;
          } else {
            $('#spin-loader').hide();
            $('.loading').hide();
            $('#courses-row').append(htmlcontent);
          }
      })
     .fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('Something went wrong.');
     });
    } else {
      $('.loading').show();
      $('.loading').html('No more data.');
    }
  }
</script>