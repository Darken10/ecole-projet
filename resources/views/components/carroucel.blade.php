<section id="demos">
    <div class="row">
      <div class="large-12 columns">
        <div class="owl-carousel owl-theme">

          <div class="item">
            <img src="{{ asset('images/posts/img_6.jpg') }}" alt="">
          </div>
          <div class="item">
            <img src="{{ asset('images/posts/img_7.jpg') }}" alt="">
          </div>
          <div class="item">
            <img src="{{ asset('images/posts/img_7.jpg') }}" alt="">
         </div>

          </div>
        </div>
        <script>
          $(document).ready(function() {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
              items: 1,
              loop: true,
              margin: 10,
              autoplay: true,
              autoplayTimeout: 3000,
              autoplayHoverPause: true
            });
            $('.play').on('click', function() {
              owl.trigger('play.owl.autoplay', [3000])
            })
            $('.stop').on('click', function() {
              owl.trigger('stop.owl.autoplay')
            })
          })
        </script>
      </div>
    </div>
  </section>