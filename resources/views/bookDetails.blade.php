@include("header")
<?php 
  $bookid = $data['id'];
  $bookTitle = $data['bookTitle'];
  $bookUrl = $data['bookUrl'];
  $bookDescription = $data['bookDescription'];
  $bookPrice = $data['bookPrice'];
  $bookImage = $data['bookImage'];
  $createdAt = $data['createdAt'];
?>
<section class="mt-4 mb-4">
  <div class="container">
    <div class="row userProfile-box">
      <div class="col-md-6">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img class="" width="100%" src="{{ $bookImage }}">
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex flex-column p-3 py-5">
          <h3 class="font-weight-bold mt-2 mb-3">{{ $bookTitle }}</h3>
          <div class="book-description mb-3">
            {{ $bookDescription }}
          </div>
          <div class="book-price mb-3">
            <h5><i class="fa fa-inr" aria-hidden="true"></i> {{ $bookPrice }}</h5>
          </div>
          <div class="buttonPdf mt-2">
            <a href="{{ $bookUrl }}" target="_blank" class="button">View PDF</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include("footer")