<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Velvet Whisk</title>
    @include('include.style')
  </head>
  <body>
  @include('include.navbar')
    <div class="landing-page-opsi-2">
      <div class="landing-page-opsi-2-child"></div>
      <div class="lihat-lainnya">Lihat lainnya</div>
      <section class="landing-page-opsi-2-inner">
        <div class="frame-group">
          <div class="frame-container">
            <div class="frame-div">
              <div class="roti-kami-bukan-sekedar-roti-parent">
                <h1 class="roti-kami-bukan">Roti Kami? Bukan Sekedar Roti</h1>
                <div class="button-order-now-wrapper">
                  <div class="button-order-now">
                    <div class="ini-adalah-bites-of">
                      Ini adalah bites of happiness yang siap mengguncang
                      duniamu. Coba Sekarang!
                    </div>
                  </div>
                </div>
              </div>
              <button class="rectangle-group">
                <div class="rectangle-div"></div>
                <div class="order-now">Order Now</div>
                <img
                  class="quillarrow-up-icon"
                  alt=""
                  src="{{URL::asset('/img/row.png')}}"
                />
              </button>
            </div>
          </div>
          <div class="group-div">
            <div class="remove-background-parent">
              <div class="remove-background"></div>
              <div class="frame-child1"></div>
              <div class="frame-child2"></div>
              <div class="frame-child3"></div>
              <img
                class="bba61b-137f-4a25-aa76-dbd18f38-icon"
                loading="lazy"
                alt=""
                src="{{ URL::asset('img/Png Landing Page.png') }}"
              />
            </div>
          </div>
        </div>
      </sectio>
    </div>
    <div class="overlap-group" >
        <div class="overlap">
          <img class="cooking-tiramisu" src="{{URL::asset('/img/bahan (2).jpeg')}}" loading="lazy"/>
          <div class="rectangle"></div>
          <div class="rectangle-2"></div>
          <div class="dibuat-oleh-tangan">Dibuat oleh <br />tangan Ahli</div>
          <p class="text-wrapper">
                Roti kami hanya dibuat oleh tangan-tangan terpilih dengan keahlian penuh. Untuk menyajikan kue yang penuh
                dengan cinta dan kebahagian di setiap gigitan.
          </p>
        </div>
    </div>
          <div class="group-about-bahan">
            <img class="gambar-bahan" src="{{URL::asset('/img/Bahan.jpeg')}}" />
            <div class="rectangle-44"></div>
            <div class="group-15">
              <div class="velvet-whisk">
                Velvet Whisk memastikan hanya kue dengan bahan berkualias yang diantar ke
                meja makan Anda. Setiap bahan yang kami pilih telah melaui uji kualitas
                yang ketat. Kami konsisten dan serius pada kualitas produk-produk Kami.
              </div>
              <div class="kualitas">Kualitas</div>
          </div>
        <div class="group-1000002795">
            <div class="rectangle-45"></div>
            <img
              class="bobbette-belle-cookbook-1"
              src="{{URL::asset('/img/about2-cream.png')}}"
            />
            <img class="coklat-1" src="{{URL::asset('/img/about2-jam.png')}}" />
            <img class="eggs-1" src="{{URL::asset('/img/about2-eggs.png')}}" />
        </div>      
      <div class="group-1000002796">
          <div class="ellipse-3"></div>
          <div class="ellipse-4"></div>
          <div class="ellipse-5"></div>
          <div class="best-seller">Best Seller</div>
          <img
            class="croissant-removebg-preview-1"
            src="{{URL::asset('/img/croissant-removebg-preview.png')}}"
          />
          <img class="donat-removebg-preview-1" src="{{URL::asset('/img/donat-removebg-preview.png')}}" />
          <img class="image-15" src="{{URL::asset('/img/cookies.png')}}" />
          <div class="croissant">Croissant</div>
          <div class="donat-polos">Donat Polos</div>
          <div class="cookies-coklat">Cookies Coklat</div>
          <div class="group-16">
            <div class="rectangle-47"></div>
            <div class="lainnya">Lainnya</div>
          </div>
        </div> 
      </div>        
  <footer style="margin-top:25rem" class="footer">
  	 <div style="margin-left:3rem; width:100%" class="footer-container">
  	 	<div style="width: 100%; display:flex;justify-content:space-evenly;" class="footer-row">
  	 		<div class="footer-col">
  	 			<h4>company</h4>
  	 			<ul>
  	 				<li><a href="#">about us</a></li>
  	 				<li><a href="#">our services</a></li>
  	 				<li><a href="#">privacy policy</a></li>
  	 				<li><a href="#">affiliate program</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>get help</h4>
  	 			<ul>
  	 				<li><a href="#">FAQ</a></li>
  	 				<li><a href="#">shipping</a></li>
  	 				<li><a href="#">returns</a></li>
  	 				<li><a href="#">order status</a></li>
  	 				<li><a href="#">payment options</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>online shop</h4>
  	 			<ul>
  	 				<li><a href="#">bread</a></li>
  	 				<li><a href="#">dessert</a></li>
  	 				<li><a href="#">sweat</a></li>
  	 				<li><a href="#">cookies</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
  	 				<a href="#"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="#"><i class="fab fa-twitter"></i></a>
  	 				<a href="#"><i class="fab fa-instagram"></i></a>
  	 				<a href="#"><i class="fab fa-linkedin-in"></i></a>
  	 			</div>
  	 		</div>
  	 	</div>
  	 </div>
  </footer>        
    </div>
  </body>
  <script src="play.js"></script>
</html>
