ALTER TABLE classics
    ADD INDEX(author(20));
-- 上と同じ意味
CREATE INDEX author
ON classics
    (
        author(20)
    );