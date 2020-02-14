/*SELECT round(avg(a.nilai_total), 2) as nilaiukg,  round(avg(c.nilaiakhir), 2) as nilaisiswa ,`d`.`kecamatan`
FROM `tbl_hasil_ukg` as `a`
INNER JOIN `v_rekapjwbguru` AS `c` ON `c`.`kd_sekolah` = `a`.`kd_sekolah` 
INNER JOIN `tbl_sekolah` AS `d` ON `a`.`kd_sekolah` = `d`.`npsn`
 WHERE `d`.`jenjang` = 'SMP'
AND `kelas` = '7'
AND `c`.`thn_upload` = '2018'
 AND `a`.`tahun` = '2018'
GROUP BY 3
order by d.kecamatan asc;*/

-- select T2.namasekolah,T4.nama,T4.kd_matpel,round(avg(T3.nilai_total),2) as nilaiukg,round(avg(T1.bin),2) as rat_bin,round(avg(T1.ing),2) as rat_ing,
-- round(avg(T1.mat),2) as rat_mat,round(avg(T1.ipa),2) as rat_ipa from 
-- tbl_jml_nilai as T1 
-- inner join tbl_sekolah T2 on T1.kode_sekolah = T2.npsn
-- inner join tbl_hasil_ukg as T3 on T3.kd_sekolah = T2.npsn
-- inner join tbl_guru as T4 on T4.no_peserta = T3.no_peserta
-- where T1.tahun = 2018
-- and T2.jenjang = "SMP"
-- and T3.tahun = 2018
-- group by T2.namasekolah,T4.nama,3
-- order by T2.namasekolah asc;

-- SELECT T2.kecamatan,round(avg(T3.nilai_total), 2) as nilaiukg,  round(avg(T1.ipa), 2) as rat_ipa
-- FROM tbl_jml_nilai as T1
-- inner join tbl_sekolah T2 on T1.kode_sekolah = T2.npsn
-- inner join tbl_hasil_ukg as T3 on T3.kd_sekolah = T2.npsn
-- WHERE T2.jenjang = 'SMP'
-- AND T1.tahun = '2018'
-- AND T3.tahun = '2018'
-- GROUP BY T2.kecamatan

/*select round(avg(T1.nilai_total),2) as nilaiukg, T2.kecamatan
from tbl_hasil_ukg as T1 
inner join tbl_sekolah as T2 on T2.npsn = T1.kd_sekolah
group by 2
order by 2 asc

/* select round(avg(T1.nilai_total),2) as nilaiukg, T2.kecamatan from 
	(tbl_hasil_ukg T1 left join tbl_sekolah T2 on T1.kd_sekolah = T2.npsn)
    left join tbl
group by 2
    order by 2 asc
*/

-- SELECT `a`.`kabupaten`, `a`.`kd_matpel`, `b`.`matpel`, ifnull(round(avg(a.ratarata), 2), 0) as nilai
-- FROM `v_rekapjwbkec` `a`
-- LEFT JOIN `ref_matpel` `b` ON `a`.`kd_matpel` = `b`.`id`
-- WHERE `a`.`jenjang` = 'SMP'
-- AND `a`.`kelas` = '7'
-- AND `a`.`thn_upload` = '2018'
-- AND a.kecamatan = "Nglipar"
-- GROUP BY 1, 2, 3

Select T1.id, T1.nama_sekolah, T2.kecamatan, T1.status_sekolah,T1.tahun, T1.tot,T1.bin,T1.ipa,T1.mat,T1.ing
from tbl_jml_nilai T1
inner join tbl_sekolah T2 on T2.npsn = T1.kode_sekolah
where T1.tahun = 2018
order by tot desc

