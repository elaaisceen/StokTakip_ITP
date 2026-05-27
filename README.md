# 📦 Web Tabanlı Stok Takip Yazılımı

Bu proje, Bartın Üniversitesi İnternet Programcılığı dersi kapsamında gerçek bir işletmenin envanter ihtiyaçlarını karşılamak üzere geliştirilmiş web tabanlı bir stok takip ve yönetim otomasyonudur. 

## 🛠️ Kullanılan Teknolojiler

* **Backend:** PHP
* **Veritabanı:** MySQL (İlişkisel yapı ve Prepared Statements ile SQL Injection koruması)
* **Frontend:** Bootstrap (Kullanımı kolay, renk uyumlu ve mobil uyumlu/responsive tasarım)

## 🌟 Temel Özellikler (Modüller)

* **Kullanıcı Yönetimi:** Kullanıcı kaydı (şifre hashleme ile), session tabanlı oturum yönetimi ve Admin / Normal Kullanıcı rol ayrımı.
* **Kategori Yönetimi:** Ürün kategorilerini ekleme, listeleme, güncelleme ve silme (içinde ürün olan kategoriler için silme onayı/engeli).
* **Ürün Yönetimi:** Kategoriye bağlı ürün ekleme, arama ve anlık/butonlu filtreleme.
* **Stok Takibi ve Hareketler:** Stok giriş-çıkış kayıtlarının tutulması, hareket geçmişinin (tarih/işlem türü) listelenmesi ve yetersiz stok durumunda çıkış engelleme mekanizması.
* **Dashboard ve Raporlama:** Toplam stok değeri, sistemdeki toplam ürün/kategori sayısı, kategori bazlı miktar özetleri ve ayarlanabilir eşik değerine sahip kritik stok uyarı sistemi.

---
**Developed by** Elanur Tuana İşcen
