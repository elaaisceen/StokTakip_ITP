# 📦 Web Tabanlı Stok Takip Yazılımı

[cite_start]Bu proje, Bartın Üniversitesi İnternet Programcılığı dersi kapsamında gerçek bir işletmenin envanter ihtiyaçlarını karşılamak üzere geliştirilmiş web tabanlı bir stok takip ve yönetim otomasyonudur.  

## 🛠️ Kullanılan Teknolojiler
* [cite_start]**Backend:** PHP [cite: 5]
* [cite_start]**Veritabanı:** MySQL (İlişkisel yapı ve Prepared Statements ile SQL Injection koruması) [cite: 5, 29]
* [cite_start]**Frontend:** Bootstrap (Kullanımı kolay, renk uyumlu ve mobil uyumlu/responsive tasarım) [cite: 5, 11, 23]

## 🌟 Temel Özellikler (Modüller)

* [cite_start]**Kullanıcı Yönetimi:** Kullanıcı kaydı (şifre hashleme ile), session tabanlı oturum yönetimi ve Admin / Normal Kullanıcı rol ayrımı. [cite: 12, 13, 24]
* [cite_start]**Kategori Yönetimi:** Ürün kategorilerini ekleme, listeleme, güncelleme ve silme (içinde ürün olan kategoriler için silme onayı/engeli). [cite: 14, 25]
* [cite_start]**Ürün Yönetimi:** Kategoriye bağlı ürün ekleme, arama ve anlık/butonlu filtreleme. [cite: 15, 16, 26]
* [cite_start]**Stok Takibi ve Hareketler:** Stok giriş-çıkış kayıtlarının tutulması, hareket geçmişinin (tarih/işlem türü) listelenmesi ve yetersiz stok durumunda çıkış engelleme mekanizması. [cite: 17, 18, 27]
* [cite_start]**Dashboard ve Raporlama:** Toplam stok değeri, sistemdeki toplam ürün/kategori sayısı, kategori bazlı miktar özetleri ve ayarlanabilir eşik değerine sahip kritik stok uyarı sistemi. [cite: 19, 20, 28]
