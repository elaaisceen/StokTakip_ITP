<div class="container">
	
		<div class="row">
		
				<div class="d-flex justify-content-betweEn align-items-center p-2">
				
					<span>Hoş Geldin <?php echo $_SESSION["adi"]." ".$_SESSION["soyadi"]; ?></span>
					
				</div>
				
				<div class="card">
				
					<div class="card-header bg-info text-white d-flex justify-content-between">
						<p class="h3">Güvenli Çıkış</p>
						<a href="yenikayit.php">
							<input type="button" class="btn btn-warning" value="Yeni Kullanıcı Ekle">
						</a>	
					</div>
					
					<div class="card-body">
					
						<div class="alert alert-success"> 
							Başarılı bir şekilde çıkış yaptınız. Lütfen bekleyiniz yönlendiriliyorsunuz.
						</div>
						
					</div>
				
				</div>
		
		</div>
	
	
	</div>
 

