<h2>login :</h2> 
email    : tamu@g.c <br>
role     : <b>admin</b> <br>
password : hilih <br>

email    : gudang@g.c<br>
role     : <b>gudang</b> <br>
password : hilih<br>

email    : supplier@g.c<br>
role     : <b>Supplier</b> <br>
password : hilih<br>

email    : qc@g.c<br>
role     : <b>QC / Quality Control</b> <br>
password : hilih<br>

#note : jika tidak bisa login, kemungkinan email / password diganti oleh tamu<br>
----------------------------------------<br>

<h2>akses edit order berdasarkan role:</h2> <br>
[tambah order]      : Gudang <br>
belum diproses      : supplier<br>
diproses            : supplier<br>
menunggu konfirmasi : supplier, QC<br>
ditolak             : supplier, QC<br>
terkonfirmasi       : QC, Gudang<br>
selesai             : Gudang<br>
