# Stok Takip Yazılımı — Agent Teknik Dokümantasyonu

## Proje Genel Bakış

Bu proje, PHP + MySQL + Bootstrap teknolojileri kullanılarak geliştirilecek web tabanlı bir stok takip yazılımıdır. Sistem; kullanıcı yönetimi, ürün ve kategori yönetimi, stok hareketleri, kritik stok takibi ve raporlama süreçlerini kapsar.

Bu doküman, projedeki modüllerin “agent” mantığında açıklanması için hazırlanmıştır. Her agent belirli bir iş sürecinden sorumludur ve sistemin modüler ilerlemesini sağlar.

---

# Sistem Mimarisi

## Teknoloji Yığını

| Katman | Teknoloji |
|---|---|
| Frontend | Bootstrap 5, HTML5, CSS3 |
| Backend | PHP |
| Veritabanı | MySQL |
| Oturum Yönetimi | PHP Session |
| Güvenlik | Prepared Statements, Password Hashing |

---

# Agent Yapısı

# 1. Authentication Agent

## Sorumluluk

Kullanıcı kimlik doğrulama ve oturum yönetimini sağlar.

## Görevler

- Kullanıcı kayıt işlemleri
- Kullanıcı giriş işlemleri
- Session yönetimi
- Logout işlemi
- Şifre güvenliği
- Rol kontrolü

## Teknik Gereksinimler

- `password_hash()` kullanımı
- `password_verify()` doğrulaması
- Session timeout kontrolü
- Admin / Normal kullanıcı ayrımı

## Veritabanı İlişkisi

### users tablosu

| Alan | Tip |
|---|---|
| id | INT |
| username | VARCHAR |
| email | VARCHAR |
| password | VARCHAR |
| role | ENUM(admin,user) |
| created_at | TIMESTAMP |

---

# 2. User Management Agent

## Sorumluluk

Admin tarafında kullanıcı yönetimini sağlar.

## Görevler

- Kullanıcı listeleme
- Kullanıcı rolü güncelleme
- Kullanıcı silme
- Kullanıcı detay görüntüleme

## İş Kuralları

- Sadece admin erişebilir
- Kullanıcı kendisini silemez
- Admin rolü güvenlik kontrolüne tabi olmalıdır

---

# 3. Category Management Agent

## Sorumluluk

Ürün kategorilerinin yönetimini sağlar.

## Görevler

- Kategori ekleme
- Kategori güncelleme
- Kategori silme
- Kategori listeleme

## Kritik Kontroller

- Aynı kategori adı tekrar edemez
- İçinde ürün bulunan kategori doğrudan silinemez

## Veritabanı Yapısı

### categories tablosu

| Alan | Tip |
|---|---|
| id | INT |
| name | VARCHAR |
| created_at | TIMESTAMP |

---

# 4. Product Management Agent

## Sorumluluk

Sistemdeki ürünlerin tüm yaşam döngüsünü yönetir.

## Görevler

- Ürün ekleme
- Ürün güncelleme
- Ürün silme
- Ürün listeleme
- Ürün arama
- Kategori filtreleme

## Teknik Gereksinimler

- Ürün kategoriye bağlı olmalı
- Fiyat numeric tutulmalı
- Stok miktarı integer tutulmalı
- Form validasyonları yapılmalı

## Veritabanı Yapısı

### products tablosu

| Alan | Tip |
|---|---|
| id | INT |
| category_id | INT |
| name | VARCHAR |
| stock | INT |
| price | DECIMAL |
| critical_stock | INT |
| created_at | TIMESTAMP |

---

# 5. Stock Movement Agent

## Sorumluluk

Stok giriş ve çıkış işlemlerini yönetir.

## Görevler

- Stok giriş kaydı
- Stok çıkış kaydı
- Hareket geçmişi tutma
- Stok miktarını otomatik güncelleme

## İş Kuralları

- Negatif stok oluşamaz
- Her işlem loglanmalıdır
- Tarih bilgisi tutulmalıdır

## Hareket Türleri

- `IN` → Stok Girişi
- `OUT` → Stok Çıkışı

## Veritabanı Yapısı

### stock_movements tablosu

| Alan | Tip |
|---|---|
| id | INT |
| product_id | INT |
| type | ENUM(IN,OUT) |
| quantity | INT |
| description | TEXT |
| created_at | TIMESTAMP |

---

# 6. Critical Stock Agent

## Sorumluluk

Kritik stok seviyelerini takip eder.

## Görevler

- Kritik stok kontrolü
- Dashboard uyarıları üretme
- Renkli bildirim sistemi

## Çalışma Mantığı

```php
if($product_stock <= $critical_stock){
   // kritik uyarı oluştur
}
```

## UI Davranışı

- Kırmızı badge
- Dashboard uyarı kartı
- Kritik ürün listesi

---

# 7. Reporting Agent

## Sorumluluk

Sistem raporlamalarını üretir.

## Görevler

- Toplam stok değeri hesaplama
- Kategori bazlı özet
- Kritik ürün raporu
- Dashboard kartları

## Örnek SQL

```sql
SELECT SUM(stock * price) AS total_stock_value
FROM products;
```

## Dashboard Kartları

- Toplam Ürün
- Toplam Kategori
- Kritik Ürün Sayısı
- Toplam Stok Değeri

---

# 8. Security Agent

## Sorumluluk

Sistem güvenliğini sağlar.

## Güvenlik Önlemleri

### SQL Injection Koruması

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
```

### XSS Koruması

```php
htmlspecialchars($data);
```

### Session Güvenliği

- Session kontrolü
- Yetkisiz erişim engeli
- Admin route koruması

---

# Sistem İş Akışı

## Kullanıcı Süreci

```text
Register → Login → Dashboard → Ürün/Kategori Yönetimi → Stok İşlemleri → Raporlama
```

---

# Önerilen Klasör Yapısı

```text
/project-root
│
├── config/
│   └── database.php
│
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
│
├── categories/
│
├── products/
│
├── stock/
│
├── reports/
│
├── admin/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
└── index.php
```

---

# UI / UX Standartları

## Bootstrap Kullanımı

- Responsive grid sistemi
- Navbar kullanımı
- Card bileşenleri
- Modal doğrulamalar
- Alert mesajları

## Tasarım Kuralları

- Tutarlı renk paleti
- Mobil uyumluluk
- Aktif sayfa vurgusu
- Kullanıcı dostu navigasyon

---

# Performans ve Kod Kalitesi

## Kod Standartları

- Anlamlı değişken isimleri
- Fonksiyon bazlı yapı
- Tekrar eden kodlardan kaçınma
- Yorum satırı kullanımı

## Veritabanı Standartları

- Foreign key kullanımı
- İlişkisel yapı
- Normalize edilmiş tablolar

---

# Minimum Başarı Kriterleri

Projede başarılı sayılabilmek için aşağıdaki yapıların çalışıyor olması gerekir:

- CRUD işlemleri
- Session yönetimi
- Role-based access control
- Stok hareket kayıtları
- Kritik stok sistemi
- Dashboard raporları
- Responsive tasarım
- Güvenli SQL kullanımı

---

# Sonuç

Bu proje; gerçek dünya stok yönetim süreçlerini temel alan, modüler yapıda geliştirilmiş bir web uygulamasıdır.

Agent tabanlı yaklaşım sayesinde:

- Modüller birbirinden bağımsız geliştirilebilir
- Kod bakımı kolaylaşır
- Ölçeklenebilir yapı sağlanır
- Güvenlik ve sürdürülebilirlik artar

Sistem mimarisi, akademik değerlendirme kriterlerini karşılayacak şekilde yapılandırılmıştır.