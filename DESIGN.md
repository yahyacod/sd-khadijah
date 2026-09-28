# Design Direction: SD Khadijah Wonorejo

Dokumen ini mendefinisikan arah desain visual dan karakter untuk situs web **SD Khadijah Wonorejo Surabaya** ("Sekolah Pemimpin yang Santun").

---

## 1. Brand Identity & Character

- **Visi & Nilai**: Pendidikan Islam berlandaskan nilai Ahlussunnah wal Jamaah An-Nahdliyah, membentuk siswa berakhlak mulia, percaya diri, dan santun dalam memimpin.
- **Visual Personality**: Warm Educational Leadership, Authentic, Editorial & Humanist (Bukan SaaS tech / bukan AI template).

---

## 2. Palette Color System

- **Primary Deep Green**: `#12332A` (Kesan Islami yang dalam, kokoh, dan berwibawa)
- **Primary Forest Green**: `#1F4D3A` (Hijau khas Khadijah/Aswaja)
- **Soft Tint Green**: `#F0F5F2` (Background section netral dan sejuk)
- **Accent Warm Gold**: `#B98A2A` / `#D4A237` (Aksen keemasan untuk penghargaan, prestasi, dan keunggulan)
- **Base Canvas**: `#FAF8F5` (Warm off-white, mudah dibaca dan nyaman di mata)
- **Ink Text**: `#222521` (Kontras tinggi untuk keterbacaan optimal)
- **Muted Text**: `#5C6057`

---

## 3. Typography

- **Headings & Display**: `Fraunces` (Serif hangat dengan karakter editorial dan akademis)
- **Body & Controls**: `Plus Jakarta Sans` (Sans-serif modern, bersih, dan sangat terbaca pada berbagai ukuran layar)

---

## 4. Anti-Slop Dials

| Dial | Value | Rationale |
|---|---|---|
| **ENERGY** | **2 (Balanced)** | Hangat, ramah anak dan wali murid, ramah publik, tanpa warna neon/glow berlebihan. |
| **RHYTHM** | **3 (Bold)** | Tata letak section bervariasi secara asimetris (kombinasi kartu hero, grid berita editorial, galeri mengalir, dan spotlight khusus). |
| **MOTION** | **1 (Calm)** | Mikro-interaksi hover tombol dan transisi gambar yang halus. Bebas dari animasi scroll membal atau loop tanpa henti. |

---

## 5. Architectural Rules & Constraints

- **No Decorative Emojis**: Dilarang menggunakan emoji biasa (`🎓`, `🚀`, `🕌`) sebagai ikon UI resmi.
- **No Decorative Arrows Everywhere**: Panah (`&rarr;`) ditahan hanya untuk navigasi berantai yang membutuhkan petunjuk arah jelas.
- **No Fake Data**: Angka statistik tidak ditampilkan jika belum ada data riil dari database.
- **Dose Caps**: Kaca buram (*glassmorphism*) dibatasi maksimal pada 1 elemen (Header sticky).

