<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            min-height: 100vh; color: #333;
        }

        .glass-navbar {
            position: fixed; top: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex; justify-content: space-between; align-items: center; padding: 15px 40px; box-sizing: border-box; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; }
        .nav-brand h2 { margin: 0; font-family: 'Orbitron', sans-serif; font-size: 24px; letter-spacing: 1px; }
        .text-dark { color: #1A1A3A; } .text-orange { color: #F9A826; }

        .btn-back {
            text-decoration: none; color: #444; font-weight: 600; font-size: 14px;
            display: flex; align-items: center; gap: 8px; transition: 0.3s;
        }
        .btn-back:hover { color: #F9A826; }

        .container { max-width: 600px; margin: 120px auto 50px auto; padding: 0 20px; }

        .glass-panel {
            background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 20px;
            padding: 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05); text-align: center;
        }

        /* --- CSS KHUSUS UNTUK FOTO PROFIL BISA DIKLIK --- */
        .avatar-upload { position: relative; max-width: 130px; margin: 0 auto 20px auto; cursor: pointer; transition: 0.3s; }
        .avatar-upload:hover { transform: scale(1.05); }
        .avatar-preview {
            width: 130px; height: 130px; border-radius: 50%;
            border: 4px solid #fff; box-shadow: 0 5px 15px rgba(249, 168, 38, 0.3);
            object-fit: cover; background-color: #1A1A3A;
        }
        .avatar-icon {
            position: absolute; bottom: 5px; right: 5px; background: #F9A826; color: white;
            width: 35px; height: 35px; border-radius: 50%; display: flex; justify-content: center; align-items: center;
            border: 3px solid #fff; font-size: 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #444; }
        .form-group input {
            width: 100%; padding: 12px; box-sizing: border-box; background: rgba(255, 255, 255, 0.8); 
            border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 8px; color: #333; outline: none; transition: 0.3s; font-family: inherit;
        }
        .form-group input:focus { border-color: #F9A826; box-shadow: 0 0 8px rgba(249, 168, 38, 0.2); }

        .btn-orange {
            width: 100%; background: linear-gradient(135deg, #F9A826, #E85D04); border: none;
            padding: 14px; border-radius: 8px; color: white; font-size: 16px; font-weight: bold; cursor: pointer;
            transition: 0.3s; box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3); margin-top: 10px;
        }
        .btn-orange:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }
    </style>
</head>
<body>

    <nav class="glass-navbar">
        <div class="nav-brand"><h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2></div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </nav>

    <div class="container">
        <div class="glass-panel">
            <h2 style="margin-top:0; color:#1A1A3A;">Pengaturan Profil</h2>
            <p style="color:#666; font-size:14px; margin-bottom:30px;">Perbarui informasi akun dan foto profil Anda di sini.</p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="avatar-upload" onclick="document.getElementById('profile_picture').click()">
                    @if(Auth::user()->profile_picture)
                        <img id="avatarPreview" class="avatar-preview" src="{{ asset('profil/' . Auth::user()->profile_picture) }}?v={{ time() }}" alt="Foto Profil">
                    @else
                        <div id="avatarPreview" class="avatar-preview" style="display:flex; justify-content:center; align-items:center; font-size:50px; color:white;">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                    <div class="avatar-icon"><i class="fa-solid fa-camera"></i></div>
                </div>

                <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg, image/png, image/jpg" style="display: none;" onchange="previewImage(event)">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-group">
                    <label>Email Akses</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <div class="form-group">
                    <label>Kata Sandi Baru (Kosongkan jika tidak ingin mengubah)</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="passwordField" style="padding-right: 40px;" placeholder="">
                        <i class="fa-regular fa-eye-slash" id="togglePassword" onclick="toggleVisibility()" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; font-size: 16px; transition: 0.3s;"></i>
                    </div>
                </div>

                <button type="submit" class="btn-orange">SIMPAN PERUBAHAN</button>
            </form>

        </div>
    </div>

    <script>
        // --- SCRIPT UNTUK PREVIEW GAMBAR SECARA LIVE SEBELUM DISIMPAN ---
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('avatarPreview');
                // Jika sebelumnya menggunakan div ikon, kita ganti jadi elemen img
                if(output.tagName === 'DIV') {
                    var newImg = document.createElement('img');
                    newImg.id = 'avatarPreview';
                    newImg.className = 'avatar-preview';
                    newImg.src = reader.result;
                    output.parentNode.replaceChild(newImg, output);
                } else {
                    output.src = reader.result;
                }
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // --- SCRIPT UNTUK TOGGLE VISIBILITY PASSWORD ---
        function toggleVisibility() {
            var passwordInput = document.getElementById("passwordField");
            var toggleIcon = document.getElementById("togglePassword");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
                toggleIcon.style.color = "#F9A826"; // Berubah warna oranye saat password terlihat
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
                toggleIcon.style.color = "#888"; // Kembali abu-abu saat tersembunyi
            }
        }
    </script>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    confirmButtonColor: '#F9A826',
                    background: '#ffffff'
                });
            });
        </script>
    @endif
    
    @if($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#d33',
                    background: '#ffffff'
                });
            });
        </script>
    @endif

</body>
</html>