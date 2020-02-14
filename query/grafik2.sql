/*SELECT `b`.`nama`, `b`.`no_peserta`, `b`.`nuptk`, `b`.`nip`, avg(a.nilai_total) as nilaiukg, `b`.`kode_sekolah`, avg(c.nilaiakhir) as nilaisiswa, `c`.`kelas`, `d`.`kecamatan`, `a`.`mata_pelajaran`, `c`.`kd_matpel`
FROM `tbl_hasil_ukg` as `a`
INNER JOIN `tbl_guru` as `b` ON `b`.`no_peserta` = `a`.`no_peserta`
INNER JOIN `v_rekapjwbguru` AS `c` ON  `c`.`kd_sekolah` = `a`.`kd_sekolah` 
INNER JOIN `tbl_sekolah` AS `d` ON  `a`.`kd_sekolah` = `d`.`npsn`
WHERE `d`.`jenjang` = 'SMP'
AND `d`.`kecamatan` = 'Patuk'
AND `c`.`kd_sekolah` = '20402033'
AND `c`.`thn_upload` = '2018'
AND `a`.`tahun` = '2018'
GROUP BY 1, 2, 3, 4, 6, 8, 9, 10, 11, 12;*/

select round(avg(T1.nilaiakhir),2) as nilaisiswa, round(avg(T2.nilai_total),2) as nilaiukg,T1.kd_matpel
from v_rekapjwbguru T1
inner join tbl_hasil_ukg T2 on T2.kd_sekolah = T1.kd_sekolah
group by 3
