![banner](https://raw.githubusercontent.com/Al-Halaqah/.github/main/halaqah.png)
# Hadith & Quran API

## Api.alhalaqah.nl

> Books
1. Bukhari
2. Muslim
3. Nasa
4. Dawud
5. Tirmidhi
6. Majah
7. Malik

> API HADITH
* /api/hadith/collection/[Books]/hadith/[specific hadith number]
* /api/hadith/random
* /api/hadith/chapter/[book]
* /api/hadith/collection/[books]/chapter/[chapter number]
* **[POST REQUEST]** /v1/hadith/search {search and your values}

> API QURAN
* /api/quran/chapter
* /api/quran/surah/[1-144]
* /api/quran/random
* /api/quran/verse_key/[surah]:[ayah]
* **[POST REQUEST]** /v1/Quran/search {search and your values}
