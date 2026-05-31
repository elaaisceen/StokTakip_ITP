<footer class="footer px-4 py-3 d-flex flex-wrap justify-content-between align-items-center">
        <div>
          Stok Takip Otomasyonu
          &copy; 2026 İnternet Tabanlı Programlama
        </div>
        <div class="ms-auto">
          Powered by Elanur Tuana İŞCEN
        </div>
      </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
      const header = document.querySelector("header.header");

      document.addEventListener("scroll", () => {
        if (header) {
          header.classList.toggle("shadow-sm", document.documentElement.scrollTop > 0);
        }
      });
    </script>
    <!-- Plugins and scripts required by this view-->
    <script src="vendors/chart.js/js/chart.umd.js"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/index.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.3.2/dist/js/coreui.bundle.min.js"></script>

    <script>
document.addEventListener("DOMContentLoaded", () => {
    // Sayıları saydırma
    const sayaclar = document.querySelectorAll('.sayac');
    sayaclar.forEach(sayac => {
        const hedef = +sayac.getAttribute('data-hedef');
        if (hedef === 0) return; // Hedef 0 ise saymaya gerek yok
        
        const artisHizi = hedef / 30; // Hız ayarı
        let guncelSayi = 0;
        
        const sayimiGuncelle = () => {
            guncelSayi += artisHizi;
            if(guncelSayi < hedef) {
                sayac.innerText = Math.ceil(guncelSayi);
                setTimeout(sayimiGuncelle, 30);
            } else {
                sayac.innerText = hedef;
            }
        };
        sayimiGuncelle();
    });

    // Barları doldurma
    setTimeout(() => {
        const barlar = document.querySelectorAll('.animasyonlu-bar');
        barlar.forEach(bar => {
            const hedefGenislik = bar.getAttribute('data-width');
            bar.style.width = hedefGenislik;
        });
    }, 400); // 0.4 saniye bekle ve barları doldur
});

// Dikey barları alttan üste doğru doldurma
setTimeout(() => {
    const dikeyBarlar = document.querySelectorAll('.animasyonlu-dikey-bar');
    dikeyBarlar.forEach(bar => {
        const hedefYukseklik = bar.getAttribute('data-height');
        bar.style.height = hedefYukseklik; // width yerine height kullanıyoruz
    });
}, 400);

</script>
</body>