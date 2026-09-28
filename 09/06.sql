-- 実行結果の確認
-- PRIMARY KEYがあるので高速に検索できるはず
-- EXPLAINで実行計画を確認
-- typeがindexになっているのでOK
-- rowsが1なのでさらに高速に検索できる
EXPLAIN
SELECT
    *
FROM
    accounts
WHERE
    number='12345';