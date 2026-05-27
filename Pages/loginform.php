<body>
	
	<div class="container">
	
	
			<div class="row justify-content-center align-items-center min-vh-100">
			
				<div class="col-md-6 col-lg-5">
						
					<div class="card shadow-lg">
					
						<div class="card-body p-4">
						
						<h3 class="text-center mb-4"> Giriş Yap </h3>
						
						<div id="loginForm">
							<?php 
								$options=[
										'memory_cost'=>1<<17, //128MB
										'time_cost'=>4, // hesapalama tur sayısı
										//'threads'=>2, // paralel iş parçacığı
								
								];
								
						if ($code->checkAccess()){
							
							header("Location: login.php?login=true");
							exit();
						}
								
						if (isset($_POST["login"])){
							
							
							echo $formdanGelenKullaniciadi=temizle($_POST["eposta"]);
							echo $formdanGelenSifre=temizle($_POST["sifre"]);
							
							
								try {
									
									$sorgu=$code->db->prepare("Select 
																kullanici_id,	
																kullanici_adi, 
																kullanici_soyadi, 
																kullanici_eposta,
																kullanici_sifre,
																kullanici_rutbe,
																sil
														 From kullanicilar where kullanici_eposta=?  ");
														 
									$sorgu->execute([$formdanGelenKullaniciadi]);	
									$kullanici=$sorgu->fetchObject(\Entities\KullanicilarEntity::class);
								
									
										if ($kullanici){
											
											if (password_verify($formdanGelenSifre, $kullanici->kullanici_sifre)){
												
												echo '<div class="alert alert-success">Başarılı bir şekilde giriş yaptınız. Lütfen bekleyiniz. 
												Yönlendiriliyorsunuz...</div>';
												
												/* Başarılı bir şekilde giriş yapmışsa aşağıdaki kodları çalıştır.*/
												$code->setSession($kullanici);	
												
												/* Default.php giriş yaptır.*/
												@header("Location:login.php?login=true/");
												exit();
											} else {
														//echo $kullanici["kullanici_sifre"];
														
														echo '<div class="alert alert-danger">Kullanıcı adı veya şifre yanlış!!</div>';
											
											}
											
										} else {
											
											echo '<div class="alert alert-danger">Kullanıcı adı veya şifre yanlış!</div>';
											
										}
									
									
								} catch (PDOException $error) {
									
									echo $error->getMessage();
									echo "Hatalı işlem lütfen daha sonra tekrar deneyiniz."; 
									
								}

							?>
					
							
						<?php } ?>
							<form  method="POST" >
									<div class="mb-3">
										<label class="fw-bold" for="epostagiriniz"> E-posta Adresiniz</label>
										<input type="email" name="eposta" id="epostagiriniz" class="form-control" placeholder="Lütfen Eposta Adresiniz" required >
									</div>
									<div class="mb-3">
									<label class="fw-bold" for="sifre">Şifreniz</label>
										<input type="password" name="sifre" id="sifre" class="form-control" placeholder="Lütfen şifrenizi giriniz."  required>
									</div>
									<div class="d-grid mb-3">
										<button type="submit" name="login" class="btn btn-primary"> 
										 <i class="bi bi-box-arrow-right me-1"></i> Giriş Yap 
										</button>
									</div>
							</form>		
						</div>

						<?php 
						
							
							if(isset($_POST["kayit"])){
								
								 $kullanici_adi=temizle($_POST["adi"]);
								 $kullanici_soyadi=temizle($_POST["soyadiniz"]);
								 $kullanici_eposta=temizle($_POST["eposta"]);
								 $kullanici_cinsiyet=temizle($_POST["cinsiyet"]);
								//echo $sifre=temizle($_POST["sifre"]);
								//$sifre=hash('md5',$_POST["sifre"]);
								//$sifre=hash('sha256',$_POST["sifre"]);
								$sifre=$_POST['sifre'];
								$sifre2=$_POST['sifre2'];
								
								
								if (!empty($kullanici_adi) && !empty($kullanici_soyadi) && !empty($kullanici_eposta) && !empty($kullanici_cinsiyet) && !empty($sifre)&& !empty($sifre2)){
								
								if ($sifre===$sifre2) {
									
								if(gecerliSifremi($sifre)){
								
								
							
								$sifre=password_hash($sifre,PASSWORD_ARGON2ID,$options);
								
								$varmi=$code->db->prepare("Select kullanici_eposta FROM kullanicilar where kullanici_eposta=? and sil=?");
								$varmi->execute([$kullanici_eposta,2]);
								$varmisonuc=$varmi->fetch();
								try {
								if ($varmisonuc){
									
									?>
									
										<div class="alert alert-danger"><?php echo $kullanici_eposta; ?> adlı eposta ile daha önce kayıt yapılmıştır.</div>
										
								<?php	
								} else {
								
								$ekle=$code->db->prepare("INSERT INTO kullanicilar SET
														kullanici_adi=?,
														kullanici_soyadi=?,
														kullanici_eposta=?,
														kullanici_cinsiyet=?,
														kullanici_sifre=?");
								if ($ekle->execute([$kullanici_adi,$kullanici_soyadi,$kullanici_eposta,$kullanici_cinsiyet,$sifre])){
														?>
														<div class="alert alert-success">Başarılı Bir Şekilde Kayıt Alınmıştır. Lütfen Bekleyiniz Yölendiriliyorsunuz..</div>
												<?php	} else { ?>

													<div class="alert alert-danger">Kayıt olma işlemi başarısız! Lütfen zorunlu alanları doldurarak tekrar deneyiniz..</div>
							<?php		
									}
								}
							  } catch ( PDOException $error){
								echo $error->getMessage();
								echo "<div class='alert alert-danger'>";
								echo "Yeni üye kaydı başarısızdır. Lütfen tüm alanları kontrol ederek tekrar deneyiniz.";
								echo "</div>";
							  }
							  
							  
							  	} else {
									?>
									
										<div class="alert alert-warning">
											<h3>Zayıf Şifre !</h3>
											<p>! Lütfen şifrenizi oluştururken aşağıdaki kurallara uyunuz.</p>
											<p><b>Şifreniz;</b>
											<p>* En az bir büyük harf içermelidir.
											<p>* En az bir rakam içermelidir.
											<p>* En az bir özel karakter içermelidir.
											<p>* Şifreniz minimum 8 karakterden oluşmalıdır.
										
										</div>
								<?php	
									
								}	/*-------------    Geçerli Şifre Girildi mi Kontrol eder ------------*/
								
								
								
								} else {
									?>
									
										<div class="alert alert-warning">Şifreler uyuşmamaktadır!</div>
								<?php	
									
								}	/*-------------    Şifrelerin aynı girilip girilmediğini kontrol eder! ------------*/
								
								
								  
								} else {
									?>
									
										<div class="alert alert-danger">Lütfen tüm alanları doldurarak kayıt yapınız.</div>
								<?php	
									
								} /*-------------    Tüm alanları doldurmayı kontrol eder. ------------*/

								
							  }
									
						
						
						?>		
						
						<div id="kayitForm" style="display:none;">
						   <form method="POST">
								<div class="mb-3">
									<label class="fw-bold" for="adi"> Adınız</label>
									<input type="text" name="adi" id="adi" class="form-control" value="<?php if (isset($_POST["kayit"])){ echo $kullanici_adi; }?>" placeholder="Lütfen Adınız" required >
								</div>
								<div class="mb-3">
									<label class="fw-bold" for="soyadiniz"> Soyadınız</label>
									<input type="text" name="soyadiniz" id="soyadiniz" class="form-control" value="<?php if (isset($_POST["kayit"])){  echo $kullanici_soyadi; } ?>" placeholder="Lütfen Adınız ve Soyadınızı Giriniz" required >
								</div>
								
								<div class="mb-3">
									<label class="fw-bold" for="epostagiriniz"> E-posta Adresiniz</label>
									<input type="email" name="eposta" id="epostagiriniz" value="<?php if (isset($_POST["kayit"])){ echo $kullanici_eposta; } ?>" class="form-control" placeholder="Lütfen Eposta Adresiniz" required >
								</div>
								<div class="mb-3">
									<label class="fw-bold" for="cinsiyet"> Cinsiyetiniz</label>
									<select name="cinsiyet" value="<?php if (isset($_POST["kayit"])){  echo $kullanici_cinsiyet; } ?>" class="form-control" required>
									    <option value="">Lütfen Seçiniz</option>
										<option value="1" <?php if (isset($_POST["kayit"]) && $kullanici_cinsiyet==1) { echo "selected"; } ?> >Kadın</option>
										<option value="2" <?php if (isset($_POST["kayit"]) && $kullanici_cinsiyet==2) { echo "selected"; } ?>>Erkek</option>
									</select>
								</div>
								<div class="mb-3">
								<label class="fw-bold" for="sifre">Şifreniz</label>
									<input type="password" name="sifre" id="sifre" class="form-control" placeholder="Lütfen şifrenizi giriniz."  required>
								</div>
								<div class="mb-3">
								<label class="fw-bold" for="sifre2">Şifreniz</label>
									<input type="password" name="sifre2" id="sifre2" class="form-control" placeholder="Lütfen şifrenizi doğrulayınız."  required>
								</div>
								<div class="d-grid mb-3">
									<button type="submit"  name="kayit" class="btn btn-success"> 
									<i class="bi bi-person-fill-add me-1"></i> Kayıt Ol 
									</button>
								</div>
							</form>
						</div>
						
									<hr class="my-4">
									<div class="d-grid gap-2">
										<button type="button" class="btn btn-secondary" onclick="formGoster()">
											<i class="bi bi-person-plus-fill me-2"></i> Yeni Üye Kaydı
										</button>	
									</div>
									<hr class="my-4">
									<div class="d-grid gap-2">
									   	<button type="button" class="btn btn-danger">
											<i class="bi bi-google me-2"></i> Google ile Giriş Yap
										</button>
										<button type="button" class="btn btn-primary">
											<i class="bi bi-facebook me-2"></i> Facebook ile Giriş Yap
										</button>
										<button type="button" class="btn btn-dark">
											<i class="bi bi-twitter-x me-2"></i> Google ile Giriş Yap
										</button>										
									</div>
							
						
						
						

					</div>	
						
						
				</div>
			
			</div>
	
	
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
	
	<script>
	
		function formGoster(){
		
			const loginForm=document.getElementById("loginForm");
			const kayitForm=document.getElementById("kayitForm");
			
			if (loginForm.style.display==="none"){
			
				loginForm.style.display="block";
				kayitForm.style.display="none";
			} else {
				loginForm.style.display="none";
				kayitForm.style.display="block";
			
			}
		
		}
	
	</script>
	
	
	
  </body>