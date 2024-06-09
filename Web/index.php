<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <title>Solusi Pelanggan Sukses</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="image/rating.png" alt="" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bx bx-x" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="#Galeri">Galeri</a></li>
                    <li><a href="#about-us">About Us</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </div>
            <i class="bx bx-menu" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Solusi Pelanggan Sukses</h1>
            <p>Membantu Anda Menjadi Lebih Baik</p>
        </div>
    </section>

    <!-- Testimonials -->
    <div class="hero">
        <h1>Testimonials</h1>
        <div class="container">
            <div class="testimonial">
                <div class="slide-row" id="slide">
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Anonim</h3>
                            <p>Lorem, ipsum dolor.</p>
                        </div>
                        <div class="user-img">
                            <img src="image/hacker256px.png" alt="" />
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Anonim2</h3>
                            <p>Lorem, ipsum dolor.</p>
                        </div>
                        <div class="user-img">
                            <img src="image/hacker256px.png" alt="" />
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Anonim3</h3>
                            <p>Lorem, ipsum dolor.</p>
                        </div>
                        <div class="user-img">
                            <img src="image/hacker256px.png" alt="" />
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Anonim3</h3>
                            <p>Lorem, ipsum dolor.</p>
                        </div>
                        <div class="user-img">
                            <img src="image/hacker256px.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="indicator">
                <span class="btn active"></span>
                <span class="btn"></span>
                <span class="btn"></span>
                <span class="btn"></span>
            </div>
        </div>
    </div>

    <!-- About Us + Contact -->
    <section class="about-us" id="about-us">
        <h1>About Us</h1>
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi eligendi
            tempora deserunt. Vel tempora expedita maiores laudantium accusamus
            iusto, eum minus sunt! Aut magnam nemo accusamus earum impedit delectus
            quisquam?
        </p>
        <a href="" class="hero-btn">CONTACT US</a>
    </section>

    <!-- Modal Section -->
    <section class="new-section">
        <button class="show-modal">Pesan Tiket</button>
        <span class="overlay"></span>

        <div class="modal-box">
            <div class="modal-header">
                <i class="fa-regular fa-circle-xmark close-btn"></i>
                <h2>Input Data</h2>
            </div>
            <div class="modal-body">
                <form action="submit_data.php" method="post">
                      <div class="form-group">
                        <label for="pemesan">Pemesan:</label>
                        <input type="text" id="pemesan" class="judul" name="pemesan" placeholder="Enter your name">

                        <label for="sektor">Sektor:</label>
                        <input type="text" id="sektor" class="judul" name="sektor" placeholder="Enter the sector">

                        <label for="tanggal">Tanggal Berangkat:</label>
                        <input type="date" id="tanggal" name="tanggal_berangkat" class="judul">

                        <label for="waktu">Waktu Transaksi:</label>
                        <input type="time" id="waktu" name="waktu_transaksi" class="judul">
                      </div>
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Modal Section -->

    <!-- Footer -->
    <section class="footer">
        <h4>© 2024 Solusi Pelanggan Sukses. Semua hak dilindungi.</h4>
        <div class="icons">
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-instagram"></i>
            <i class="bx bxl-linkedin"></i>
        </div>
    </section>

    <!-- Javascript -->
    <script src="javascript/script.js"></script>
</body>
</html>
