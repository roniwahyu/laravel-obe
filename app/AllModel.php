<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStudi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Program_Studi';
    protected $primaryKey = 'id_prodi';
    public $timestamps = false;
    protected $fillable = ['nama_prodi'];

    public function profilLulusans()
    {
        return $this->hasMany(ProfilLulusan::class, 'id_prodi');
    }

    public function cpls()
    {
        return $this->hasMany(CPL::class, 'id_prodi');
    }

    public function createProgramStudi($data)
    {
        return self::create($data);
    }

    public function updateProgramStudi($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteProgramStudi($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class ProfilLulusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Profil_Lulusan';
    protected $primaryKey = 'id_profil';
    public $timestamps = false;
    protected $fillable = ['nama_profil', 'deskripsi_profil', 'id_prodi'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function matriksCpl()
    {
        return $this->hasMany(MatrikCPLProfil::class, 'id_profil');
    }

    public function createProfilLulusan($data)
    {
        return self::create($data);
    }

    public function updateProfilLulusan($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteProfilLulusan($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class CPL extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'CPL';
    protected $primaryKey = 'id_cpl';
    public $timestamps = false;
    protected $fillable = ['kode_cpl', 'isi_cpl', 'deskripsi_cpl', 'kategori_cpl', 'id_prodi'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function matriksProfil()
    {
        return $this->hasMany(MatrikCPLProfil::class, 'id_cpl');
    }

    public function createCPL($data)
    {
        return self::create($data);
    }

    public function updateCPL($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteCPL($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class BahanKajian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Bahan_Kajian';
    protected $primaryKey = 'id_bahan_kajian';
    public $timestamps = false;
    protected $fillable = ['nama_bahan_kajian', 'deskripsi_bahan_kajian'];

    public function matriksCpl()
    {
        return $this->hasMany(MatrikCPLBK::class, 'id_bahan_kajian');
    }

    public function createBahanKajian($data)
    {
        return self::create($data);
    }

    public function updateBahanKajian($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteBahanKajian($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class MataKuliah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Mata_Kuliah';
    protected $primaryKey = 'id_mk';
    public $timestamps = false;
    protected $fillable = ['kode_mk', 'nama_mk', 'deskripsi_mk', 'sks_teori', 'sks_praktik', 'rumpun_mk', 'kategori_mk', 'semester_mk', 'id_prodi'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function cpmks()
    {
        return $this->hasMany(CPMK::class, 'id_mk');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'MK_Dosen', 'id_mk', 'id_dosen');
    }

    public function createMataKuliah($data)
    {
        return self::create($data);
    }

    public function updateMataKuliah($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteMataKuliah($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class CPMK extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'CPMK';
    protected $primaryKey = 'id_cpmk';
    public $timestamps = false;
    protected $fillable = ['id_mk', 'konten_cpmk'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk');
    }

    public function subCpmks()
    {
        return $this->hasMany(SubCPMK::class, 'id_cpmk');
    }

    public function createCPMK($data)
    {
        return self::create($data);
    }

    public function updateCPMK($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteCPMK($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class SubCPMK extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Sub_CPMK';
    protected $primaryKey = 'id_subcpmk';
    public $timestamps = false;
    protected $fillable = ['id_cpmk', 'konten_subcpmk'];

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'id_cpmk');
    }

    public function createSubCPMK($data)
    {
        return self::create($data);
    }

    public function updateSubCPMK($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteSubCPMK($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Dosen';
    protected $primaryKey = 'id_dosen';
    public $timestamps = false;
    protected $fillable = ['nama_dosen', 'id_prodi'];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }

    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'MK_Dosen', 'id_dosen', 'id_mk');
    }

    public function createDosen($data)
    {
        return self::create($data);
    }

    public function updateDosen($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteDosen($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class MatrikCPLProfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Matrik_CPL_Profil';
    protected $primaryKey = 'id_matrik_cpl_profil';
    public $timestamps = false;
    protected $fillable = ['id_cpl', 'id_profil'];

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl');
    }

    public function profilLulusan()
    {
        return $this->belongsTo(ProfilLulusan::class, 'id_profil');
    }

    public function createMatrikCPLProfil($data)
    {
        return self::create($data);
    }

    public function updateMatrikCPLProfil($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteMatrikCPLProfil($id)
    {
        return self::findOrFail($id)->delete();
    }
}

class MatrikCPLBK extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Matrik_CPL_BK';
    protected $primaryKey = 'id_matrik_cpl_bk';
    public $timestamps = false;
    protected $fillable = ['id_cpl', 'id_bahan_kajian'];

    public function cpl()
    {
        return $this->belongsTo(CPL::class, 'id_cpl');
    }

    public function bahanKajian()
    {
        return $this->belongsTo(BahanKajian::class, 'id_bahan_kajian');
    }

    public function createMatrikCPLBK($data)
    {
        return self::create($data);
    }

    public function updateMatrikCPLBK($id, $data)
    {
        return self::findOrFail($id)->update($data);
    }

    public function deleteMatrikCPLBK($id)
    {
        return self::findOrFail($id)->delete();
    }
}

// Model lainnya dapat dibuat serupa dengan struktur di atas untuk memenuhi kebutuhan tabel lainnya.
