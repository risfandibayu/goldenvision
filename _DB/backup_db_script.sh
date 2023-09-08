#/bin/bash
# Mendapatkan tanggal saat ini dalam format YYYYMMDD
current_date=$(date +"%Y%m%d")

# Nama file backup dengan tanggal
backup_filename="masterplan_main_db_backup/masterplan_main_$current_date.sql"

mysqldump -u masterpl_masterpl_dev -p xlnH7Br2PeI$ masterpl_main member_grows rekenings transactions urewards users user_extras user_golds user_pin withdrawals > "$backup_filename"
