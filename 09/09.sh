#!/opt/homebrew/bin/zsh
# 
cd "$(dirname "$0")"
mysqldump -u root -p'sMmpB6vR47v' --all-databases > ../backup/all_databases.sql

# 一般的な書き方
# mysqldump -u [USER] -p[PASSWORD] [DATABASE] > /path/to/backup.sql
