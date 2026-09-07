const STRINGS = {
    id: {
        home: 'Beranda',
        teachings: 'Wewarah',
        history: 'Sejarah',
        articles: 'Artikel',
        books: 'Buku',
        locations: 'Sanggar',
        wejangan: 'Wejangan',
    },
    en: {
        home: 'Home',
        teachings: 'Teachings',
        history: 'History',
        articles: 'Articles',
        books: 'Books',
        locations: 'Sanggar',
        wejangan: 'Wejangan',
    },
};

export function t(locale, key) {
    return STRINGS[locale]?.[key] ?? STRINGS.id[key] ?? key;
}
