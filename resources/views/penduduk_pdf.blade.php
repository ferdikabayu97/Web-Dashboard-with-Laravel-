<!DOCTYPE html>
<html>
<head>
<title>PDF Penduduk - Rekusaha</title>
</head>
<body>
<center>
<h1> Data Penduduk Berdasarkan </h1>
<h3> <?php 
                    if($jenis == "jk")echo "Jenis Kelamin";
                    if($jenis == "sk")echo "Status Kawin";
                    if($jenis == "pendidikan")echo "Pendidikan";
                    if($jenis == "pekerjaan")echo "Pekerjaan";
                    if($jenis == "umur")echo "Umur";  ?> 
                    </h3>

    <font size="1">
    </center>

	<table border="1">
    <thead>
    <tr>
        
        <th>Id Lokasi</th>
        <th>Kecamatan</th>
        <th>Kelurahan</th>
        <th>Banyak Penduduk</th>
    <?php
    if ($jenis == "jk"){

    
    ?>
        <th>Pria</th>
        <th>Wanita</th>
    <?php    
    }else if ($jenis == "sk"){
    ?>
        <th>Belum Kawin</th>
        <th>Kawin</th>
        <th>Cerai Hidup</th>
        <th>Cerai Mati</th>
    <?php
    }else if ($jenis == "pendidikan"){
        ?>
            <th>Belum Sekolah</th>
            <th>Belum Tamat SD</th>
            <th>SD</th>
            <th>SMP</th>
            <th>SMA</th>
            <th>DI dan DII</th>
            <th>DIII</th>
            <th>S1</th>
            <th>S2</th>
            <th>S3</th>
            
        <?php
        }else if ($jenis == "pekerjaan"){
            ?>
                <th>Tidak Bekerja</th>
                <th>Aparat Pejabat Negara</th>
                <th>Tenaga Pengajar</th>
                <th>Wiraswasta</th>
                <th>Bidang Pertanian</th>
                <th>Nelayan</th>
                <th>Bidang Keagamaan</th>
                <th>Pelajar dan Mahasiswa</th>
                <th>Tenaga Kesehatan</th>
                <th>Pensiunan</th>
                <th>Lainnya</th>
                
            <?php
            }else if ($jenis == "umur"){
                ?>
                    <th>0-4 Tahun</th>
                    <th>5-9 Tahun</th>
                    <th>10-14 Tahun</th>
                    <th>15-19 Tahun</th>
                    <th>20-24 Tahun</th>
                    <th>25-29 Tahun</th>
                    <th>30-34 Tahun</th>
                    <th>35-39 Tahun</th>
                    <th>40-44 Tahun</th>
                    <th>45-49 Tahun</th>
                    <th>50-54 Tahun</th>
                    <th>55-59 Tahun</th>
                    <th>60-64 Tahun</th>
                    <th>65-69 Tahun</th>
                    <th>70-74 Tahun</th>
                    <th>75 Tahun Keatas</th>
                    
                    
                <?php
                }else{
        
                }
    ?>
    </tr>
    </thead>

    <tbody>
    @foreach($penduduk as $p)
    <tr>
        <td>{{ $p->id_lokasi }}</td>
        <td>{{ $p->kecamatan }}</td>
        <td>{{ $p->kelurahan }}</td>
        <td>{{ $p->banyak_penduduk }}</td>
        <?php
        if ($jenis == "jk"){
        ?>  
        <?php
        if($p->kelurahan != ""){
            ?>
            <td>{{ $p->jk->pria }}</td>
        <td>{{ $p->jk->wanita }}</td>
            <?php
        }else{
            ?>
            <td>-</td>
            <td>-</td>
            <?php
        }
        }else if ($jenis == "sk"){
            ?>  
            <?php
            if($p->kelurahan != ""){
                ?>
            <td>{{ $p->sk->belum_kawin }}</td>
            <td>{{ $p->sk->kawin }}</td>
            <td>{{ $p->sk->cerai_hidup }}</td>
            <td>{{ $p->sk->cerai_mati }}</td>
                <?php
            }else{
                ?>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <?php
            }
            } else if ($jenis == "pendidikan"){
                ?>  
                <?php
                if($p->kelurahan != ""){
                    ?>
                <td>{{ $p->pendidikan->belum_sekolah }}</td>
                <td>{{ $p->pendidikan->belum_tamat_sd }}</td>
                <td>{{ $p->pendidikan->tamat_sd }}</td>
                <td>{{ $p->pendidikan->smp }}</td>
                <td>{{ $p->pendidikan->sma }}</td>
                <td>{{ $p->pendidikan->di_dii }}</td>
                <td>{{ $p->pendidikan->diii }}</td>
                <td>{{ $p->pendidikan->s1 }}</td>
                <td>{{ $p->pendidikan->s2 }}</td>
                <td>{{ $p->pendidikan->s3 }}</td>
                    <?php
                }else{
                    ?>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <?php
                }
                } else if ($jenis == "pekerjaan"){
                    ?>  
                    <?php
                    if($p->kelurahan != ""){
                        ?>
                    <td>{{ $p->pekerjaan->tidak_bekerja }}</td>
                    <td>{{ $p->pekerjaan->aparat_pejabat_negara }}</td>
                    <td>{{ $p->pekerjaan->tenaga_pengajar }}</td>
                    <td>{{ $p->pekerjaan->wiraswasta }}</td>
                    <td>{{ $p->pekerjaan->pertanian }}</td>
                    <td>{{ $p->pekerjaan->nelayan }}</td>
                    <td>{{ $p->pekerjaan->bidang_keagamaan }}</td>
                    <td>{{ $p->pekerjaan->pelajar_dan_mahasiswa }}</td>
                    <td>{{ $p->pekerjaan->tenaga_kesehatan }}</td>
                    <td>{{ $p->pekerjaan->pensiunan }}</td>
                    <td>{{ $p->pekerjaan->lainnya }}</td>
                        
                        <?php
                    }else{
                        ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>

                        <?php
                    }
                    } else if ($jenis == "umur"){
                        ?>  
                        <?php
                        if($p->kelurahan != ""){
                            ?>
                        <td>{{ $p->umur->u0_4 }}</td>
                        <td>{{ $p->umur->u5_9 }}</td>
                        <td>{{ $p->umur->u10_14 }}</td>
                        <td>{{ $p->umur->u15_19 }}</td>
                        <td>{{ $p->umur->u20_24 }}</td>
                        <td>{{ $p->umur->u25_29 }}</td>
                        <td>{{ $p->umur->u30_34 }}</td>
                        <td>{{ $p->umur->u35_39 }}</td>
                        <td>{{ $p->umur->u40_44 }}</td>
                        <td>{{ $p->umur->u45_49 }}</td>
                        <td>{{ $p->umur->u50_54 }}</td>
                        <td>{{ $p->umur->u55_59 }}</td>
                        <td>{{ $p->umur->u60_64 }}</td>
                        <td>{{ $p->umur->u65_69 }}</td>
                        <td>{{ $p->umur->u70_74 }}</td>
                        <td>{{ $p->umur->u75_above }}</td>
                        
                            
                            <?php
                        }else{
                            ?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>

                            <?php
                        }
                        } else {
        
                        }
        ?>
        
        
       
    </tr>
    <tbody>

    @endforeach
</table>
</font>
	
</body>
</html>