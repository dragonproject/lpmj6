#!/opt/homebrew/bin/zsh

# カレントディレクトリをスクリプトがある場所に変更
# $0: シェルのファイル名（パス含む）
# dirname: $0からパスを取り除いたもの（スクリプト名のみ）
# dirname "$0": スクリプト名のみ
# dirname "...": ファイルパスから「ファイル名」を取り除き、所属するディレクトリ名（親フォルダ）だけを抽出するコマンド
# （例：dirname "./09/07.sh" の結果は "./09" になる）
# "": パスにスペース等が含まれる場合に必要
# $( ): コマンドの実行結果を変数に格納

cd "$(dirname "$0")"

# 保存先ディレクトリ（../backup）がなければ自動作成
# mkdir: ディレクトリ作成
# -p: parent(親)の略。なければ作って、あれば何もしない
mkdir -p ../backup

# publicationsデータベースをバックアップ
mysqldump -u root -p'sMmpB6vR47v' publications > ../backup/publications.sql

echo "バックアップが完了しました: ../backup/publications.sql"
