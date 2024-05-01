<?php
// Parent class (kelas dasar)
class Buku {
    // Properti
    protected $judul;
    protected $penulis;
    protected $tahun_terbit;
    protected $no_isbn;
    protected $denda_keterlambatan;
    protected $status;

    // Constructor
    public function __construct($judul, $penulis, $tahun_terbit, $no_isbn, $denda_keterlambatan, $status) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun_terbit = $tahun_terbit;
        $this->no_isbn = $no_isbn;
        $this->denda_keterlambatan = $denda_keterlambatan;
        $this->status = $status;
    }

    // Getter untuk judul buku
    public function getJudul() {
        return $this->judul;
    }

    // Getter untuk penulis buku
    public function getPenulis() {
        return $this->penulis;
    }

    // Getter untuk tahun terbit buku
    public function getTahunTerbit() {
        return $this->tahun_terbit;
    }

    // Getter untuk no ISBN buku
    public function getNoISBN() {
        return $this->no_isbn;
    }

    // Getter untuk denda keterlambatan buku
    public function getDendaKeterlambatan() {
        return $this->denda_keterlambatan;
    }

    // Getter untuk status buku
    public function getStatus() {
        return $this->status;
    }
}

// Child class (kelas turunan)
class BukuPerpustakaan extends Buku {
    // Method untuk memperbarui status buku menjadi "Dipinjam"
    public function pinjamBuku() {
        if ($this->status == 'Tersedia') {
            $this->status = 'Dipinjam';
            return true;
        } else {
            return false; // Buku sudah dipinjam
        }
    }

    // Method untuk menghapus buku berdasarkan ID
    public function hapusBuku(&$books, $id) {
        foreach ($books as $key => $book) {
            if ($book->getNoISBN() == $id) {
                unset($books[$key]);
                return true;
            }
        }
        return false; // Buku tidak ditemukan
    }
}

// Array buku dalam bentuk objek
$books = array(
    new BukuPerpustakaan('Al-Qur\'an', 'Allah SWT', 'Revealed Over 23 Years', 'ISBN-9781234567890','Rp.2000','Tersedia'),
    new BukuPerpustakaan('Sahih Al-Bukhari', 'Imam Bukhari', '9th Century', 'ISBN-9780987654321', 'Rp.4000', 'Tersedia'),
    new BukuPerpustakaan('Sahih Muslim', 'Imam Muslim', '9th Century', 'ISBN-9789876543210','-', 'Tersedia'),
    new BukuPerpustakaan('Al-Adzkar', 'Imam An-Nawawi', '13th Century', 'ISBN-9780123456789','-', 'Tersedia'),
    new BukuPerpustakaan('Bidayatul Hidayah', 'Imam Al-Ghazali', '12th Century', 'ISBN-9785432109876', '-', 'Tersedia'),
    // Tambahkan buku-buku Islam lainnya sesuai kebutuhan
);


// Fungsi untuk mengurutkan daftar buku berdasarkan tahun terbit secara menaik
usort($books, function($a, $b) {
    return $a->getTahunTerbit() <=> $b->getTahunTerbit();
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan link ke file style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4"> Daftar Perpustakaan Ahmad</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Form pencarian -->
                <form id="searchForm" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Cari buku...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Tabel daftar buku -->
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>No ISBN</th>
                    <th>Denda Keterlambatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="bookList">
                <!-- Loop untuk menampilkan data buku dari array -->
                <?php
                // Loop untuk menampilkan data buku
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td>{$book->getJudul()}</td>";
                    echo "<td>{$book->getPenulis()}</td>";
                    echo "<td>{$book->getTahunTerbit()}</td>";
                    echo "<td>{$book->getNoISBN()}</td>";
                    echo "<td>{$book->getDendaKeterlambatan()}</td>";
                    echo "<td>{$book->getStatus()}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Tambahkan link ke Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk menangani pencarian dinamis
        $(document).ready(function(){
            $('#keyword').on('input', function(){
                var keyword = $(this).val().toLowerCase(); // Ambil nilai kata kunci pencarian

                // Loop melalui setiap baris tabel
                $('#bookList tr').filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1); // Sembunyikan baris yang tidak sesuai dengan kata kunci pencarian
                });
            });
        });
    </script>
</body>
</html>
