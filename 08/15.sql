-- 15.phpのコード実行のため
-- 全文検索インデックスを追加
ALTER TABLE classics
    ADD FULLTEXT(author,title);

-- http://[IP_ADDRESS]/lpmj6/08/15.php?query=Darwin でテストできる  -> これで検索できる！   