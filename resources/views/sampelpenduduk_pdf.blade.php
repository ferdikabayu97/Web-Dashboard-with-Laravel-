<!DOCTYPE html>
<html>
<head>
<title>PDF Penduduk - Rekusaha</title>
</head>
<body>
<center>
<h1> Data Sampel Penduduk Berdasarkan </h1>
<h3> <?php 
                    if($jenis == "jk_al")echo "Jenis Kelamin";
                    if($jenis == "sk_al")echo "Status Kawin";
                    if($jenis == "pendidikan_al")echo "Pendidikan";
                    if($jenis == "pekerjaan_al")echo "Pekerjaan";
                    if($jenis == "rek_harga")echo "Rekomendasi Harga";
                    if($jenis == "umur_al")echo "Umur";  ?> 
                    </h3>

    <font size="1">
    </center>

	<table border="1">
    <tr>
        
			<th>Id Alternatif</th>
			<th>Nama Alternatif</th>
			<th>Banyak Sampel</th>
			<th>ID rekomendasi Harga</th>
        <?php
        if ($jenis == "jk_al"){

        
        ?>
        	<th>Pria</th>
            <th>Wanita</th>
        <?php    
        }else if ($jenis == "sk_al"){
        ?>
        	<th>Belum Kawin</th>
            <th>Kawin</th>
            <th>Cerai Hidup</th>
            <th>Cerai Mati</th>
        <?php
        }else if ($jenis == "pendidikan_al"){
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
            }else if ($jenis == "pekerjaan_al"){
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
                }else if ($jenis == "umur_al"){
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
                    }else if ($jenis == "rek_harga"){
                        ?>
                            <th>5-10 Ribu</th>
                            <th>10-15 Ribu</th>
                            <th>15-20 Ribu</th>
                            <th>20-25 Ribu</th>
                            <th>25-30 Ribu</th>
                            <th>30 Ribu Keatas</th>
                            
                        <?php
                        }else{
            
                    }
        ?>
		</tr>
		@foreach($sampelpenduduk as $p)
		<tr>
			<td>{{ $p->id_alternatif }}</td>
			<td>{{ $p->nama_alternatif }}</td>
			<td>{{ $p->banyak_sample }}</td>
			<td>{{ $p->id_rharga }}</td>
            <?php
            if ($jenis == "jk_al"){
            ?>  
            
                <td>{{ $p->jk_al->pria }}</td>
			<td>{{ $p->jk_al->wanita }}</td>
                
                <?php
            
            }else if ($jenis == "sk_al"){
                ?>  
                
                <td>{{ $p->sk_al->belum_kawin }}</td>
                <td>{{ $p->sk_al->kawin }}</td>
                <td>{{ $p->sk_al->cerai_hidup }}</td>
                <td>{{ $p->sk_al->cerai_mati }}</td>
                    
                    <?php
                
                } else if ($jenis == "pendidikan_al"){
                    ?>  
                    
                    <td>{{ $p->pendidikan_al->belum_sekolah }}</td>
                    <td>{{ $p->pendidikan_al->belum_tamat_sd }}</td>
                    <td>{{ $p->pendidikan_al->tamat_sd }}</td>
                    <td>{{ $p->pendidikan_al->smp }}</td>
                    <td>{{ $p->pendidikan_al->sma }}</td>
                    <td>{{ $p->pendidikan_al->di_dii }}</td>
                    <td>{{ $p->pendidikan_al->diii }}</td>
                    <td>{{ $p->pendidikan_al->s1 }}</td>
                    <td>{{ $p->pendidikan_al->s2 }}</td>
                    <td>{{ $p->pendidikan_al->s3 }}</td>
                        
                        <?php
                    
                    } else if ($jenis == "pekerjaan_al"){
                        ?>  
                        
                        <td>{{ $p->pekerjaan_al->tidak_bekerja }}</td>
                        <td>{{ $p->pekerjaan_al->aparat_pejabat_negara }}</td>
                        <td>{{ $p->pekerjaan_al->tenaga_pengajar }}</td>
                        <td>{{ $p->pekerjaan_al->wiraswasta }}</td>
                        <td>{{ $p->pekerjaan_al->pertanian }}</td>
                        <td>{{ $p->pekerjaan_al->nelayan }}</td>
                        <td>{{ $p->pekerjaan_al->bidang_keagamaan }}</td>
                        <td>{{ $p->pekerjaan_al->pelajar_dan_mahasiswa }}</td>
                        <td>{{ $p->pekerjaan_al->tenaga_kesehatan }}</td>
                        <td>{{ $p->pekerjaan_al->pensiunan }}</td>
                        <td>{{ $p->pekerjaan_al->lainnya }}</td>
                            
                            
                            <?php
                        
                        } else if ($jenis == "umur_al"){
                            ?>  
                            
                            <td>{{ $p->umur_al->u0_4 }}</td>
                            <td>{{ $p->umur_al->u5_9 }}</td>
                            <td>{{ $p->umur_al->u10_14 }}</td>
                            <td>{{ $p->umur_al->u15_19 }}</td>
                            <td>{{ $p->umur_al->u20_24 }}</td>
                            <td>{{ $p->umur_al->u25_29 }}</td>
                            <td>{{ $p->umur_al->u30_34 }}</td>
                            <td>{{ $p->umur_al->u35_39 }}</td>
                            <td>{{ $p->umur_al->u40_44 }}</td>
                            <td>{{ $p->umur_al->u45_49 }}</td>
                            <td>{{ $p->umur_al->u50_54 }}</td>
                            <td>{{ $p->umur_al->u55_59 }}</td>
                            <td>{{ $p->umur_al->u60_64 }}</td>
                            <td>{{ $p->umur_al->u65_69 }}</td>
                            <td>{{ $p->umur_al->u70_74 }}</td>
                            <td>{{ $p->umur_al->u75_above }}</td>
                            
                                
                               
                                <?php
                            
                            } else if ($jenis == "rek_harga"){
                                ?>
                                    <td>{{ $p->rek_harga->h5_10 }}</td>
                                    <td>{{ $p->rek_harga->h10_15 }}</td>
                                    <td>{{ $p->rek_harga->h15_20 }}</td>
                                    <td>{{ $p->rek_harga->h20_25 }}</td>
                                    <td>{{ $p->rek_harga->h25_30 }}</td>
                                    <td>{{ $p->rek_harga->h30_abv }}</td>
                                    
                                <?php
                                }else{
            
                            }
            ?>
            
			
		</tr>
    @endforeach
</table>
</font>
	
</body>
</html>