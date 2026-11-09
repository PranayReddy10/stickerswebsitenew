-- Repairs rows written before the format field was fixed.
--
-- The panel's dropdown stored the label rather than the key, and the column is
-- 32 characters, so what landed was a sentence cut in half - "Native - a card
-- in the list, bui". The app matches on the key, so nothing ever matched and no
-- slot ever showed one of your ads.
--
-- Matched on what is left of each label. Anything still unrecognised afterwards
-- is set to BANNER rather than left broken; that is visible and fixable in the
-- panel, where an unmatchable string is neither.
--
-- Safe to run twice: a row already holding a key matches none of these.

UPDATE house_ad_table SET format = 'BANNER'
    WHERE format LIKE 'Banner%';
UPDATE house_ad_table SET format = 'MREC'
    WHERE format LIKE 'MREC%';
UPDATE house_ad_table SET format = 'NATIVE'
    WHERE format LIKE 'Native%';
UPDATE house_ad_table SET format = 'INTERSTITIAL'
    WHERE format LIKE 'Interstitial%';
UPDATE house_ad_table SET format = 'REWARDED'
    WHERE format LIKE 'Rewarded%';

UPDATE house_ad_table SET format = 'BANNER'
    WHERE format NOT IN ('BANNER', 'MREC', 'NATIVE', 'INTERSTITIAL', 'REWARDED');

-- The day rows carry a copy of the format, for totalling without a join.
UPDATE house_ad_stat_table s
    JOIN house_ad_table a ON a.id = s.ad_id
    SET s.format = a.format
    WHERE s.format <> a.format;
