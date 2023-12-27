<?php
 include_once 'header.php';
?>

    <section class="section-one">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/banner_1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Computer Programming Club</h1>
              <p>Journey to greatness Starts Here!</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/banner_2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Gaming Competition </h1>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/banner_3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Rally</h1>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="img/banner_5.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>Job Hunt</h1>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!--Section 1 End-->

    <section class="pb-5">
        <div class="faculties" style="color: #0f0f3e;">
            <h3 class="text-center">FACULTY MEMBERS</h3>
            <p class="text-center">Our honorable faculty members.<br> They are continuously contributing.</p>

            <div class="display-fles">
                <div class="border-recp">
                    <div>
                        <img src="img/faculty/faculty1.jpeg" alt="a picture">

                        <div>
                            <h5 class="pt-4">Dr. Md. Mozammel Huq<br> Azad Khan</h5>
                            <p>Professor</p>
                        </div>
                    </div>
                </div>

                <div class="border-recp">
                    <div>
                        <img src="img/faculty/faculty2.jpeg" alt="a picture">

                        <div class="pt-5">
                            <h5>Dr. Shamim H Ripon</h5>
                            <p>Professor</p>
                        </div>
                    </div>
                </div>

                <div class="border-recp">
                    <div>
                        <img src="img/faculty/faculty3.jpeg" alt="a picture">

                        <div class="pt-5">
                            <h5>Dr. Md. Nawab Yousuf Ali</h5>
                            <p>Professor</p>
                        </div>
                    </div>
                </div>
                <div class="border-recp">
                    <div>
                        <img src="img/faculty/faculty4.jpeg" alt="a picture">

                        <div class="pt-5">
                            <h5>Dr. Ahmed Wasif Reza</h5>
                            <p>Associate Professor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="" id=""  style="background-color: #0f0f3e; color: #0f0f3e;">
        <h2 class="text-center pt-5" style="color: white;">TEACHING ASSISTANTS</h2>
        <p class="text-center mb-5" style="color: white;">List of Teaching Assistants. <br>Who are working hard to help the faculty members.</p>
        <div class="row row-cols-1 row-cols-md-4 g-4 m-5">
            <div class="col">
                <div class="card h-100 shadow-lg">
                    <img src="img/ta/ta1.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Md. Rakibul Islam</h5>
                        <p class="card-text">Department of <br>Computer Science <br>and Enginnering</p>
                        <p>UTA</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-lg">
                    <img src="img/ta/ta2.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Fahim Ahmad</h5>
                        <p class="card-text">Department of <br>Computer Science <br>and Enginnering</p>
                        <p>GTA</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-lg">
                    <img src="img/ta/ta3.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sabbir Ahamad</h5>
                        <p class="card-text">Department of <br>Computer Science <br>and Enginnering</p>
                        <p>UTA</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-lg">
                    <img src="img/ta/ta4.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Sadia Afrin Mou</h5>
                        <p class="card-text">Department of <br>Computer Science <br>and Enginnering</p>
                        <p>GTA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php
     include_once 'footer.php';
    ?>
