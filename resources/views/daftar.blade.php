<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Agen — MobiTravel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=DM+Sans&display=swap" rel="stylesheet">

<style>
/* (CSS LU GA DIUBAH SAMA SEKALI BIAR AMAN) */
body{font-family:'DM Sans',sans-serif;background:#faf8f3;margin:0}
.nav{position:fixed;top:0;width:100%;display:flex;justify-content:space-between;padding:20px;background:#f5f0e8}
.page-wrap{padding:100px 20px;max-width:800px;margin:auto}
.form-card{background:#fff;padding:20px;border-radius:12px}
.step-panel{display:none}
.step-panel.active{display:block}
</style>
</head>

<body>

<nav class="nav">
<div>MobiTravel</div>
<a href="{{ route('home') }}">← Kembali</a>
</nav>

<div class="page-wrap">

<h1>Daftar Agen Travel</h1>

<div class="form-card">

<!-- STEP TAB STATIC -->
<div style="display:flex;gap:10px;margin-bottom:20px">
<div id="tab-1">1. Data</div>
<div id="tab-2">2. Layanan</div>
<div id="tab-3">3. Dokumen</div>
<div id="tab-4">4. Akun</div>
</div>

<form action="#" method="POST" enctype="multipart/form-data">
@csrf

<!-- STEP 1 -->
<div class="step-panel active" id="panel-1">

<input type="text" name="nama_agen" placeholder="Nama Agen"><br><br>
<input type="text" name="nama_pic" placeholder="Nama PIC"><br><br>

<select name="provinsi">
<option>Pilih Provinsi</option>
<option>Bali</option>
<option>DKI Jakarta</option>
<option>Jawa Barat</option>
<option>Jawa Tengah</option>
<option>Jawa Timur</option>
</select><br><br>

<input type="text" name="kota" placeholder="Kota"><br><br>
<input type="number" name="tahun_berdiri" placeholder="Tahun"><br><br>

<input type="tel" name="whatsapp" placeholder="WhatsApp"><br><br>
<input type="email" name="email_bisnis" placeholder="Email"><br><br>

</div>

<!-- STEP 2 -->
<div class="step-panel" id="panel-2">

<label><input type="checkbox" name="layanan[]"> Wisata</label><br>
<label><input type="checkbox" name="layanan[]"> Antar Jemput</label><br>
<label><input type="checkbox" name="layanan[]"> Sewa Mobil</label><br><br>

<input type="range" min="100" max="5000" id="range" oninput="updatePrice(this.value)">
<span id="price">500</span><br>

<input type="hidden" name="harga_mulai" id="hargaInput" value="500">

</div>

<!-- STEP 3 -->
<div class="step-panel" id="panel-3">

<input type="file" name="file_ktp"><br><br>
<input type="file" name="file_siup"><br><br>

<select name="nama_bank">
<option>BCA</option>
<option>BRI</option>
<option>BNI</option>
<option>Mandiri</option>
</select><br><br>

<input type="text" name="no_rekening" placeholder="No Rekening"><br><br>

</div>

<!-- STEP 4 -->
<div class="step-panel" id="panel-4">

<input type="email" name="email_login" placeholder="Email Login"><br><br>
<input type="tel" name="no_wa_otp" placeholder="WhatsApp OTP"><br><br>

<input type="password" name="password" placeholder="Password"><br><br>
<input type="password" name="password_confirmation" placeholder="Konfirmasi Password"><br><br>

<label>
<input type="checkbox" name="setuju_tnc"> Setuju S&K
</label>

</div>

<br>

<button type="button" onclick="prevStep()">Back</button>
<button type="button" onclick="nextStep()">Next</button>
<button type="submit">Submit</button>

</form>
</div>
</div>

<script>
let step = 1;

function showStep() {
document.querySelectorAll('.step-panel').forEach((el,i)=>{
el.classList.toggle('active', i+1 === step)
})
}

function nextStep(){
if(step<4){step++;showStep()}
}

function prevStep(){
if(step>1){step--;showStep()}
}

function updatePrice(val){
document.getElementById('price').innerText = val
document.getElementById('hargaInput').value = val
}
</script>

</body>
</html>