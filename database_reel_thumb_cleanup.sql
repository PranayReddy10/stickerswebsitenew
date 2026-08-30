-- Thumbnails that were never really thumbnails.
--
-- Two kinds of bad value are in this column:
--   'null' / 'undefined'  - a browser field that was empty, stringified on its way here.
--   the video's own key   - the old fallback, which made every list show a broken picture.
-- Both become a real NULL, which every screen now reads as "no still" and answers by
-- showing the video's own first frame instead. Safe to run twice.
UPDATE reel_table
   SET thumbkey = NULL
 WHERE thumbkey IN ('null', 'undefined', '');

UPDATE reel_table
   SET thumbkey = NULL
 WHERE type = 'video'
   AND thumbkey = objectkey;
